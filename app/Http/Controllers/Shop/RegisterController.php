<?php

namespace App\Http\Controllers\Shop;

use App\Model\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    //注册
    public function shopregister(Request $request){
        //跨域
        header("Access-Control-Allow-origin:*");
        //接受用户的姓名密码邮箱手机
        $all       =  $request->input();
        $username  =  $all['username'];
        $tel       =  $all['tel'];
        $email     =  $all['email'];
        $password  =  $all['password'];
        $password2 =  $all['password2'];

        //判断值不能为空
        if($username == ''){
            return '1';exit;//姓名不能为空
        }
        if($tel == ''){
            return '2';exit;//手机号不能为空
        }
        if($email == ''){
            return '3';exit;//邮箱不能为空
        }
        if($password == ''){
            return '4';exit;//密码不能为空
        }
        if($password != $password2){
            return '5';exit;//两次密码必须一致
        }

        //将数据进行加密
        $username = encrypt($username);
        $tel      = encrypt($tel);
        $email    = encrypt($email);
        $password = encrypt($password);

        //掉接口
        $url = "http://vm.api3.com/api/ShopRegisterApi";

        $data = [
            "username"=>$username,
            "tel"=>$tel,
            "email"=>$email,
            "password"=>$password
        ];

        $res = Http::httpPost($url,$data);
        var_dump($res);



    }
}
