<?php

namespace App\Http\Controllers\Shop;

use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){
        echo '1';
        //跨域
        /*header("Access-Control-Allow-origin:*");
        $data = \DB::table('1810shop_goods')->get();
//        var_dump($data);exit;
        $data = [
            "code"=>0,
            "msg"=>"select success",
            "data"=>$data
        ];
        return json_encode($data,JSON_UNESCAPED_UNICODE);*/
    }
}
