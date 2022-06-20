<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\WebhookController;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//role default value add custom role middleware for check role
Route::get('/checkrole/{role?}', function ($role = 'user') {
    return "Your role is -> ".ucfirst($role);
})->name('checkrole')->middleware('checkRole:user');

//id with validate in RouteServiceProvider.php and default value, remove middleware for this request
Route::get('/first/{id?}', function ($id = 10) {
    return "This is my first static route with id parameter!! -> ".$id;
})->name('first')->withoutMiddleware([VerifyCsrfToken::class]);

//name with validate with all web middleware
Route::get('/hello/{name?}', function ($name = 'John') {
    return "Hello ".$name;
})->whereAlpha('name')->name('hello')->middleware('web');

//project with IN condition
Route::get('/project/{project}', function ($project) {
    return "Welcome to ".$project;
})->whereIn('project', ['laravel', 'cakephp', 'php'])->name('project');

//enum route
Route::get('/role/{role}', function (RoleEnum $role) {
    return 'Response will be display if your role is user or admin -> '.$role->value;
});

//csrf
Route::get('/csrf', function (Request $request) {

    $token = $request->session()->token();
 
    $token = csrf_token();

    return 'Token -> '.$token;
});

//call repository in route
Route::get('/get-user-repo', function (UserRepository $user) {
    return $user->all();
})->middleware(['auth'])->name('getUserData');

//Route group for UserController
Route::controller(UserController::class)->middleware(['auth'])->group(function () {
    Route::get('/users', 'index')->name('user_index'); //Display all users
    Route::get('/users/view/{id}', 'view'); //Display user profile by user id
    Route::any('/users/add', 'add'); //Create user profile
    Route::any('/users/edit/{id}', 'edit'); //Edit user profile by user id
    Route::any('/users/delete/{id}', 'delete'); //Delete user profile by user id
    
    Route::get('/practice/{name}', 'practice'); //Display practice data
});

//Route group for BlogsController
Route::controller(BlogsController::class)->middleware(['auth'])->group(function () {
    Route::get('/blogs', 'index')->name('blog_index'); //Display all blogs
    Route::get('/blogs/show/{id}', 'show')->name('blog_view'); //Display blog by blog id
    Route::any('/blogs/add', 'add')->name('blog_add'); //Create blog
    Route::any('/blogs/edit/{id}', 'edit')->name('blog_edit'); //Edit blog by blog id
    Route::any('/blogs/delete/{id}', 'delete')->name('blog_delete'); //Delete blog by blog id
});

//Route group for ProductsController
Route::controller(ProductsController::class)->middleware(['auth'])->group(function () {
    Route::get('/products', 'index')->name('products_index'); //Display all products
    Route::get('/products/view/{id}', 'view')->name('products_view'); //Display product by id
    Route::any('/products/add', 'add')->name('products_add'); //Create product
    Route::any('/products/edit/{id}', 'edit')->name('products_edit'); //Edit product by id
    Route::any('/products/delete/{id}', 'delete')->name('products_delete'); //Delete product by id


    Route::any('/dashboard', 'productList')->name('dashboard'); //Display all products

});

//Route group for InventoryController
Route::controller(InventoryController::class)->middleware(['auth'])->group(function () {
    Route::get('/inventory', 'index')->name('inventory_index'); //Display all inventory
    Route::get('/inventory/view/{id}', 'view')->name('inventory_view'); //Display inventory by id
    Route::any('/inventory/add', 'add')->name('inventory_add'); //Create inventory
    Route::any('/inventory/edit/{id}', 'edit')->name('inventory_edit'); //Edit inventory by id
    Route::any('/inventory/delete/{id}', 'delete')->name('inventory_delete'); //Delete inventory by id
});

//Route group for CartController
Route::controller(CartController::class)->middleware(['auth'])->group(function () {
    Route::get('/cart', 'view')->name('cart_view'); //Display cart by id
    Route::post('/cart/add/{id}', 'add')->name('cart_add'); //Create cart
    Route::any('/cart/updateCart', 'updateCart')->name('cart_edit'); //Edit cart by id
    Route::any('/cart/removeProduct', 'removeProduct')->name('cart_delete'); //Delete cart item by id
});

//Route group for OrdersController
Route::controller(OrdersController::class)->middleware(['auth'])->group(function () {
    Route::any('orders/order', 'newOrder')->name('new_order'); //Create new order
});

//Route group for InvoiceController
Route::controller(InvoiceController::class)->middleware(['auth'])->group(function () {
    Route::get('/invoice/index', 'index')->name('invoice_index'); //display invoice
    Route::get('/invoice/changeStatus/{status}/{id}', 'changeStatus')->name('invoice_status'); //change invoice status
    Route::get('/invoice/view/{id}', 'view')->name('invoice_view'); //Display invoice by id
});

//Route group for StripeController
Route::controller(StripeController::class)->middleware(['auth'])->group(function () {
    Route::any('/stripe/{id}', 'stripe')->name('stripe_form'); //paymetn form
    Route::any('/payment/{id}', 'payStripe')->name('stripe_post'); //payment
});

//Route group for WebhookController
Route::controller(WebhookController::class)->middleware(['auth'])->group(function () {
    Route::any('/stripeWebhook', 'stripeWebhook')->name('stripeWebhook'); //stripe webhook
});

//fallback route
Route::fallback(function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';