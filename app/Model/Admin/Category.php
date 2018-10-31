<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
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

        $page = isset($page) ? $page : 1;

        $per_page = isset($per_page) ? $per_page : 10;

    	$model = self::where('parent_id',0)
                ->with('son')
                ->orderBy('sort_order', 'ASC')
                ->orderBy('cat_id', 'DESC');

        $total = $model->count();

        $data = $model->paginate($per_page)->toArray();

        return ['data' => $data['data'], 'paged' => ['page' => $page, 'per_page' => $per_page, 'total' => $total]];
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

    public static function act(Request $request, array $attributes)
    {
        extract($attributes);

        $id = isset($id) ? $id : 0;

        if (is_null($model = self::where('cat_id',$id)->first()) && $action != 'insert')
        {
            return false;
        }

        if ($request->hasFile('image'))
        {
            $request->file('image');

            $file_name = 'cat_'.time().'.jpg';

            if ($request->image->move('./uploads/images/cat/',$file_name)) {

                $path = '/uploads/images/cat/'.$file_name;

            }
        }

        if ($action == 'insert')
        {
            $data = [
                'cat_name'   => $name,
                'cat_desc'   => isset($desc) ? $desc : '',
                'sort_order' => isset($sort_order) ? $sort_order : 0,
                'cat_img'    => isset($path) ? $path : '',
                'cat_text'   => isset($image_text) ? $image_text : '',
            ];

            if (isset($parent_id) && !is_null(self::where('cat_id',$parent_id)->first())) {$data['parent_id'] = $parent_id;}

            if (self::insertGetId($data)) return true;
        }
        elseif ($action == 'update')
        {
            if (!is_null($model = self::where('cat_id',$id)->first()))
            {
                $model->cat_name    = $name;
                $model->cat_desc    = isset($desc) ? $desc : ' ';
                $model->sort_order  = isset($sort_order) ? $sort_order : 0;
                $model->cat_img     = isset($path) ? $path : $model->cat_img;
                $model->cat_text    = isset($image_text) ? $image_text : $model->cat_text;
                if (isset($parent_id) && !is_null(self::where('cat_id',$parent_id)->first()  && $parent_id !== $id)) $model->parent_id = $parent_id;
                if ($model->save()) return true;
            }
        }
        elseif ($action == 'delete')
        {
            if (self::where('cat_id',$id)->delete())
            {
                self::where('parent_id',$id)->update(['parent_id' => 0]);
            }
        }
        elseif ($action)
        {
            self::where('cat_id',$id)->update([$action => $value]);
        }

        return true;
    }

    public function son()
    {
        return $this->hasMany('App\Model\Admin\Category', 'parent_id', 'cat_id');
    }
}
