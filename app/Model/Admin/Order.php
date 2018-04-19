<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'order_info';

    public    $timestamps = false;

    // protected $appends = ['cat_name'];
    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];

    // 订单状态
    const OS_UNCONFIRMED     = 0; // 未确认
    const OS_CONFIRMED       = 1; // 已确认
    const OS_CANCELED        = 2; // 已取消
    const OS_RETURNED        = 4; // 退货

    // 支付状态
    const PS_UNPAYED         = 0; // 未付款
    const PS_PAYED           = 2; // 已付款

    public static function getList(array $attributes)
    {
        extract($attributes);

        $per_page = isset($per_page) ? $per_page : 20;
        
        $model = self::orderBy('add_time', 'DESC')
                ->paginate($per_page)
                ->toArray();

        return $model;
    }

    public static function info(array $attributes)
    {
        extract($attributes);

        if (!is_null($model = self::where('order_id',$id)->with('order_goods')->first()))
        {
            $model = $model->toArray();
        }

        return $model;
    }

    public static function make_order_sn()
    {
        // 两种随机方案
        mt_srand((double) microtime() * 1000000);

        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    public function order_goods()
    {
        return $this->hasOne('App\OrderGoods', 'order_id', 'order_id');
    }
}
