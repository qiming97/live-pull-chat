<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    protected $rule =   [
        'username'  => 'require|max:18|min:6',
        'password'   => 'require|max:33|min:6',
    ];

    protected $message  =   [
        'username.require' => '用户名必须输入',
        'username.max' => '用户名最多18位',
        'username.min' => '用户名最少6位',
        'password.require'   => '密码必须输入',
        'password.max'  => '密码最大33位',
        'password.min'  => '密码最小6位',
    ];

}
