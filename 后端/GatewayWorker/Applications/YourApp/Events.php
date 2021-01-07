<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use Workerman\Lib\Timer;
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static $db = null;
    //强烈建议在onWorkerStart回调中初始化redis、mysql数据库连接，
    public static function onWorkerStart($businessWorker)
    {
        var_dump('onWorkstart');
        require_once ('Connection.php');
        ini_set('default_socket_timeout', -1); //redis不超时
        global $redis;
        $redis = new Redis();
        self::$db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', 'LiveDatabase', 'Z38PGPYwXNarMwyS', 'livedatabase');
        $redis->connect('127.0.0.1', 6379);

        $time_interval = 30;
        Timer::add($time_interval, function()
        {
            global $redis;
            for ($room_id=1; $room_id<=3; $room_id++) {
                $room_info = self::$db->query("SELECT * FROM `live` where `id` = $room_id order by `id` ");
                if (!$room_info){
                    return Gateway::sendToGroup($room_id,self::apiError('not_found'));
                }
                $count =  Gateway::getClientCountByGroup($room_id);
                $beilv = $redis->get('beilv');
                if(!$beilv){
                    $beilv = 1;
                }
                $beilv = (float)$beilv;

                $room_info[0]["count"] = intval($count * $beilv);

                Gateway::sendToGroup($room_id,self::apiSuccess($room_info[0],'room_info'));
            }

        });


    }

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        // 向当前client_id发送数据
       // global $redis;
        //Gateway::sendToClient($client_id,  $redis->get('user_34'));
        // 向所有人发送
        Gateway::sendToClient($client_id,  'hello');
//        Gateway::sendToAll("$client_id login\r\n");
    }

    public static function getMillisecond()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectimes = substr($msectime, 0, 13);
    }

        /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {
        // 向所有人发送 





       if (is_null(json_decode($message))){

           return Gateway::sendToClient($client_id, self::apiError('UNAUTH'));
       }
       $json = json_decode($message,true);

       $type =$json['type'];
        global $redis;
       switch ($type){
           case 'enter':
               //进入直播间
               $room_id = $json['room_id'];
               //获取直播间内容

               $room_info = self::$db->query("SELECT * FROM `live` where `id` = $room_id order by `id` ");
                if (!$room_info){
                    return Gateway::sendToClient($client_id,self::apiError('not_found'));
                }
               Gateway::joinGroup($client_id,$room_id);
               $count =  Gateway::getClientCountByGroup($room_id);
               $beilv = $redis->get('beilv');
               if(!$beilv){
                   $beilv = 1;
               }
               $beilv = (float)$beilv;
               $room_info[0]["count"] = intval($count * $beilv);


               Gateway::sendToClient($client_id,self::apiSuccess($room_info[0],'room_info'));




               $messages = self::$db->query("SELECT * FROM `message` where `room_id` = $room_id order by `id` asc limit 100");

               //获取消息
               Gateway::sendToClient($client_id,self::apiSuccess($messages,'msg'));


               break;
           case 'send':
               //发送消息
               if (is_null($json['token'])){
                   //没有token
                   return Gateway::sendToClient($client_id, self::apiError('UNAUTH2'));
               }
               if (is_null($json['room_id'])){
                   //没有房间号
                   return Gateway::sendToClient($client_id, self::apiError('参数错误'));
               }
               if (is_null($json['content'])){
                   //没有内容
                   return Gateway::sendToClient($client_id, self::apiError('参数错误'));
               }

               $user = self::checkAuth($client_id, $json['token']);
               if (is_null($user)){
                   //校验失败
                   return Gateway::sendToClient($client_id,self::apiError('UNAUTH3'));
               }
               //判断redis服务器中是否有
               global $redis;

               $token = $redis->get('user_'.$user->id);
               if(!$token){
                   //服务器中没有当前token 异常
                   return Gateway::sendToClient($client_id,self::apiError('当前账号未登录或已掉线'));
               }
               //token 校验成功 redis校验成功

                //保存信息到数据库
                $msg  = array(
                    'username'=>$user->username,
                    'room_id'=>$json['room_id'],
                    'content'=>$json['content'],
                    'create_time'=>time(),
                );
               $insert_id =self::$db->insert('message')->cols($msg)->query();
               if (!$insert_id){
                   return Gateway::sendToClient(self::apiError('内容发送失败,数据库存储失败!'));
               }
               //保存成功 开始发送消息

               return Gateway::sendToGroup($json['room_id'],self::apiSuccess($msg,'msg'));
                //发送消息给其他用户





               //校验token
               break;
           //校验Token
           //保存消息到数据库
           //分发
       }
//
       Gateway::sendToClient($client_id,  '123');
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function checkAuth($client_id, $token){
       $jwtToken = new JwtToken();
       $checkToken = $jwtToken->checkToken($token);

       $data = $checkToken['status'];
       if ($data !== '200'){
           return null;
       }
       return $checkToken['data']['data'];
       //return Gateway::sendToClient($client_id,  $data );
   }
   public static function onClose($client_id)
   {
       // 向所有人发送 
       //GateWay::sendToAll("$client_id logout\r\n");
   }
   public static function apiError($msg){
       $result = [
           'code'=>0,
           'msg'=>$msg,
           'data'=>[]
       ];
      return json_encode($result);
    }
    public static function apiSuccess($data,$msg = ''){
       if ($msg=='msg'){

           if(!is_null($data['username'])){
               $result = [
                   'code'=>1,
                   'msg'=>$msg,
                   'data'=>array($data)
               ];
               return json_encode($result);
           }


               $result = [
                   'code'=>1,
                   'msg'=>$msg,
                   'data'=>$data
               ];
               return json_encode($result);
       }


            $result = [
                'code'=>1,
                'msg'=>$msg,
                'data'=>$data
            ];
            return json_encode($result);



    }
}
