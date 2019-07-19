<?php

namespace App\Http\Controllers;

use App\Model\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //登录页面
    public  function  loginlist(){

        return view('login.login');

    }
    //登录
    public function login(Request $request){
        $all = $request->all();

        $username = $all['username'];
        $password = $all['password'];

        //数据进行加密
        $username = encrypt($username);
        $password = encrypt($password);

        $data = [
            "username"=>$username,
            "password"=>$password
        ];

        //调用接口
        $url = "http://vm.api3.com/api/logintest";
        $res = Http::httpPost($url,$data);
        $res = json_decode($res,true);
        if($res['errno']==0){
            echo '登录成功';

        }else{
            echo '登录失败';
        }
    }
}
