<?php

namespace App\Http\Controllers\Api;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends CommonController
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
        //获取姓名，密码，手机号 邮箱
        $all = $request->all();
        $username = $all['username'];
        $password = $all['password'];
        $tel = $all['tel'];
        $code = $all['code'];

        //将数据库加入数据库
        $password = Hash::make($password);
        $data = [
            "username"=>$username,
            "password"=>$password,
            "tel"=>$tel,
            "code"=>$code
        ];

        $model_res = UserModel::insert($data);
        if($model_res){
            //注册成功生成token
            $response = [
                'msg'=>'Registered successfully',
                'errno'=>'00000',
            ];
        }else{
            $response = [
                'msg'=>'Registration failed',
                'errno'=>'00000',
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
