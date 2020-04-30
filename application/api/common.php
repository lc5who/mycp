<?php
function kaijiang($csk,$wanfa,$content,$peilv,$money,$result){
    if($csk=='3'){
        return yifenklsfkj($wanfa,$content,$peilv,$money,$result);
    }
    if($csk=='17'){
        return yifensckj($wanfa,$content,$peilv,$money,$result);
    }
    if($csk=='20'){
        return yifenlhckj($wanfa,$content,$peilv,$money,$result);
    }
    if($csk=='21'){
        return yifenssckj($wanfa,$content,$peilv,$money,$result);
    }
    if($csk=='32'){
        return yifenkskj($wanfa,$content,$peilv,$money,$result);
    }
    if($csk=='35'){
        return yifensyxwkj($wanfa,$content,$peilv,$money,$result);
    }
}
function yifenkskj($wanfa,$content,$peilv,$money,$result)
{
    $resarr=explode(',',$result);
    $zonghe=0;
    foreach ($resarr as $v){
        $zonghe=$zonghe+$v;
    }
    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case 'duanpai':
            foreach ($carr as $k =>$v){
                if(strpos($result,$v.','.$v)){
                    $win=$win+$danzhu*$peilv;
                }else{
                    $win=$win-$danzhu;
                }
            }
            return $win;
        case 'sanjun':
            foreach ($carr as $k =>$v){
                if(strpos($result,$v)){
                    $win=$win+$danzhu*$peilv;
                }else{
                    $win=$win-$danzhu;
                }
            }
            return $win;
        case 'zonghe':
            if($resarr[0]==$resarr[1]&& $resarr[1]==$resarr[2]){
                return -$money;
            }
            foreach ($carr as $k=>$v){
                if($v=='dan'){
                    if($zonghe%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($zonghe%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='da'){
                    if($zonghe>=11 && $zonghe<=17 ){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($zonghe>=4 && $zonghe<=10){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }
            return $win;


    }

}
function yifensyxwkj($wanfa,$content,$peilv,$money,$result)
{
    $resarr=explode(',',$result);
    $zonghe=0;
    foreach ($resarr as $v){
        $zonghe=$zonghe+$v;
    }
    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case  'wuxuanyi':
            foreach ($carr as $k =>$v){
                if(strpos($result,$v)){
                    $win=$win+$danzhu*$peilv;
                }else{
                    $win=$win-$danzhu;
                }
            }
            return $win;
        case 'yiliangmian':
            if($resarr[0]=='11'){
                return $money;
            }
            foreach ($carr as $k=>$v){

                if($v=='dan'){
                    if($resarr[0]%2==1){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($resarr[0]%2==0){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='da'){
                    if($resarr[0]>=6){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($resarr[0]<6){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }

            }
            return $win;

        case 'zonghe':
            foreach ($carr as $k=>$v){
                if($v=='dan'){
                    if($zonghe%2==1){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($zonghe%2==0){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='da'){
                    if($zonghe=='30'){
                        $win=$win+$danzhu;
                    }
                    if($zonghe>30){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($zonghe=='30'){
                        $win=$win+$danzhu;
                    }
                    if($zonghe<30){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
            }


            return $win;
    }


}
function yifenklsfkj($wanfa,$content,$peilv,$money,$result)
{
    $resarr=explode(',',$result);
    $zonghe=0;
    foreach ($resarr as $v){
        $zonghe=$zonghe+$v;
    }
    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case 'baliangmian':
            foreach ($carr as $k=>$v){
                if($v=='da'){
                    if($resarr[7]>=11){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($resarr[7]<=10){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='dan'){
                    if($resarr[7]%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($resarr[7]%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
        case 'yiliangmian':
            foreach ($carr as $k=>$v){
                if($v=='da'){
                    if($resarr[0]>=11){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($resarr[0]<=10){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='dan'){
                    if($resarr[0]%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($resarr[0]%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
        case 'zonghe':
            foreach ($carr as $k=>$v){
                if($v=='dan'){
                    if($zonghe%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($zonghe%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='da'){
                    if($zonghe=='84'){
                        $win=$win+$danzhu;
                    }
                    if($zonghe>84){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($zonghe=='84'){
                        $win=$win+$danzhu;
                    }
                    if($zonghe<84){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
    }

}
function yifensckj($wanfa,$content,$peilv,$money,$result)
{
    $resarr=explode(',',$result);
    $gyhe=$resarr[0]+$resarr[1];
    $guanjun=$resarr[0];

    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case 'guanjun':
            foreach ($carr as $k =>$v){
                if($v==$guanjun){
                    $win=$win+$danzhu*$peilv;
                }else{
                    $win=$win-$danzhu;
                }
            }
            return $win;
        case 'guanyahe':
            foreach ($carr as $k =>$v){
                if($v=='hedan'){
                    if($gyhe%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='heshuang'){
                    if($gyhe%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='heda'){
                    if($gyhe>11){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='hexiao'){
                    if($gyhe<=11){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
        case 'shuangmian':
            foreach ($carr as $k =>$v){
                if($v=='dan'){
                    if($guanjun%2==1){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if($guanjun%2==0){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='da'){
                    if($guanjun>5){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if($guanjun<=5){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
    }

}

function yifenlhckj($wanfa,$content,$peilv,$money,$result){
    $da='25、27、29、31、33、35、37、39，41、43、45、47、26、28、30、32、34、36、38、40，42、44、46、48';
    $xiao='01、03、05、07、09、11、13、15，17、19、21、23、02、04、06、08、10、12、14、16，18、20、22、24';
    $dan='01、03、05、07、09、11、13、15，17、19、21、23,25、27、29、31、33、35、37、39，41、43、45、47';
    $shuang='02、04、06、08、10、12、14、16，18、20、22、24,26、28、30、32、34、36、38、40，42、44、46、48';


    $red='01、02、07、08、12、13、18、19、23、24、29、30、34、35、40、45、46 ';
    $lv='05、06、11、16、17、21、22、27、28、32、33、38、39、43、44、49';
    $lan='03、04、09、10、14、15、20、25、26、31、36、37、41、42、47、48';
    $shengxiao=[
        'shu'=>'01、13、25、37、49',
        'niu'=>'12、24、36、48',
        'hu'=>'11、23、35、47',
        'tu'=>'10、22、34、46',
        'long'=>'09、21、33、45',
        'she'=>'08、20、32、44',
        'ma'=>'07、19、31、43',
        'yang'=>'06、18、30、42',
        'hou'=>'05、17、29、41',
        'ji'=>'04、16、28、40',
        'gou'=>'03、15、27、39',
        'zhu'=>'02、14、26、38',
//        'niu'=>'12、24、36、48',
    ];
    $resarr=explode(',',$result);
    $tema=$resarr[-1];
    $tmsb='';
    if(!strpos($red,$tema)){
        $tmsb='hong';
    }
    if(!strpos($lv,$tema)){
        $tmsb='lv';
    }
    if(!strpos($lan,$tema)){
        $tmsb='lan';
    }

    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case 'sebo':
            foreach ($carr as $k =>$v){
                if($v=='hong'){
                    if($tmsb==$v){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='lv'){
                    if($tmsb==$v){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='lan'){
                    if($tmsb==$v){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
            }

            return $win;
        case 'shuangmian':
            foreach ($carr as $k =>$v){
                if($v=='da'){
                    if(strpos($da,$tema)){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if(strpos($xiao,$tema)){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='dan'){
                    if(strpos($dan,$tema)){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if(strpos($shuang,$tema)){
                        $win=$win+ $peilv*$danzhu;
                    }
                    else{
                        $win=$win-$danzhu;
                    }
                }

            }
            return $win;
        case 'shengxiao':
            foreach ($carr as $p=>$j){
                foreach ($shengxiao as $k => $v){
                    if($j==$k){
                        if(strpos($v,$tema)){
                            $win=$win+ $peilv*$danzhu;
                        }
                        else{
                            $win=$win-$danzhu;
                        }
                    }
                }
            }

            return $win;
        default :
            return $win;
    }
}
function yifenssckj($wanfa,$content,$peilv,$money,$result){
    $da=['5','6','7','8','9'];
    $xiao=['0','1','2','3','4'];
    $dan=['1','3','5','7','9'];
    $shuang=['0','2','4','6','8'];
    $zhi=['1','2','3','5','7'];
    $he=['0','4','6','8','9'];
//    $arr=explode('-',$content);
    $resarr=explode(',',$result);
    $zong=0;
    foreach ($resarr as $v){
        $zong=$zong+$v;
    }
    $carr=explode(',',$content);
    $danzhu=$money/count($carr);
    $win=0;
    switch ($wanfa){
        case  'wuxuanyi':

            foreach ($carr as $k =>$v){
                if(strpos($result,$v)){
                    $win=$win+$danzhu*$peilv;
                }else{
                    $win=$win-$danzhu;
                }
            }

            return $win;
        case  'yivwu':
            foreach ($carr as $k =>$v){
                if($v=='long'){
                    if($resarr[0]>$resarr[4]){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='hu'){
                    if($resarr[0]<$resarr[4]){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='he'){
                    if($resarr[0]==$resarr[4]){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
            }
            return $win;
        case 'shuangmian':
            foreach ($carr as $k =>$v){
                if($v=='da'){
                    if(in_array($resarr[0],$da)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='xiao'){
                    if(in_array($resarr[0],$xiao)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='dan'){
                    if(in_array($resarr[0],$dan)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='shuang'){
                    if(in_array($resarr[0],$shuang)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='zhi'){
                    if(in_array($resarr[0],$zhi)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }
                if($v=='he'){
                    if(in_array($resarr[0],$he)){
                        $win=$win+$danzhu*$peilv;
                    }else{
                        $win=$win-$danzhu;
                    }
                }

            }
            return $win;

    }
}

function writeJson($code=0,$msg='',$data=[]){
    $data=['code'=>$code,
        'msg'=>$msg,
        'data'=>$data,
        ];
    return json($data);
}
function http_get($url, $data = array()) {
    $curl = curl_init();

    if($data){
        $submit_url = $url;
    }else{

        //这里的$data 如果传递的是数组需要   http_build_query($data)
        $submit_url = $url . '?' . http_build_query($data);
    }

    curl_setopt($curl, CURLOPT_URL, $submit_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT,60);

    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}