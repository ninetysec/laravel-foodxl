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

        return response()->json($data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
                    'id'     => 'required|integer|min:1'
                ];

        $validated = $request->validate($rules);

        $data = Goods::info($validated);

        return response()->json($data);
    }

    //
    public function act(Request $request)
    {
        $rules = [
                    'action'     => 'required|string|min:1',
                    'id'         => 'integer|min:1',
                    'cat_id'     => 'integer|min:1',
                    'name'       => 'required|string|min:1',
                    'desc'       => 'string|min:1',
                    'price'      => 'string',
                    'is_on_sale' => 'integer',
                    'sort_order' => 'integer',
                    'attr_values'=> 'json'
                ];

        $validated = $request->validate($rules);

        $data = Goods::act($validated);

        return response()->json($data);
    }
}
