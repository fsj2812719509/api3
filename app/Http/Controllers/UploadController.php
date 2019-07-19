<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class UploadController extends Controller
{
    //curl
    public function upload(){
//        echo  111111;die;
       $url = '/wwwroot/image/001.bmp';

        $content = file_get_contents($url);
        $content = base64_encode($content);
//        dd($content);
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://vm.api3.com/uploadDo');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //post提交的数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        var_dump($data);
    }
    //测试文件传输流
    public function uploadDo(){
        $data = file_get_contents('php://input');
        echo '<img src="data:image/jpeg;base64,'.$data.'">';
    }
}
