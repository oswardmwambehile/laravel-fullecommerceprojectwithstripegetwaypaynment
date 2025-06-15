<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;

class AdminController extends Controller
{

    public function dashboard()
{
    // Count stats
    $totalUsers = User::count();
    $totalOrders = Order::count();
    $totalProducts = Product::count();

    $pendingOrders = Order::where('status', 'pending')->count();
    $processingOrders = Order::where('status', 'processing')->count();
    $completedOrders = Order::where('status', 'completed')->count();
    $cancelledOrders = Order::where('status', 'cancelled')->count();
    $totalRevenue = \App\Models\Order::where('status', 'completed')
    ->get()
    ->sum(function ($order) {
        return $order->price * $order->quantity;
    });
    

    return view('admin.home', compact(
        'totalUsers',
        'totalOrders',
        'totalProducts',
        'pendingOrders',
        'processingOrders',
        'completedOrders',
        'cancelledOrders',
        'totalRevenue'
    ));
}
    // Show create category form (matches your route)
    public function create()
    {
        return view('admin.create'); // your form view
    }

    // Store new category (POST /admin/store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Category::create($request->only('name', 'status'));

        return redirect()->route('admin.index')->with('success', 'Category added successfully.');
    }

    // List categories (GET /admin)
    public function index()
    {
        $categories = Category::all();
        return view('admin.index', compact('categories'));
    }

    // Edit category form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'status'));

        return redirect()->route('admin.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.index')->with('success', 'Category deleted successfully.');
    }
    public function order(){

    $orders = \App\Models\Order::with('user', 'product')->latest()->get();
    return view('admin.order', compact('orders'));
    }
public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}



public function downloadPDF()
{
    $orders = Order::with('user', 'product')->latest()->get();

    // Load the view and pass the data
    $pdf = PDF::loadView('admin.orders_pdf', compact('orders'));

    // Download the PDF file
    return $pdf->download('orders_overview.pdf');
}
public function index_user()
{
    $users = User::all(); // Retrieves all users from the database
    return view('admin.index_user', compact('users'));
}
// View User Details
public function viewUser($id)
{
    $user = User::findOrFail($id);
    return view('admin.users_view', compact('user')); // create a view for viewing the user details
}

// Delete User
public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}


public function pendingOrders() {
    $orders = Order::where('status', 'pending')->get();
    return view('admin.pending', compact('orders'));
}

public function processingOrders() {
    $orders = Order::where('status', 'processing')->get();
    return view('admin.processing', compact('orders'));
}

public function completedOrders() {
    $orders = Order::where('status', 'completed')->get();
    return view('admin.completed', compact('orders'));
}

public function cancelledOrders() {
    $orders = Order::where('status', 'cancelled')->get();
    return view('admin.cancelled', compact('orders'));
}




}
