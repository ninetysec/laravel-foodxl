<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api\Order;

class OrderController extends Controller
{
    //
    public function getList(Request $request)
    {
        $data = Order::getList();

        return response()->json($data);
    }

    //
    public function search(Request $request)
    {
        $rules = [
            'phone'    => 'required|string'
        ];

        $validated = $request->validate($rules);

        $data = Order::search($validated);

        return response()->json($data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
            'id'    => 'required|integer'
        ];

        $validated = $request->validate($rules);

        $data = Order::info($validated);

        return response()->json($data);
    }
}
