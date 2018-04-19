<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'contact';

    public    $timestamps = false;

    // protected $appends = ['cat_name'];
    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];
    // 
}
