<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
class LoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    const JWT_KEY = 'fushijia';
    public function store(Request $request)
    {
        //跨域
        header("Access-Control-Allow-origin:*");
        //登录
        $all = $request->all();

        $name = $all['name'];
        $password = $all['password'];

        //查询数据库
        $where1 = ['username'=>$name];
        $where2 = ['tel'=>$name];
        $where3 = ['email'=>$name];
        $res = UserModel::where($where2)->orWhere($where2)->orWhere($where3)->first();
        var_dump($res);exit;

        //获取用户的密码
        $password_model =  $res['password'];
        $username       =  $res['username'];
        if($res){
            if(Hash::check($password,$password_model)){
                //生成token
                $token = array(
                    "iss"=>"http://vm.api.com",
                    "aud"=>"http://vm.api.com",
                    "exp"=>time()+600
                );

                unset($res['password']);

                $token = array_merge(["user"=>$res],$token);
                $token = JWT::encode($token,self::JWT_KEY);
                $token = encrypt($token);

                //将token存入session
                $data = [
                    "username"=>$username,
                    "token"=>$token
                ];
                session(["api3shop"=>$data]);

                echo '1';//成功


            }else{
                //获取用户的信息将用户登录失败的次数记录在redis中
                echo 3;//密码不正确
            }
        }else{
            //获取用户的信息将用户登录失败的次数记录在redis中
            echo '2';//名称 手机号 邮箱不正确
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
