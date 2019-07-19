<?php

namespace App\Http\Controllers\Api;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterApiController extends Controller
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
    public function store(Request $request)
    {
        //
        $all = $request->all();
        $username = $all['username'];
        $password = $all['password'];
        $tel = $all['tel'];

        //对密码进行加密
        $password = Hash::make($password);

        $data = [
            "username"=>$username,
            "password"=>$password,
            "tel"=>$tel
        ];
        //存入数据库
        $res = UserModel::insert($data);
        if($res){
            $response = [
                "errno"=>0,
                "message"=>"register success"
            ];
        }else{
            $response = [
                "errno"=>40009,
                "message"=>"register fail"
            ];
        }
        return $response;
        /*//将数据存入redis
        $redis = new \redis();
        $redis->connect("127.0.0.1",6379);
        $id = $redis->incr("id");
        $key = "id_$id";
        $list = "api3user";
        $redis -> hset($key,'id',$id);
        $redis -> hset($key,'username',$data['username']);
        $redis -> hset($key,'password',$data['password']);
        $redis -> hset($key,'tel',$data['tel']);
        $redis -> rpush($list,$key);*/

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
