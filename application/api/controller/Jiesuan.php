<?php


namespace app\api\controller;


use think\Db;
use think\Exception;
use think\worker\Server;
use Workerman\Lib\Timer;

class Jiesuan extends Server
{

    protected $processes=8;
//    protected $socket    = '';
    protected $protocol  = 'websocket';
    protected $host      = '0.0.0.0';
    protected $port      = '2347';
    public function onWorkerStart($work)
    {

    }

    public function onMessage($connection, $task_data)
    {
        $task_data = json_decode($task_data, true);
        $csk=$task_data['csk'];
        if($task_data['number']){

            $betlist=Db::name('bet')->where('csk',$csk)->where('status','0')
                ->where('qishu',$task_data['no'])
                ->select();
            foreach ($betlist as $k=>$v){


                $win=kaijiang($csk,$v['wanfa'],$v['zhudan'],$v['odds'],$v['money'],$task_data['number']);
                $data=[
                    'endtime'=>time(),
                    'result'=>$task_data['number'],
                    'status'=>'1',
                    'win'=>$win,
                ];
                Db::table('user_wallet')->where('uid',$v['uid'])
                    ->setInc('coin',$win);
                Db::name('bet')->where('id',$v['id'])->update($data);


            }


            try{


            }catch (Exception $e){
                echo $e->getMessage();
            }

        }


//        var_dump($task_data) ;
    }

}