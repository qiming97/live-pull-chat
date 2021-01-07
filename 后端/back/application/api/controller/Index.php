<?php

namespace app\api\controller;

use response\JsonResponse;
use think\cache\driver\Redis;
use think\Controller;
use think\Request;

class Index extends Controller
{
//    protected $middleware = [
//
//        'check' => ['only'    => ['setBannerList'] ],
//
//    ];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */


    public function index(){
        $default = '[{"src":"https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601210039&di=ce5137cac87acf4071c64ddf34fb158b&imgtype=0&src=http%3A%2F%2Fp3.qhimg.com%2Ft01b2177d8d1290688d.jpg","url":"/"},{"src":"https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601141800&di=b3cbf169b3cdb17bf57eb543cc102264&imgtype=0&src=http%3A%2F%2Fstatic.managershare.com%2Fuploads%2F2018%2F10%2F15395723069885.jpg%3Fimageview2%2F2%2Fw%2F760","url":"/"},{"src":"https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601210038&di=112ecfa5efce58046d2c7542bc6f99aa&imgtype=0&src=http%3A%2F%2Fwap.yesky.com%2FuploadImages%2F2017%2F091%2F18%2F47608TF0ZVA2_P1120483.JPG","url":"/"},{"src":"https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607603260166&di=b4f27cada4566fb9df4a3db7a82d3adb&imgtype=0&src=http%3A%2F%2Fattach.bbs.miui.com%2Fforum%2F201501%2F29%2F154912worftckqkkv55trf.jpg","url":"/"}]';
        $defaultList = json_decode($default);

        $redis = new Redis();
        $bannerList = $redis->get('banner');

        if(!$bannerList){
            return JsonResponse::createBySuccess($defaultList);
        }else{
            $bannerList=json_decode($bannerList);
            return JsonResponse::createBySuccess($bannerList);
        }
    }

    public function update(){
        $list= input('list');

        if(!$list){
            return JsonResponse::createByError('参数错误');
        }
        $redis = new Redis();
        $imgList = json_encode($list);
        $bannerList = $redis->set('banner',$imgList);
        return JsonResponse::createBySuccess($bannerList);
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
