<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Model\Admin\Category;

class GoodsController extends Controller
{
    //
    public function getList(Request $request)
    {
        $rules = [
                    'page'     => 'integer|min:1',
                    'per_page' => 'integer|min:1',
                ];

        $validated = $request->validate($rules);

        $data = Goods::getList($validated);

        return view('admin.goods_list',$data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
                    'id'     => 'required|integer|min:1'
                ];

        $validated = $request->validate($rules);

        $data = Goods::info($validated);

        $cat = Category::get();

        return view('admin.goods_info',['data' =>$data, 'cat' => $cat]);
    }

    //
    public function add()
    {
        $cat = Category::get();

        return view('admin.goods_add',['cat' => $cat]);
    }

    //
    public function act(Request $request)
    {
        $rules = [
                    'action'     => 'required|string',
                    'id'         => 'integer',
                    'cat_id'     => 'integer',
                    'name'       => 'required|string',
                    'desc'       => 'string',
                    'price'      => 'string',
                    'is_on_sale' => 'integer',
                    'sort_order' => 'integer',
                    'attr_values'=> 'json'
                ];

        $validated = $request->validate($rules);

        $data = Goods::act($request,$validated);

        return response()->json($data);
    }

    //
    public function status(Request $request)
    {
        $rules = [
                    'action'     => 'required|string',
                    'id'         => 'integer',
                    'value'      => 'integer'
                ];

        $validated = $request->validate($rules);

        $data = Goods::status($validated);

        return response()->json($data);
    }
}
