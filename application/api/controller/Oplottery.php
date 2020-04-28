<?php


namespace app\api\controller;


use think\Controller;
use app\api\model\Opresult as OpresultModel;
use app\api\model\Opentime as OptimeModel;
use Workerman\Connection\AsyncTcpConnection;

class Oplottery extends Base
{
    public function jsssc()
    {
        $lastNo=$this->getGameLastNo('21');
        //echo $lastNo;die;
        $zddata = $this->getGameZdData('21',$lastNo);
        $opencode =$zddata;
        if(!$opencode){
            $opencode=$this->randKeys();
        }

        return $this->opdata('21',$lastNo,$opencode);

    }



}