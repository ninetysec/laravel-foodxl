<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'category';

    public    $timestamps = false;

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\
    // 
    public static function index()
    {
    	$model = self::where('parent_id',0)->with('son')->get()->toArray();

    	return $model;
    }

    public function son()
    {
        return $this->hasOne('App\Model\Api\Category', 'parent_id', 'cat_id');
    }
}
