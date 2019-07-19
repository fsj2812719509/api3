<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
class JwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    const JWT_KEY = 'fushijia';
    public function handle($request, Closure $next)
    {
        $token = $request->header("Authorization");
        if(!$token){
            return $response = [
                "message"=>"UNAUTHORIZATION",
                "errno"=>"40001"
            ];
        }
        $token = explode(" ",$token);
        $token = $token[0];
        //验证
        //验证
        try{
            $token = decrypt($token);
            $decoded = JWT::decode($token,self::Jwt_Ket, array('HS256'));

            $this->user = $decoded->user;

            return $next($request);
        }catch(\Exception $e){
            return response($e->getMessage(),'401');
        }
        return $next($request);
    }


}
