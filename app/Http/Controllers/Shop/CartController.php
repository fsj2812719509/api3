<?php

namespace App\Http\Controllers\Shop;

use App\Model\CartModel;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller{
    public function cartDo(){
        header('Access-Control-Allow-Origin:*');  //支持全域名访问，不安全，部署后需要固定限制为客户端网址
        echo '1';
    }
}