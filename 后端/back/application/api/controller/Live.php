<?php

namespace app\api\controller;


use app\api\model\LiveModel;
use response\JsonResponse;
use think\Controller;
use think\Request;

class Live extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return '你好';
    }
    public function getLiveUrl(){
        $live = new \app\api\model\Live();
        $url = $live->getLiveUrl();
        return JsonResponse::createBySuccess('ok',$url);

    }

    /**
     * 增加链接.
     *
     * @return \think\Response
     */
    public function addUrl()
    {
        //参数验证
        $validate = new \app\api\validate\Live();
        if (!$validate->check(input())){
            return  JsonResponse::createByError($validate->getError());
        }
        $url = input('url');
        $title = input('title');
        $desc = input('desc');

        //判断是否已有
        $live = LiveModel::where('url',$url)->find();
        if($live){
            return JsonResponse::createByError('当前链接已存在');
        }
        //判断是否超过两个
        if(LiveModel::count()>=2){
            return JsonResponse::createByError("超过上限");
        }
        $model = new LiveModel();
        $model['url'] = $url;
        $model['title'] = $title;
        $model['desc'] = $desc;
        $model->save();
        return JsonResponse::createBySuccess($model);




    }
    /**
     * 获取链接.
     *
     * @return \think\Response
     */
    public function getUrl()
    {
//
//        LiveModel::find('url')->find();
//        $list = LiveModel::all();



        return JsonResponse::createBySuccess(LiveModel::field('delete_time',true)->select());




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
