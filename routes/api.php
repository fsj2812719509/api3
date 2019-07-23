<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/login','Api\LoginApiController',['except'=>['create','edit']]);//登录接口


Route::resource('/register','Api\RegisterApiController',['except'=>['create','edit']]);//注册接口


Route::resource('/logintest','Api\LoginTestApiController',['except'=>['create','edit']]);//周考登录接口




//商城项目

Route::resource('/ShopRegisterApi','Shop\RegisterApiController',['except'=>['create','edit']]);//注册接口

Route::resource('/ShopLoginApi','Shop\LoginApiController',['except'=>['create','edit']]);//登录接口



//app pc登录
Route::resource('/TwoLogin','TwoLoginApiController',['except'=>['create','edit']]);//登录接口



