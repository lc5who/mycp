<?php


namespace app\api\controller;


use think\worker\Server;
use Workerman\Lib\Timer;

class Worker extends Server
{
    protected $processes=1;
    public function onWorkerStart($work)
    {
        Timer::add(5,function (){
            require_once dirname(__FILE__).'/Caiji.php';
            $Api = new Caiji();
            $Api->index();
        });


    }

}