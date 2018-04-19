<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'goods_attr';

    public    $timestamps = false;

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\
    // 

}
