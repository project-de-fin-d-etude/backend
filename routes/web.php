<?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\owner_products_controller;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\editUserController;

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
// Route::get ('/products',"productController@index");
Route::get('/products/{category_id?}/{product_id?}', [productController::class, 'index']);
Route::get('/product/{owner_id?}', [owner_products_controller::class, 'index']);
Route::post('/edit_product', [owner_products_controller::class, 'edit_product']);
Route::post('/add_product', [owner_products_controller::class, 'add_product']);
Route::delete('delete_product/{id?}',  [owner_products_controller::class, 'delete_product']);
Route::get('/categories', [categoryController::class, 'index']);
Route::get('/user/{id?}', [userController::class, 'index']);
Route::get('/orders/{user_id?}', [ordersController::class, 'index']);
Route::post('/signIn', [LoginController::class, 'authenticate']);
Route::post('/users/{id?}', [editUserController::class, 'index']);
Route::post('/register', [registerController::class, 'send']);
Route::post('/order', [orderController::class, 'placeOrder']);
