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
        $res=http_get('http://mycp.com/api/oplottery/jsssc');
        $opdata=(array)json_decode($res);
        $res=OpresultModel::where('csk',21)->where('qishu',$opdata['no'])->find();
        if(!$res){
            $data=[
                'qishu'=>$opdata['no'],
                'datetime'=>time(),
                'status'=>1,
                'result'=>$opdata['number'],
                'len'=>'5',
                'jsstatus'=>'0',
                'csk'=>21,
            ];
            OpresultModel::insert($data);

            $task_connection = new AsyncTcpConnection('ws://0.0.0.0:2347');

            $task_connection->connect();
            $task_connection->send(json_encode($opdata));


//            $task_connection->close();

            echo '极速时时彩开奖结果:期数'.$opdata['no'].'号码:'.$opdata['number'].PHP_EOL;

        }
        echo '极速时时彩暂未开奖'.PHP_EOL;
    }
}