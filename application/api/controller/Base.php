<?php


namespace app\api\controller;


use app\api\model\Opentime as OptimeModel;
use app\api\model\Opresult as OpresultModel;
use think\Controller;

class Base extends Controller
{

    public function opdata($csk,$no,$number,$len=5)
    {
        return json(['csk'=>$csk, 'no'=>$no,'number'=>$number,'len'=>$len]);
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
    function randKeysc($len=7){
        $array=array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49");
        $charsLen = count($array) - 1;
        shuffle($array);
        $output = "";
        for ($i=0; $i<$len; $i++){
            srand((double)microtime()*1000000);
            $output .= $array[mt_rand(0, $charsLen)].",";
        }
        return rtrim($output, ',');
    }
    function randKeysb($len){
        $array=array("01","02","03","04","05","06","07","08","09","10");
        $charsLen = count($array) - 1;
        shuffle($array);
        $output = "";
        //  for ($i=0; $i<$len; $i++){

        $a= $array[mt_rand(0, $charsLen)];
        $b= $array[mt_rand(0, $charsLen)];
        while($a==$b)
        {
            $b= $array[mt_rand(0, $charsLen)];
        }
        $c=$array[mt_rand(0, $charsLen)];
        while($c==$a||$c==$b)
        {
            $c= $array[mt_rand(0, $charsLen)];
        }

        $d= $array[mt_rand(0, $charsLen)];
        while($d==$a||$d==$b||$d==$c)
        {
            $d= $array[mt_rand(0, $charsLen)];
        }
        $e= $array[mt_rand(0, $charsLen)];
        while($e==$a||$e==$b||$e==$c||$e==$d)
        {
            $e= $array[mt_rand(0, $charsLen)];
        }
        $f= $array[mt_rand(0, $charsLen)];
        while($f==$a||$f==$b||$f==$c||$f==$d||$f==$e)
        {
            $f= $array[mt_rand(0, $charsLen)];
        }
        $g= $array[mt_rand(0, $charsLen)];
        while($g==$a||$g==$b||$g==$c||$g==$d||$g==$e||$g==$f)
        {
            $g= $array[mt_rand(0, $charsLen)];
        }
        $h= $array[mt_rand(0, $charsLen)];
        while($h==$a||$h==$b||$h==$c||$h==$d||$h==$e||$h==$f||$h==$g)
        {
            $h= $array[mt_rand(0, $charsLen)];
        }
        $i= $array[mt_rand(0, $charsLen)];
        while($i==$a||$i==$b||$i==$c||$i==$d||$i==$e||$i==$f||$i==$g||$i==$h)
        {
            $i= $array[mt_rand(0, $charsLen)];
        }
        $j= $array[mt_rand(0, $charsLen)];
        while($j==$a||$j==$b||$j==$c||$j==$d||$j==$e||$j==$f||$j==$g||$j==$h||$j==$i)
        {
            $j= $array[mt_rand(0, $charsLen)];
        }
        //$output .= $array[mt_rand(0, $charsLen)].",";
        //  }
        return $outpuet=$a.','.$b.','.$c.','.$d.','.$e.','.$f.','.$g.','.$h.','.$i.','.$j;
        // return rtrim($output, ',');
    }

//    public function randKeysb($len=5){
//        $rand='';
//        for($x=0;$x<$len;$x++){
//            srand((double)microtime()*1000000);
//            $rand.=($rand!=''?',':'').mt_rand(0,9);
//        }
//        return $rand;
//    }
}