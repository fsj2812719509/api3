<?php

namespace App\Http\Controllers\Api;

use App\Model\UserModel;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Predis\Client;
class LoginTestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 111;die;
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
        //登录
        $all = $request->all();
        $username = $all['username'];
        $password = $all['password'];

        $username = decrypt($username);
        $password = decrypt($password);
        //查询数据库
        $where = [
            'username'=>$username
        ];
        $res = UserModel::where($where)->first();
        $password_model = $res['password'];
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
                $res2 = UserModel::where($where)->update(['token'=>$token]);
                if($res2){
                    $response = [
                        "errno"=>0,
                        "message"=>"login success",
                        "token"=>$token
                    ];
                }else{
                    $response = [
                        "errno"=>40005,
                        "message"=>"make token fail",
                    ];
                }
            }else{
                //获取用户的信息将用户登录失败的次数记录在redis中
                $uid = $res['uid'];
                $user_num = "u:num:".$res->uid.'';
                $num = Redis::incr($user_num);

                $response = [
                    "errno"=>40010,
                    "message"=>"username or password wrong",
                    "num"=>"'error_num:'.$num.$username"
                ];
            }
        }else{
            //获取用户的信息将用户登录失败的次数记录在redis中
            $uid = $res['uid'];
            $user_num = "u:num:".$res->uid.'';
            $num = Redis::incr($user_num);

            $response = [
                "errno"=>40010,
                "message"=>"username or password wrong",
                "num"=>"'error_num:'.$num.$username"
            ];
        }

        return $response;

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
