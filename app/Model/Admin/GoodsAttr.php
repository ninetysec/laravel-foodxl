<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'goods_attr';

    protected $primaryKey = 'goods_attr_id';

    public    $timestamps = false;

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\
    // 

}
