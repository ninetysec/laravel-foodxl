<?php

namespace App\Model\Api;

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

    public static function getList()
    {
        if (!isset($user_id))
        {
            $model = self::where('skey',session('key'))->with('contact')->get();
        }

        return $model;
    }

    // 
    public static function info(array $attributes)
    {
        extract($attributes);

        if ($model = self::where('order_id',$id)->with('contact')->with('order_goods')->get())
        {
            $model = $model->toArray();
        }

        return $model;
    }

    // 
    public static function search(array $attributes)
    {
        extract($attributes);

        $arr = Contact::where('phone',$phone)->pluck('id');

        if ($model = self::whereIn('contact_id',$arr)->with('contact')->get())
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
        return $this->hasOne('App\Model\Api\OrderGoods', 'order_id', 'order_id');
    }

    public function contact()
    {
        return $this->hasOne('App\Model\Api\Contact', 'id', 'contact_id');
    }
}
