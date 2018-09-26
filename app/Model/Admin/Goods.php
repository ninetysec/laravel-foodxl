<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class Goods extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'goods';

    protected $primaryKey = 'goods_id';

    public    $timestamps = false;

    protected $appends = ['cat_name'];

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];

    public static function getList(array $attributes)
    {
        extract($attributes);

        $page = isset($page) ? $page : 1;

        $per_page = isset($per_page) ? $per_page : 10;
        
        $model = self::orderBy('sort_order', 'ASC')
                ->orderBy('add_time', 'DESC');

        $total = $model->count();

        $data = $model->paginate($per_page)->toArray();

        return ['data' => $data['data'], 'paged' => ['page' => $page, 'per_page' => $per_page, 'total' => $total]];
    }

    public static function info(array $attributes)
    {
        extract($attributes);

    	$model = self::where('goods_id',$id)->with('GoodsAttr')->first();

    	return $model;
    }

    public static function status(array $attributes)
    {
        extract($attributes);

        self::where('goods_id',$id)->update([$action => $value]);

        return true;
    }

    public static function act(Request $request, array $attributes)
    {
        extract($attributes);

        if ($request->hasFile('image')) {

            $photo = $request->file('image');

            $file_name = 'goods_'.time().'.jpg';

            $file_path = './uploads/images/goods/';

            $path = $file_path . $file_name;

            $image = Image::make($photo)->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }

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
                'is_on_sale'   => isset($is_on_sale) ? $is_on_sale : 0,
                'sort_order'   => isset($sort_order) ? $sort_order : 0,
                'goods_img'    => isset($path) ? $path : '',
                'add_time'     => time(),
            ];

            if (isset($cat_id) && !is_null(Category::where('cat_id',$cat_id)->first())) $data['cat_id'] = $cat_id;

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
                $model->goods_name  = $name;
                $model->goods_desc  = isset($desc) ? $desc : ' ';
                $model->shop_price  = isset($price) ? $price : 0;
                $model->is_on_sale  = isset($is_on_sale) ? $is_on_sale : 0;
                $model->sort_order  = isset($sort_order) ? $sort_order : 0;
                $model->goods_img   = isset($path) ? $path : $model->goods_img;
                $model->cat_id      = isset($cat_id) ? $cat_id : $model->cat_id;

                if ($model->save()); return true;
            }
        }
        elseif ($action == 'delete')
        {
            if (self::where('goods_id',$id)->delete())
            {
                return true;
            }
        }

        return false;
    }

    public function GoodsAttr()
    {
        return $this->hasMany('App\Model\Admin\GoodsAttr', 'goods_id', 'goods_id');
    }

    public function getCatNameAttribute()
    {
        return Category::where('cat_id',$this->cat_id)->value('cat_name');
    }
}
