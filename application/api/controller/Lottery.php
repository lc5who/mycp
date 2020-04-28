<?php


namespace app\api\controller;


use app\api\model\Opresult;
use fast\Arr;
use think\Controller;
use think\Request;

//use app\api\model\Opresult as OpresutlModel;
class Lottery extends Base
{
    public function getCurrentInfo(Request $request)
    {
        if($request->isPost()){
            $csk=$request->post('csk',21);
            $curNo=$this->getGameCurNo($csk);

            $lastNo=$this->getGameLastNo($csk);
            $lastData=Opresult::where('csk',$csk)
                ->where('qishu',$lastNo)->find();
            $nextNo=$this->getGameNextNo($csk);
            //var_dump($curNo);die;
            $data=[
                'lastNo'=>$lastNo,
                'lastNoNumber'=>'',
                'curNo'=>$curNo['qishu'],
                'curNofptime'=>strtotime($curNo['date'].$curNo['fengpan']) ,
                'curNokjtime'=>strtotime( $curNo['date'].$curNo['kaijiang']),
                'nextNo'=>$nextNo['qishu'],
                'nextNokptime'=>strtotime($nextNo['date'].$nextNo['kaipan']),

            ];
            if($lastData){
                $data['lastNoNumber']=$lastData['result'];
            }
            return writeJson(0,'susccess',$data);
        }
        return writeJson(-1,'非法请求');
    }

    public function getOpRecord(Request $request)
    {
        if($request->isPost()){
            $csk=$request->post('csk',21);
            $data=Opresult::where('csk',$csk)->
                field('qishu,result')->
            order('id desc')->limit(10)
                ->select();
            return writeJson(0,'susccess',$data);
        }
        return writeJson(-1,'非法请求');
    }
}