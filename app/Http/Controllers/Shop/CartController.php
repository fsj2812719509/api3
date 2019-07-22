<?php

namespace App\Http\Controllers\Shop;

use App\Model\CartModel;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    //
    public function cartDo(Request $request){

        //跨域
        header("Access-Control-Allow-origin:*");

        $all = $request->all();
        $gid = $all['gid'];

        //根据获取的id查出数据
        $where = [
            "gid"=>$gid
        ];
        $res = GoodsModel::where($where)->first();

        //获取商品的名称，价钱，数量
        $goods_name = $res['goods_name'];
        $self_price = $res['self_price'];
        $goods_img = $res['goods_img'];

        $data = [
            'goods_name'=>$goods_name,
            'self_price'=>$self_price,
            'goods_img'=>$goods_img,
            'number'=>1
        ];

        $where2 = [
            'goods_name'=>$goods_name
        ];

        //根据goods_name 查询数据库
        $res3 = CartModel::where($where2)->first();
        if($res3){
            //购物车中有数据
            $number = $res3['number'];
            $number2 = $number + 1;
            $res4 = CartModel::where($where)->update(['number'=>$number2]);
            var_dump($res4);
        }else{
            //加入购物车
            $res4 = CartModel::insert($data);
            var_dump($res);
        }

    }
}
