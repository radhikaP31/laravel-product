<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;


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

//test csrf token
Route::get('/login', function () {
    return view('login');
});

//Route group for UserController
Route::controller(UserController::class)->group(function () {

    Route::get('/users', 'index')->name('user_index'); //Display all users
    Route::get('/users/view/{id}', 'view'); //Display user profile by user id
    Route::any('/users/add', 'add'); //Create user profile
    Route::any('/users/edit/{id}', 'edit'); //Edit user profile by user id
    Route::any('/users/delete/{id}', 'delete'); //Edit user profile by user id
    
    Route::get('/practice/{name}', 'practice'); //Display practice data

});



//fallback route
Route::fallback(function () {
    return view('welcome');
});