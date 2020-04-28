<?php
/**
 * Created by PhpStorm.
 * User: LazyQ
 * Date: 2020-04-28
 * Time: 08:14
 */

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

            file_put_contents('test.txt', time() . PHP_EOL);


        });

    }

}