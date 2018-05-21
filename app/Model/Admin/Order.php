<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'order_info';

    protected $primaryKey = 'order_id';

    public    $timestamps = false;

    protected $appends = ['pay_status_char','order_status_char'];
    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];

    // 订单状态
    const OS_UNCONFIRMED     = 0; // 未发货
    const OS_CONFIRMED       = 1; // 已发货
    const OS_FINISH          = 2; // 已完成
    const OS_CANCELED        = 3; // 已取消
    const OS_RETURNED        = 4; // 退款

    // 支付状态
    const PS_UNPAYED         = 0; // 未付款
    const PS_PAYED           = 1; // 已付款

    public static function getList(array $attributes)
    {
        extract($attributes);

        $page = isset($page) ? $page : 1;

        $per_page = isset($per_page) ? $per_page : 10;

        $model = self::orderBy('add_time', 'DESC')
                ->with('contact');

        $total = $model->count();

        $data = $model->paginate($per_page)->toArray();

        return ['data' => $data['data'], 'paged' => ['page' => $page, 'per_page' => $per_page, 'total' => $total]];
    }

    public static function info(array $attributes)
    {
        extract($attributes);

        if (!is_null($model = self::where('order_id',$id)->with('order_goods')->with('contact')->first()))
        {
            $model = $model->toArray();
        }

        return $model;
    }

    public static function act(array $attributes)
    {
        extract($attributes);

        if ($action == 'delete')
        {
            if (self::where('order_id',$id)->delete() && OrderGoods::where('order_id',$id)->delete())
            {
                return true;
            }
        }
        elseif ($action == 'status')
        {
            if (!is_null($model = self::where('order_id',$id)->first()))
            {
                $status = json_decode($status,true);

                $model->pay_status = $status['pay_status'];

                $model->order_status = $status['order_status'];

                $model->save();

                return true;
            }
        }

        return false;
    }

    public function getPayStatusCharAttribute()
    {
        switch ($this->pay_status) {
            case self::PS_UNPAYED:
                $char = '未支付';
                break;
            
            case self::PS_PAYED:
                $char = '已支付';
                break;

            default:
                $char = '未知';
                break;
        }

        return $char;
    }

    public function getOrderStatusCharAttribute()
    {
        switch ($this->order_status) {
            case self::OS_UNCONFIRMED:
                $char = '未发货';
                break;

            case self::OS_CONFIRMED:
                $char = '已发货';
                break;

            case self::OS_FINISH:
                $char = '已完成';
                break;

            case self::OS_CANCELED:
                $char = '已取消';
                break;

            case self::OS_RETURNED:
                $char = '退款';
                break;

            default:
                $char = '未知';
                break;
        }

        return $char;
    }

    public static function make_order_sn()
    {
        // 两种随机方案
        mt_srand((double) microtime() * 1000000);

        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    public function order_goods()
    {
        return $this->hasMany('App\Model\Admin\OrderGoods', 'order_id', 'order_id');
    }

    public function contact()
    {
        return $this->hasOne('App\Model\Admin\Contact', 'id', 'contact_id');
    }
}
