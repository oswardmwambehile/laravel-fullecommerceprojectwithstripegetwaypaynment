<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;

use Session;
use Stripe;

class HomeController extends Controller
{
 public function index()
{
    $comments = Comment::with(['user', 'replies.user'])->latest()->get();
    $product = Product::paginate(6);

    $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }

    return view('home.userpage', compact('product', 'comments', 'cartQuantity'));
}
 public function about()
{
    $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }
   
    return view('home.about',compact('cartQuantity'));
}

public function testimonial()
{
    $customers = \App\Models\User::where('usertype', 0)->get();
    $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }
    

    return view('home.testimonial', compact('customers','cartQuantity'));
}






    public function redirect()
{
    $usertype = Auth::user()->usertype;
    \Log::info('User type is: ' . $usertype);


    if ($usertype == 1) {
        return redirect()->route('admin.home');
    } else {
        return redirect()->route('home.userpage');
    }
}

public function product_detail($id)
{
    $product = Product::find($id);
    $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }
    
    return view('home.show', compact('product','cartQuantity'));


}

public function add_cart(Request $request, $id)
{
    if (Auth::check()) {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // Check if product already in cart
        $existingCartItem = Cart::where('user_id', $user->id)
                                ->where('product_id', $product->id)
                                ->first();

        $requestedQuantity = $request->quantity;

        if ($existingCartItem) {
            // Update quantity
            $existingCartItem->quantity += $requestedQuantity;
            $existingCartItem->save();
        } else {
            // Add new item to cart
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->quantity = $requestedQuantity;
            $cart->save();
        }
         Alert::success('Added!', 'Product has been added to cart!');
        return redirect()->back()->with('success', 'Product added to cart!');
    } else {
        return redirect('login')->with('error', 'You must login to add to cart.');
    }
}

public function show_cart()
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        // Optional: update cart count in session (for navbar badge)
        session(['cart_count' => $cartItems->sum('quantity')]);

        $cartQuantity = 0;
    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }

        return view('home.show_cart', compact('cartItems','cartQuantity'));
    }


 public function myOrders()
{
    $user = Auth::user();
    $orders = $user->orders()->latest()->get();
      $cartQuantity = 0;
    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }

    return view('home.my_orders', compact('orders','cartQuantity'));
}

public function cancelOrder($id)
{
    $order = Auth::user()->orders()->where('id', $id)->firstOrFail();

    if ($order->status === 'pending') {
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
}


public function remove_cart($id)
{
    $cartItem = Cart::findOrFail($id);

    if ($cartItem->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $cartItem->delete();

    return redirect()->back()->with('success', 'Item removed from cart.');
}

public function update_cart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        Alert::success('updated!', 'Cart updated successsfully!');

        return redirect()->route('show_cart')->with('success', 'Quantity updated!');
    }

 
public function cashOnDelivery(Request $request)
{
    $user = auth()->user();

    // Fetch cart items with product relationship
    $cartItems = \App\Models\Cart::with('product')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    foreach ($cartItems as $item) {
        \App\Models\Order::create([
            'user_id' => $user->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
            'status' => 'pending',
            'paynment_status' => 'Cash on Delivery',
            'delivery_status' => 'Order Received',
        ]);
    }

    // Clear the cart
    \App\Models\Cart::where('user_id', $user->id)->delete();

    return redirect()->route('home.confirmation')->with('success', 'Order placed successfully.');
}

public function stripe($grandTotal)
{
    return view('home.stripe', compact('grandTotal'));
}

public function stripePost(Request $request, $grandTotal)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    if (!$request->has('stripeToken') || empty($request->stripeToken)) {
        return back()->with('error', 'Stripe token is missing. Please try again.');
    }

    try {
        \Stripe\Charge::create([
            'amount' => (int) $grandTotal, // amount in cents
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment from card.',
        ]);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        return back()->with('error', 'Payment failed: ' . $e->getMessage());
    }

    $user = auth()->user();
    $cartItems = \App\Models\Cart::with('product')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    foreach ($cartItems as $item) {
        \App\Models\Order::create([ 
            'user_id' => $user->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
            'status' => 'pending',
            'paynment_status' => 'Paid',
            'delivery_status' => 'Order Received',
        ]);
    }

    // Clear the cart
    \App\Models\Cart::where('user_id', $user->id)->delete();

    \Session::flash('success', 'Payment successful!');
    return redirect()->route('show_cart');
}


  public function products()
  
{
    $product = Product::paginate(9);

    $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }
    
    return view('home.product', compact('product','cartQuantity'));
}
public function storeComment(Request $request)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment = Comment::create([
        'user_id' => Auth::id(),
        'comment' => $request->comment,
    ]);
    $comment->load('user');

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'user_name' => $comment->user->name,
            'comment' => $comment->comment,
            'created_at' => $comment->created_at->diffForHumans(),
            'replies' => [],
        ],
        'message' => 'Comment added successfully.'
    ]);
}


public function storeReply(Request $request)
{
    $request->validate([
        'comment_id' => 'required|exists:comments,id',
        'reply_content' => 'required|string|max:1000',
    ]);

    $reply = Reply::create([
        'user_id' => Auth::id(),
        'comment_id' => $request->comment_id,
        'reply_content' => $request->reply_content,
    ]);
    $reply->load('user');

    return response()->json([
        'success' => true,
        'reply' => [
            'id' => $reply->id,
            'user_name' => $reply->user->name,
            'reply_content' => $reply->reply_content,
            'created_at' => $reply->created_at->diffForHumans(),
            'comment_id' => $reply->comment_id,
        ],
        'message' => 'Reply added successfully.'
    ]);
}

public function search(Request $request)
{
    $query = $request->input('query');
    $comments = Comment::with(['user', 'replies.user'])->latest()->get();

    $product = Product::where('title', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->orWhereHas('category', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%");
        })
        ->paginate(9);
        $cartQuantity = 0;

    if (Auth::check()) {
        $cartQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
    }

    return view('home.product', compact('product','comments','cartQuantity'));
}


}