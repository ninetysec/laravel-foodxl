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
    public static function index(array $attributes)
    {
        extract($attributes);

        $where = isset($index) ? ['index' => 1,'parent_id' => 0] : ['parent_id' => 0];

        $model = self::where($where)->with('son')->get();

    	return $model;
    }

    public function son()
    {
        return $this->hasMany('App\Model\Api\Category', 'parent_id', 'cat_id');
    }
}
