<?php

namespace app\api\model;

use think\Model;
use think\model\concern\SoftDelete;

class UserModel extends Model
{
    //
    //5.1中模型不会自动获取主键名称，必须设置pk属性。
    //设置主键
    protected $pk = 'id';

    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';

    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';


    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    private $username;
    /**
     * @var string
     */
    private $password;

}
