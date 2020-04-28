<?php
function kaijiang($wanfa,$content,$peilv,$money,$result){
    $da=['5','6','7','8','9'];
    $xiao=['0','1','2','3','4'];
    $dan=['1','3','5','7','9'];
    $shuang=['0','2','4','6','8'];
    $zhi=['1','2','3','5','7'];
    $he=['0','4','6','8','9'];
    $arr=explode('-',$content);
    $resarr=explode(',',$result);
    $zong=0;
    foreach ($resarr as $v){
        $zong=$zong+$v;
    }
    switch ($wanfa){
        case  'LHE':
            if($arr[0]=='15'){
                if($arr[1]=='L'){
                    if($resarr[0]>$resarr[4]){
                        return $peilv*$money;
                    }else{
                        return -$money;
                    }
                }
                if($arr[1]=='H'){
                    if($resarr[0]<$resarr[4]){
                        return $peilv*$money;
                    }else{
                        return -$money;
                    }
                }
                if($arr[1]=='E'){
                    if($resarr[0]==$resarr[4]){
                        return $peilv*$money;
                    }else{
                        return -$money;
                    }
                }

            }

        case  'DX':
            if($arr[1]=='D'){
                if(in_array($resarr[$arr[0]],$da)){
                    return $peilv*$money;
                }else{
                    return -$money;
                }

            }
            if($arr[1]=='X'){
            if(in_array($resarr[$arr[0]],$xiao)){
                return $peilv*$money;
            }else{
                return -$money;
            }

            }

        case  'DS':
            if($arr[1]=='D'){
                if(in_array($resarr[$arr[0]],$dan)){
                    return $peilv*$money;
                }else{
                    return -$money;
                }

            }
            if($arr[1]=='S'){
                if(in_array($resarr[$arr[0]],$shuang)){
                    return $peilv*$money;
                }else{
                    return -$money;
                }

            }
        case  'ZH':
            if($arr[1]=='D'){
                if(in_array($resarr[$arr[0]],$zhi)){
                    return $peilv*$money;
                }else{
                    return -$money;
                }

            }
            if($arr[1]=='X'){
                if(in_array($resarr[$arr[0]],$he)){
                    return $peilv*$money;
                }else{
                    return -$money;
                }

            }
        case  'SZ':
            $arrsz=explode(',',$arr[1]);
            $smoney=$money/count($arrsz);
            if(in_array($resarr[$arr[0]],$arrsz)){
                return $peilv*$smoney;
            }else{
                return -$money;
            }

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