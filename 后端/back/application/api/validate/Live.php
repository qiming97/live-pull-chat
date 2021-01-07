<?php

namespace app\api\validate;

use think\Validate;

class Live extends Validate
{
    protected $rule =   [
        'url'  => 'require|url',
        'title' => 'require',
        'desc' => 'require'
    ];

    protected $message  =   [
        'url.require' => '必须提交直播url',
        'url.url' => '请提交正确的链接',
        'title.require' => '必须提交标题',
        'desc.require' => '必须提交描述',
    ];
}
