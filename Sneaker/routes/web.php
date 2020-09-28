<?php

use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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


Route::get('/admin/login', 'AdminController@login');

Route::post('/admin/login', 'AdminController@loginAdmin');

Route::get('/admin', 'AdminController@indexAdmin')->middleware('CheckLoginAdmin');

Route::get('/admin/users', 'AdminController@users');

//Create User
Route::get('/admin/createUser', 'AdminController@viewCreateUser');

Route::post('admin/createUser', 'AdminController@handlingUser');
//Create User


//Update User
Route::get('/admin/{id}', 'AdminController@viewUpdateUser');

Route::post('/admin/{id}', 'AdminController@updateUser');
//Update User


//Delete User
Route::get('/admin/ajax/userdelete', 'AdminController@destroy')->name('admin.delete');
//Delete User



//----------------------Product----------------------//

//View Product
Route::get('/admin/sanpham/products', 'AdminProducts@products');

//Create Product
Route::get('/admin/sanpham/create', 'AdminProducts@create');

Route::post('/admin/sanpham/create', 'AdminProducts@createProduct');


//Update Product
Route::get('/admin/sanpham/{id}', 'AdminProducts@viewUpdate');

Route::post('/admin/sanpham/{id}', 'AdminProducts@updateProduct');


//Delete Product
Route::get('/admin/ajax/delete', 'AdminProducts@deleteProduct')->name('product.delete');


//----------------------Client-------------------------//

//index
Route::get('/client', 'ClientController@index');

//Detail
Route::get('/client/detail/{id}', 'ClientController@detail');

//Add Product
Route::get('/client/ajax/add', 'ClientController@addProduct')->name('client.add');

//Carts
Route::get('/client/carts', 'ClientController@viewCart');

//Delete
Route::get('/client/ajax/delete', 'ClientController@deleteProduct')->name('client.delete');

//Change Count Carts
Route::get('/client/ajax/change', 'ClientController@changeCarts')->name('client.change');

//Get Login
Route::get('/client/login', 'ClientController@getLogin');

//Post Login
Route::post('/client/login', 'ClientController@postLogin');

//Get Register
Route::get('/client/register', 'ClientController@getRegister');

//Check Order
Route::get('/client/ajax/checkOrder', 'ClientController@checkOrder')->name('client.check');


//Order
Route::get('/client/order', 'ClientController@viewOrder');