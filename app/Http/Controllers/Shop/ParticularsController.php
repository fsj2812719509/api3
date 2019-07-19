<?php

namespace App\Http\Controllers\  Shop;

use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParticularsController extends Controller
{
    //根据商品名查询商品信息
    public function particulars(Request $request){
        //跨域
        header("Access-Control-Allow-origin:*");
        $id = $request->all();
        //根据id查询数据
        $where = [
            "gid"=>$id
        ];
        $data = GoodsModel::where($where)->first();
        $data = [
            "errno"=>0,
            "massge"=>"select success",
            "data"=>$data
        ];
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
}
