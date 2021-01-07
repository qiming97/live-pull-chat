<?php

namespace app\http\middleware;

use jwt\JwtToken;
use response\JsonResponse;
use think\cache\driver\Redis;

class Check
{
    public function handle($request, \Closure $next)
    {
        $token = input('token');
        if (!$token){
            return JsonResponse::createByError('令牌不合法或账号过期');
        }
        $jwtToken= new JwtToken();
        $checkToken=$jwtToken->checkToken($token);
        if ($checkToken['status']!="200"){
            return JsonResponse::createByError('令牌不合法或账号过期');
        }
        $user = $checkToken['data']['data'];
        $id = $user->id;

        $redis = new Redis();
        $r_token = $redis->get('admin_user_'.$id);

        if ($token != $r_token){
            return JsonResponse::createByError('令牌不合法或账号过期');
        }
        $request->user = $user;
        return $next($request);

    }
}
