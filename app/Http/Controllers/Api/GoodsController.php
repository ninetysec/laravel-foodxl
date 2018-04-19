<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api\Category;
use App\Model\Api\Goods;
use App\Model\Api\GoodsAttr;

class GoodsController extends Controller
{
    //
    public function info(Request $request)
    {
        $rules = [
            'id'    => 'required|integer|min:1'
        ];

        $validated = $request->validate($rules);

        $data = Goods::info($validated);

        return response()->json($data);
    }
}
