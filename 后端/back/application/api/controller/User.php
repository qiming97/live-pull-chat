<?php

namespace app\api\controller;




use jwt\JwtToken;
use response\JsonResponse;
use think\cache\driver\Redis;
use think\Controller;
use think\facade\Cache;
use think\Request;

use app\api\model\UserModel;



class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $validate = new \app\api\validate\User();
        if (!$validate->check(input())){
            return  JsonResponse::createByError($validate->getError());
        }
        //
        $username = input('username');
        //判断当前账号是否已经注册了

        $user = UserModel::where('username',$username)->find();
        if($user){
            return JsonResponse::createByError('当前账号已经注册');
        }

        $password =  input('password');

       $user = new UserModel();

       $user->username     = $username;
       $user->password    = $password;
       $user->save();
       unset($user->password);



        $jwtToken= new JwtToken();
        $token=$jwtToken->createToken($user);
        $user['token'] = $token['token'];
        // 使用Redis缓存
        $redis = new Redis();
        $redis->set('user_'.$user['id'],$token['token']);

        unset($user->id);


        return JsonResponse::createBySuccess('ok',$user);



    }


    /**
     * 登陆
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function login(Request $request)
    {
        //
        $validate = new \app\api\validate\User();
        if (!$validate->check(input())){
            return  JsonResponse::createByError($validate->getError());
        }
        //
        $username = input('username');
        $password = input('password');

        //判断当前账号是否已经注册了或者密码是否错误

        $user = UserModel::where('username',$username)->find();
        if(!$user){
            return JsonResponse::createByError('当前账号不存在或密码错误');
        }


        unset($user->password);


        $jwtToken= new JwtToken();
        $token=$jwtToken->createToken($user);
        $user['token'] = $token['token'];

        $redis = new Redis();
        $redis->set('user_'.$user['id'],$token['token']);


//        Cache::store('redis')->get('name');
        unset($user->id);


        return JsonResponse::createBySuccess('ok',$user);
    }




    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
