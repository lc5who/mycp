<?php

namespace app\index\controller;

use app\common\controller\Frontend;
//use think\Cache;

//use think\session\driver\Redis;

use think\Cache;
use think\cache\driver\Redis;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
//        phpinfo();
//        Cache::store('redis');

//        Cache::store('redis')-> set('user','user');
        $redis=new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->auth('123321');
//        $redis->hGet();
        $data=["live_level"=> "7",
  "invite_id"=> "",
  "coin"=> "87",
  "followed"=> "0",
  "uid"=> "3055",
  "phone"=> "15324745601",
  "gender"=> "1",
  "game_account"=> "6ercaimei3055",
  "level"=> "4",
  "register_time"=> "1587802046",
  "user_type"=> "user",
  "auth"=> "2",
  "nick"=> "夜游3055",
  "intro"=> "",
  "avatar"=> "",
  "game_coin"=> "0",
  "vip_expire"=> "0",
  "follow"=> "0",
  "auto_change"=> "0",
  "dot"=> "1710",
  "is_anchor"=> "1"];

        $redis->hMSet('login_token:0d4c3a7e-2afe-487d-bab7-c96d15b60693',$data);


//        echo '1';
    }

}
