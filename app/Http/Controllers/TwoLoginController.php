<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TwoLoginController extends Controller
{
    //app端页面
    public function AppLoginList(){
        return view('login.AppLogin');
    }
    //pc端页面
    public function PCLoginList(){
        return view('login.PCLogin');
    }
    //app端用户登录
   /* public function AppLogin(Request $request){
       $all = $request->all();
        $username = $all['username'];
        //根据用户名查询数据库
        $where = [
            'username'=>$username
        ];
        $data = UserModel::where($where)->first();

        $password = $all['pwd'];
        $password_model = $data['password'];

        //验证密码
        $verif = Hash::check($password,$password_model);
        if($verif){
            //查询pc端是否登录
            $session_username = session('login.username');
            $session_type = session('login.type');

            if($session_username == $username || $session_type == 'PC'){
                //修改session
                $data = [
                    'type'=>'APP',
                    'username'=>$username
                ];
                session(['login'=>$data]);
                $type = session('login.type');
                if($type == 'APP'){
                    UserModel::where($where)->update(['type'=>1]);
                    //提示用户已经存在，强制pc端下线
                    echo 'PC端即将下线....';
                }else{
                    echo 'APP端登录失败';
                }
            }else{
                //存session
                $data = [
                    'type'=>'APP',
                    'username'=>$username
                ];
                session(['login'=>$data]);
                $type = session('login.type');
                if($type == 'APP'){
                    UserModel::where($where)->update(['type'=>1]);
                    echo '登录成功';
                }else{
                    echo '登录失败';
                }
            }
        }else{
            //登录失败  zdf
            echo '用户名或密码输入错误';
        }



    }*/

    //在pc端登录
   /* public function PCLogin(Request $request){
        $all = $request->all();
        $username = $all['username'];
        //根据用户名查询数据库
        $where = [
            'username'=>$username
        ];
        $data = UserModel::where($where)->first();

        $password = $all['pwd'];
        $password_model = $data['password'];

        //验证密码
        $verif = Hash::check($password,$password_model);

        //查询app端是否登录
        $session_username = session('login.username');
        $session_type = session('login.type');

        if($verif){
            if($session_username==$username || $session_type=='APP'){
                //修改session
                $data = [
                    'type'=>'PC',
                    'username'=>$username
                ];
                session(['login'=>$data]);
                $type = session('login.type');
                if($type=='PC'){
                    UserModel::where($where)->update(['type'=>1]);
                    //提示用户已经存在，强制pc端下线
                    echo 'PC端登录成功，APP已经强制下线....';
                }else{
                    echo 'PC端登录失败';
                }
            }else{
                $data = [
                    'type'=>'PC',
                    'username'=>$username
                ];
                //登录成功，存session
                $type = session('login.type');
                if($type=='PC'){
                    UserModel::where($where)->update(['type'=>1]);
                    echo '登录成功';
                }else{
                    echo '登录成功';
                }
            }
        }else{
            //登录失败
            echo '用户名或密码输入错误';
        }
    }*/

    //用户列表展示
    public function LoginList(Request $request){
        //查询数据库
        $data = UserModel::all();
        return view('login.login',['data'=>$data]);
    }

    //互踢
    public function  TwoLogin(Request $request){
        $visit =strtolower($_SERVER['HTTP_USER_AGENT']);

        if(strpos($visit,'windows')){
            $info = 'windows';
        }elseif (strpos($visit,'mac')){
            $info = 'mac';
        }elseif(strpos($visit,'iphone')){
            $info = 'iphone';
        }elseif(strpos($visit,'android')){
            $info = 'android';
        }elseif(strpos($visit,'ipad')){
            $info = 'ipad';
        }
        dd($info);
        
    }


}
