<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'goods';

    public    $timestamps = false;

    protected $appends = ['cat_name'];

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];
    // 
    public static function index(array $attributes)
    {
        extract($attributes);

        $goods = self::where('cat_id',$id)->with('GoodsAttr')->get();

        $cat = Category::where('cat_id',$id)->first();

        return ['goods' => $goods, 'cat' => $cat];
    }

    // 
    public static function info(array $attributes)
    {
        extract($attributes);

    	$model = self::where('goods_id',$id)->with('GoodsAttr')->first();

    	return $model;
    }

    public function GoodsAttr()
    {
        return $this->hasOne('App\Model\Api\GoodsAttr', 'goods_id', 'goods_id');
    }

    public function getCatNameAttribute()
    {
        return Category::where('cat_id',$this->cat_id)->value('cat_name');
    }
}
