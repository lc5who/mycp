<?php

namespace app\admin\model\lottery;

use think\Model;
use app\admin\model\Lottery as LotteryModel;

class Lotteryt extends Model
{

    

    

    // 表名
    protected $name = 'opentime';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    







    public function lottery()
    {
        return $this->belongsTo(LotteryModel::class, 'csk', 'csk', [], 'LEFT')->setEagerlyType(0);
    }
}
