<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Order;

class OrderController extends Controller
{
    //
    public function getList(Request $request)
    {
        $rules = [
                    'page'     => 'min:1',
                    'per_page' => 'min:1',
                ];

        $validated = $request->validate($rules);

        $data = Order::getList($validated);

        return view('admin.order_list',$data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
                    'id'     => 'required|integer|min:1'
                ];

        $validated = $request->validate($rules);

        $data = Order::info($validated);

        return view('admin.order_info',$data);
    }
}
