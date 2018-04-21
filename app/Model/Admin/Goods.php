<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'goods';

    protected $primaryKey = 'goods_id';

    public    $timestamps = false;

    // protected $appends = ['cat_name'];

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\

    public static function getList(array $attributes)
    {
        extract($attributes);

        $per_page = isset($per_page) ? $per_page : 20;
        
        $model = self::orderBy('sort_order', 'ASC')
                ->orderBy('add_time', 'DESC')
                ->paginate($per_page)
                ->toArray();

        return $model;
    }

    public static function info(array $attributes)
    {
        extract($attributes);

    	$model = self::where('goods_id',$id)->with('GoodsAttr')->first();

    	return $model;
    }

    public static function act(array $attributes)
    {
        extract($attributes);

        if ($action == 'insert')
        {
            if (isset($attr_values) && $attr_values = json_decode($attr_values,true))
            {
                if (isset($attr_values['attr']))
                {
                    foreach ($attr_values['attr'] as $value)
                    {
                        GoodsAttr::insert($value);
                    }
                }
            }

            $data = [
                'goods_name'   => $name,
                'goods_desc'   => isset($desc) ? $desc : '',
                'shop_price'   => isset($price) ? $price : 0,
                'is_on_sale'   => isset($is_on_sale) ? $is_on_sale : 1,
                'sort_order'   => isset($sort_order) ? $sort_order : 0,
                'add_time'     => time(),
            ];

            if (isset($cat_id) && !is_null(self::where('cat_id',$cat_id)->first())) $data['cat_id'] = $cat_id;

            if (self::insertGetId($data)) return true;
        }
        elseif ($action == 'update')
        {
            $id = isset($id) ? $id : 0;

            if (isset($attr_values) && $attr_values = json_decode($attr_values,true))
            {
                if (isset($attr_values['attr']))
                {
                    foreach ($attr_values['attr'] as $value)
                    {
                        $value['goods_attr_id'] = isset($value['goods_attr_id']) ? $value['goods_attr_id'] : 0;

                        GoodsAttr::where('goods_id',$value['goods_attr_id'])->update($value);
                    }
                }
            }

            if (!is_null($model = self::where('goods_id',$id)->first()))
            {
                $model->goods_name = $name;
                $model->goods_desc = isset($desc) ? $desc : ' ';
                $model->shop_price = isset($price) ? $price : 0;
                $model->is_on_sale = isset($is_on_sale) ? $is_on_sale : 1;
                $model->sort_order = isset($sort_order) ? $sort_order : 0;

                if (isset($cat_id) && !is_null(self::where('cat_id',$cat_id)->first())) $model->cat_id = $cat_id;

                if ($model->save()); return true;
            }
        }

        return false;
    }

    public function GoodsAttr()
    {
        return $this->hasOne('App\GoodsAttr', 'goods_id', 'goods_id');
    }
}
