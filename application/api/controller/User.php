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
        //验证token 获取用户
        parent::_initialize();
        $this->user=UserModel::where('id',3049)->find();
        $this->wallet=Wallet::where('uid',3049)->find();
    }

    public function bet(Request $request)
    {
        //dump($this->user);die;
//         dump(config('peilv.21'));die;

        //{"lottery":"SSCJSC","drawNumber":"11439027","bets":[{"game":"ZDX","contents":"D","amount":1,"odds":1.99},{"game":"LH","contents":"H","amount":1,"odds":1.99}],"ignore":false}
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

                foreach ($bets as $k =>$v){
                    $insertData[]=[
                        'did'=>$this->orderSn(),
                        'uid'=>$this->user['id'],
                        'username'=>$this->user['bind_phone'],
//                    'username'=>$this->user['bind_phone'],
                        'type'=>$lotter['name'],
                        'qishu'=>$curNo['qishu'],
                        'mingxi_1'=>$obj['game'],
                        'mingxi_2'=>$obj['contents'],
                        'odds'=>$peilv[$obj['game']],
                        'money'=>$obj['amount'],
                        'win'=>'0',
                        'js'=>'0',
//                        'addtime'=>time(),
                        'csk'=>$csk,

                    ];
                }
//                dump($insertData);die;
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
}