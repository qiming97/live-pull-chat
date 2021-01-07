<?php

namespace app\admin\controller;

use app\api\model\LiveModel;
use response\JsonResponse;
use think\cache\driver\Redis;
use think\Controller;
use think\Request;

class Live extends Controller
{


    protected $middleware = [

        'check' => ['only'    => ['settime','set'] ],

    ];
    public function gettime(){
        $redis = new Redis();
        $beilv = $redis->get('beilv');
        if(!$beilv){
            return JsonResponse::createByError("获取失败");
        }
        return JsonResponse::createBySuccess("ok",$beilv);
    }
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( '../uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
    public function update(Request $request)
    {
        //

        $id = input('id');
        $url = input('url');
        $state = input('state');
        $title=input('title');
        $desc =input('desc');
        $status =input('status');
        if(!$id){
            return JsonResponse::createByError('参数错误');
        }
       $live =  LiveModel::get($id);
        $live->url = $url;
        $live->state =$state;
        $live->title=$title;
        $live->desc = $desc;
        $live->status = $status;
        if ($live->save()){
            return JsonResponse::createBySuccess('设置成功');
        }
        return JsonResponse::createByError('error');




    }

    public function settime(Request $request)
    {
        //

        $time = input('time');
        if(!$time){
            return JsonResponse::createByError('参数错误');
        }
        $time = (float)$time;

        $redis = new Redis();
        $redis->set('beilv',$time);
        return JsonResponse::createBySuccess('设置成功');
    }


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
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
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
