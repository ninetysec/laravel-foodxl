<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Redirect;

class Category extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'category';

    protected $primaryKey = 'cat_id';

    public    $timestamps = false;

    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\
    // 
    public static function getList(array $attributes)
    {
        extract($attributes);

        $per_page = isset($per_page) ? $per_page : 20;

    	$model = self::where('parent_id',0)
                ->with('son')
                ->orderBy('sort_order', 'ASC')
                ->orderBy('cat_id', 'DESC')
                ->paginate($per_page)
                ->toArray();

    	return $model;
    }

    public static function info(array $attributes)
    {
        extract($attributes);

        if (!is_null($model = self::where('cat_id',$id)->first()))
        {
            $model = $model->toArray();
        }

        return $model;
    }

    public static function act(array $attributes)
    {
        extract($attributes);

        if ($action == 'insert')
        {
            $data = [
                'cat_name'   => $name,
                'cat_desc'   => isset($desc) ? $desc : '',
                'sort_order' => isset($sort_order) ? $sort_order : 0,
            ];

            if (isset($parent_id) && !is_null(self::where('cat_id',$parent_id)->first())) {$data['parent_id'] = $parent_id;}

            if (self::insertGetId($data)) return true;
        }
        elseif ($action == 'update')
        {
            $id = isset($id) ? $id : 0;

            if (!is_null($model = self::where('cat_id',$id)->first()))
            {
                $model->cat_name = $name;
                $model->cat_desc = isset($desc) ? $desc : ' ';
                $model->sort_order = isset($sort_order) ? $sort_order : 0;
                if (isset($parent_id) && !is_null(self::where('cat_id',$parent_id)->first())) $model->parent_id = $parent_id;
                if ($model->save()) return true;
            }
        }

        return false;
    }

    public function son()
    {
        return $this->hasMany('App\Model\Admin\Category', 'parent_id', 'cat_id');
    }
}
