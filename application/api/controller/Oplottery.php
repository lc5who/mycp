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

        return $this->opdata('21',$lastNo,$opencode,'5');

    }
    public function jssc()
    {
        $lastNo=$this->getGameLastNo('17');
        //echo $lastNo;die;
        $zddata = $this->getGameZdData('17',$lastNo);
        $opencode =$zddata;
        if(!$opencode){
            $opencode=$this->randKeysb('10');
        }

        return $this->opdata('17',$lastNo,$opencode,'10');

    }

    public function yflhc()
    {
        $lastNo=$this->getGameLastNo('20');
        //echo $lastNo;die;
        $zddata = $this->getGameZdData('20',$lastNo);
        $opencode =$zddata;
        if(!$opencode){
            $opencode=$this->randKeysc('7');
        }

        return $this->opdata('20',$lastNo,$opencode,'7');

    }



}