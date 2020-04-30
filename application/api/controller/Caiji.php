<?php
/**
 * Created by PhpStorm.
 * User: LazyQ
 * Date: 2020-04-28
 * Time: 08:43
 */

namespace app\api\controller;


use app\api\model\Opresult as OpresultModel;
use Workerman\Connection\AsyncTcpConnection;

class Caiji
{
    public function index()
    {
        $apiurl=[
            '21'=>'http://mycp.com/api/oplottery/jsssc',
            '17'=>'http://mycp.com/api/oplottery/jssc',
            '20'=>'http://mycp.com/api/oplottery/yflhc',
        ];

        foreach ($apiurl as $k=>$v){
            $res=http_get($v);
            $opdata=(array)json_decode($res);
            $res=OpresultModel::where('csk',$k)->where('qishu',$opdata['no'])->find();
            if(!$res){
                $data=[
                    'qishu'=>$opdata['no'],
                    'datetime'=>time(),
                    'status'=>1,
                    'result'=>$opdata['number'],
                    'len'=>$opdata['len'],
                    'jsstatus'=>'0',
                    'csk'=>$k,
                ];
                OpresultModel::insert($data);

                $task_connection = new AsyncTcpConnection('ws://0.0.0.0:2347');

                $task_connection->connect();
                $task_connection->send(json_encode($opdata));


//            $task_connection->close();

                echo $k.'开奖结果:期数'.$opdata['no'].'号码:'.$opdata['number'].PHP_EOL;

            }
           // echo '极速时时彩暂未开奖'.PHP_EOL;

        }

    }
}