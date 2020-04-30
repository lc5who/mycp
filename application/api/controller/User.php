<?php


namespace app\api\controller;


use app\admin\model\lottery\Orders;
use app\api\model\Wallet;
use think\Controller;
use app\api\model\User as UserModel;
use think\Db;
use think\Exception;
use think\Request;

use app\admin\model\Lottery as LotteryModel;
class User extends Base
{
    public $user;
    public $wallet;
    public function _initialize()
    {
        //echo '1';
        //验证token 获取用户
        parent::_initialize();
        //var_dump( $_SERVER);
        $token=$this->request->header('AUTHORIZATION');
        //var_dump($token);
        //echo $token ;die;
        if(empty($token)){
            // writeJson(-1,'非法请求');die;
            echo json_encode(['code'=>-1,'msg'=>'非法请求']);die;
        }
        $redis=new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->auth('123321');

        $userinfo=$redis->hGetAll($token);
        //var_dump($userinfo);
        $userinfo['uid']=3049;
        $this->user=UserModel::where('id',$userinfo['uid'])->find();
        $this->wallet=Wallet::where('uid',$userinfo['uid'])->find();
    }

    public function getUserBets(Request $request)
    {
        if($request->isPost()){

            $flag=$request->post('flag',0);
            if($flag==0){
                $list=Orders::where('uid',$this->user['id'])->where('status',$flag)
                    ->field('type,qishu,wanfa,zhudan,money,result,win,csk')
                    ->order('id desc')->limit(20)->select();
            }
            if($flag==1){
                $list=Orders::where('uid',$this->user['id'])->where('win','gt',0)
                    ->field('type,qishu,wanfa,zhudan,money,result,win,csk')
                    ->order('id desc')->limit(20)->select();
            }
            if($flag==2){
                $list=Orders::where('uid',$this->user['id'])
                    ->field('type,qishu,wanfa,zhudan,money,result,win,csk')
                    ->order('id desc')->limit(20)->select();
            }
            return writeJson(0,'success',$list);


        }
        return writeJson('-1','参数错误');
//        return $this->user['id'];
//        Db::name('bet')->where('uid',$this->user['id']);

    }

    public function getUserPeilv()
    {
        $peilv=config('apipeilv');
        return json($peilv);
    }
    public function bet(Request $request)
    {
        //dump($this->user);die;
//         dump(config('peilv.21'));die;

        //{"csk":"SSCJSC","drawNumber":"11439027","bets":[{"game":"ZDX","contents":"D","amount":1,"odds":1.99},{"game":"LH","contents":"H","amount":1,"odds":1.99}],"ignore":false}
        if($request->isPost()){
            $betData=$request->post();
//            if(!isset($betData['csk'])){
//                return writeJson('-1','参数错误');
//            }
            try{
                $csk=$betData['csk'];
                $lotter=LotteryModel::where('csk',$csk)
                    ->where('opswitch',1)
                    ->find();
                if(!$lotter){
                    return writeJson('-1','当前彩种并未开放');

                }
                $peilv=config('peilv.'.$csk);

                $curNo=$this->getGameCurNo($csk);
                $ts=time();
                if(strtotime($curNo['date'].$curNo['fengpan'])<=$ts){
                    return writeJson('-1','当期已封盘');
                }
                if(strtotime($curNo['date'].$curNo['kaipan'])>=$ts){
                    return writeJson('-1','当期未开盘');
                }
                if($betData['drawNumber']!=$curNo['qishu']){
                    return writeJson('-1','当前期数未开盘');

                }
                $bets=$betData['bets'];
                $betMoney=0;
//                echo '1';die;

                $insertData=[];
                foreach ( $bets as $k=>$v){
                    $obj=$v;
                    //$obj=(array)json_decode($v);
                    $betMoney=$betMoney+$obj['amount'];

                }
//                echo '2';die;
                if($this->wallet['coin']<$betMoney){
                    return writeJson('-1','用户余额不足');
                }


                    $insertData[]=[
                        'did'=>$this->orderSn(),
                        'uid'=>$this->user['id'],
                        'username'=>$this->user['bind_phone'],

                        'type'=>$lotter['name'],
                        'qishu'=>$curNo['qishu'],
                        'wanfa'=>$bets[0]['game'],
                        'zhudan'=>$bets[0]['contents'],
                        'odds'=>$peilv[$obj['game']],
                        'money'=>$bets[0]['amount'],
                        'win'=>'0',
                        'js'=>'0',
                        'csk'=>$csk,

                    ];

//                $insertData[]=[
//                    'did'=>$this->orderSn(),
//                    'uid'=>$this->user['id'],
//                    'username'=>$this->user['bind_phone'],
//
//                    'type'=>$lotter['name'],
//                    'qishu'=>$curNo['qishu'],
//                    'wanfa'=>$obj['game'],
//                    'zhudan'=>json_encode($bets),
//                    'odds'=>$peilv[$obj['game']],
//                    'money'=>$obj['amount'],
//                    'win'=>'0',
//                    'js'=>'0',
//                    'csk'=>$csk,
//
//                ];
                $res=Db::name('bet')->insertAll($insertData);
                if(true){
                    return writeJson('0','下注成功');

                }
                return writeJson('-1','下注失败,异常');

//                $insertData=[
//                    'did'=>date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8),
//                    'uid'=>$this->user['id'],
//                    'username'=>$this->user['bind_phone'],
////                    'username'=>$this->user['bind_phone'],
//                    'type'=>$curNo['name'],
//                    'qishu'=>$curNo['qishu'],
//
//                ];


            }catch (Exception $e){
                return $e->getMessage();
                return writeJson('-1','参数错误');
            }

            //$csk=isset($betData['csk'])?$betData['csk']:-1;

        }
        return writeJson('-1','参数错误');


       // dump((array)UserModel::all());
    }

    public function orderSn()
    {
        //$res=0;
        do{
            $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
            $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
            $res=Orders::where('did',$orderSn)->find();
        }while($res);
        return $orderSn;
    }

//    public function getRedis()
//    {
//
//    }
}