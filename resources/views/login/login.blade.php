<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>用户名</td>
            <td>电话</td>
            <td>邮箱</td>
            <td>状态</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v['username']}}</td>
                <td>{{$v['type']}}</td>
                <td>{{$v['email']}}</td>
                @if($v['type']==1)
                    <td>在线</td>
                @elseif($v['type']!=1)
                    <td>不在线</td>
                @endif
            </tr>
        @endforeach
    </table>
</body>
</html>