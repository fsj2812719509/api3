<?php

namespace App\Http\Controllers\Shop;

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
        echo 1;die;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取用户名 手机号 邮箱 密码
        $all = $request->all();


        $username = $all['username'];
        $tel = $all['tel'];
        $email = $all['email'];
        $password = $all['password'];
        $password2 = $all['password2'];

        if($username == ''){
            return '1';
        }
        if($tel == ''){
            return 2;
        }
        if($email == ''){
            return 3;
        }
        if($password == ''){
            return 4;
        }
        if($password2 != $password){
            return 5;
        }

        //查询库中是否有姓名
        $where  = [
            "username"=>$username
        ];
        $res1 = UserModel::where($where)->first();
        if($res1){
           return 1;
        }else{
            //将密码进行加密
            $password = Hash::make($password);

            $data = [
                "username"=>$username,
                "tel"=>$tel,
                "email"=>$email,
                "password"=>$password
            ];

            //将数据存入库中
            $res2 = UserModel::insert($data);
            if($res2){
                return 2;
            }else{
                return 3;
            }

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
