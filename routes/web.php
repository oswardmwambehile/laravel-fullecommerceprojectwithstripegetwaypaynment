<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Public route or user home page
Route::get('/', [HomeController::class, 'index'])->name('home.userpage');

// Routes that require authentication
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {

    // Admin dashboard route (only accessed after redirect)
    Route::get('/admin', function () {
        return view('admin.home'); // Blade view for admin dashboard
    })->name('admin.home');

    // Normal user dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard'); // Blade view for normal user dashboard
    })->name('dashboard');

    // Role-based redirect route after login
    Route::get('/search', [HomeController::class, 'search']);
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
    Route::get('/product_detail/{id}', [HomeController::class,'product_detail']);
    Route::post('/add_cart/{id}', [HomeController::class,'add_cart']);
   Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('show_cart');
   Route::get('/product', [HomeController::class, 'products'])->name('product');
   Route::middleware('auth')->group(function () {
    Route::post('/comment/store', [HomeController::class, 'storeComment'])->name('comment.store');
    Route::post('/reply/store', [HomeController::class, 'storeReply'])->name('reply.store');
});
   Route::middleware(['auth'])->get('/my-orders', [HomeController::class, 'myOrders'])->name('my-orders');

    Route::post('/cancel-order/{id}', [HomeController::class, 'cancelOrder'])->name('cancel.order');
     Route::get('/about', [HomeController::class, 'about'])->name('about');
        Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
   Route::get('/stripe/{grandTotal}', [HomeController::class, 'stripe'])->name('stripe');
Route::post('/stripe/{grandTotal}', [HomeController::class, 'stripePost'])->name('stripe.post');

    Route::delete('/remove_cart/{id}', [HomeController::class,'remove_cart']);
    
Route::post('/update_cart/{id}', [HomeController::class, 'update_cart'])->name('cart.update');
Route::post('/cash-on-delivery', [HomeController::class, 'cashOnDelivery'])->name('home.cod');
Route::get('/order-confirmation', function () {
    return view('home.confirmation'); // create this blade file
})->name('home.confirmation');


   
});








Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');       // Show category create form
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');         // Store new category
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');          // Show list of categories
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');        // Show edit form
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');  // Update category
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/admin/oder', [AdminController::class,'order'])->name('admin.order');
Route::put('/orders/{order}/status', [AdminController::class, 'updateStatus'])->name('orders.updateStatus');


Route::get('orders/download-pdf', [AdminController::class, 'downloadPDF'])->name('orders.download_pdf');
Route::get('/users', [AdminController::class, 'index_user'])->name('users.index');
Route::get('/users/{id}', [AdminController::class, 'viewUser'])->name('admin.viewUser');

// Delete a user
Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

 // Delete category
Route::get('/pending', [AdminController::class, 'pendingOrders'])->name('orders.pending');
Route::get('/processing', [AdminController::class, 'processingOrders'])->name('orders.processing');
Route::get('/completed', [AdminController::class, 'completedOrders'])->name('orders.completed');
Route::get('/orders/cancelled', [AdminController::class, 'cancelledOrders'])->name('orders.cancelled');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.home');

use App\Http\Controllers\ProductController;
Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');         // Show product create form
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');          // Store new product
Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');           // Show list of products
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');         // Show edit form
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');   // Update product
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Delete product
