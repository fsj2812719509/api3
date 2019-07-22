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
        echo '1';exit;


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
        //根据gid 查询数据库
        $res3 = CartModel::where($where)->first();
        if($res){
            //没加入购物车一次就更改购物车数量
            $number = $res3['number'];
            $number = $number + 1;

            $data = [
                'number'=>$number
            ];

            $res4 = CartModel::where($where)->update($data);
            var_dump($res4);
        }else{
            //加入购物车
            $res = CartModel::insert($data);
            var_dump($res);
        }









    }
}
