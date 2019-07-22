<?php

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
//Route::post('login','UserController@login');

//流文件
Route::get('upload','UploadController@upload');
Route::post('uploadDo','UploadController@uploadDo');

//登录
Route::get('loginlist','UserController@loginlist');
Route::post('login','UserController@login');


//商城

Route::post('/shopregister','Shop\RegisterController@shopregister');//商城注册

Route::get('/shopindex','Shop\IndexController@index');//商品展示

Route::post('/particulars','Shop\ParticularsController@particulars');//商品详情

Route::post('/cartDo','Shop\CartController@cartDo');//加入购物车

Route::post('/cart','Shop\CartController@cart');//加入购物车
