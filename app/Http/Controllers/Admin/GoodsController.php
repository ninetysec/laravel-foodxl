<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;

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

        return view('admin.goods_info',$data);
    }

    //
    public function add()
    {
        return view('admin.goods_add');
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

        var_dump($request->hasFile('avatar'));

        $data = Goods::act($request,$validated);

        return response()->json($data);
    }
}
