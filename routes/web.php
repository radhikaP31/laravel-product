<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;


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
    //Route::controller(BlogsController::class)->group(['middleware' => 'Authenticate'],function () {

    Route::get('/blogs', 'index')->name('blog_index'); //Display all blogs
    Route::get('/blogs/view/{id}', 'view')->name('blog_view'); //Display blog by blog id
    Route::any('/blogs/add', 'add')->name('blog_add'); //Create blog
    Route::any('/blogs/edit/{id}', 'edit')->name('blog_edit'); //Edit blog by blog id
    Route::any('/blogs/delete/{id}', 'delete')->name('blog_delete'); //Delete blog by blog id

});

//Route group for LoginController
// Route::controller(LoginController::class)->group(function () {

//     Route::get('/login', 'index')->name('login'); //Login form
//     Route::any('/login/authenticate', 'authenticate')->name('login_auth'); //Login form

// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//fallback route
Route::fallback(function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';