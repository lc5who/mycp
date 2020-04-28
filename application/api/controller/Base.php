<?php


namespace app\api\controller;


use app\api\model\Opentime as OptimeModel;
use app\api\model\Opresult as OpresultModel;
use think\Controller;

class Base extends Controller
{

    public function opdata($csk,$no,$number)
    {
        return json(['csk'=>$csk, 'no'=>$no,'number'=>$number]);
    }
    public function getGameNextNo($csk)
    {
        $now=date('H:i:s');
        $t=time();
        $curNo=OptimeModel::where('csk',$csk)
            ->where('kaipan','gt',$now)
            ->order('qishu')->limit(1)->find();
        if(!$curNo){
            $curNo=OptimeModel::where('csk',$csk)
                ->order('qishu')->limit(1)->find();
            $t=$t+24 * 3600;
        }
        $mdate=date('Y-m-d ',$t);
        $curNo['qishu']=date('Ymd-',$t).$curNo['qishu'];
        $curNo['date']=$mdate;

        return $curNo;
    }

    public function getGameCurNo($csk){
        $now=date('H:i:s');
        $t=time();
        $curNo=OptimeModel::where('csk',$csk)
            ->where('kaijiang','gt',$now)
            ->order('qishu')->limit(1)->find();
        if(!$curNo){
            $curNo=OptimeModel::where('csk',$csk)
                ->order('qishu')->limit(1)->find();
            $t=$t+24 * 3600;
        }
        $mdate=date('Y-m-d ',$t);
        $curNo['qishu']=date('Ymd-',$t).$curNo['qishu'];
        $curNo['date']=$mdate;
        return $curNo;
    }
    public function getGameZdData($csk,$lastNo){
        $curRes=OpresultModel::where('csk',$csk)
            ->where('qishu',$lastNo)
            ->find();
        if(!$curRes){
            return $curRes['result'];
        }
        return '';
    }
    public function getGameLastNo(int $csk){
        $now=date('H:i:s');
        $t=time();
        $curNo=OptimeModel::where('csk',$csk)
            ->where('kaijiang','lt',$now)
            ->order('qishu desc')->limit(1)->field('qishu')->find();
        if(!$curNo){
            $curNo=OptimeModel::where('csk',$csk)
                ->order('qishu desc')->limit(1)->field('qishu')->find();
            $t=$t-24 * 3600;
        }
        $mdate=date('Y-m-d ',$t);
        $curNo['date']=$mdate;
        return date('Ymd-',$t).$curNo['qishu'];
    }
    public function randKeys($len=5){
        $rand='';
        for($x=0;$x<$len;$x++){
            srand((double)microtime()*1000000);
            $rand.=($rand!=''?',':'').mt_rand(0,9);
        }
        return $rand;
    }
}