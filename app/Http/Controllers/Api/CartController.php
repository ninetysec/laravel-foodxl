<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api\Cart;

class CartController extends Controller
{
    //
    public function getList(Request $request)
    {
        $data = [];

        if ($request->session()->has('key'))
        {
            $data = Cart::getList();
        }

        return response()->json($data);
    }

    //
    public function add(Request $request)
    {
        // 记录未登录用户
        if (!$request->session()->has('key'))
        {
            $arr = array(
                'key' => md5(time().rand(1000,9999))
            );
            $request->session()->put($arr);
        }

        $rules = [
            'goods_id'    => 'required|integer',
            'number'      => 'required|integer',
            'attr_id'     => 'integer',
        ];

        $validated = $request->validate($rules);

        $data = Cart::add($validated);

        return response()->json($data);
    }

    //
    public function edit(Request $request)
    {
        $rules = [
            'id'          => 'required',
            'number'      => 'required',
            'attr_id'     => 'integer',
            'values'      => 'json',
        ];

        $validated = $request->validate($rules);

        $data = Cart::edit($validated);

        return response()->json($data);
    }

    //
    public function checkout(Request $request)
    {
        $rules = [
            'id'          => 'json'
        ];

        $validated = $request->validate($rules);

        $data = Cart::checkout($validated);

        return response()->json($data);
    }

    public function clear()
    {
        $data = Cart::clear_cart_ids();

        return response()->json($data);
    }
}
