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
                    'page'     => 'integer',
                    'per_page' => 'integer',
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

    //
    public function act(Request $request)
    {
        $rules = [
                    'action'     => 'required|string',
                    'id'         => 'integer',
                    'status'     => 'json'
                ];

        $validated = $request->validate($rules);

        $data = Order::act($validated);

        if ($data === true && $validated['action'] == 'delete')
        {
            return redirect('admin/order/list');
        }

        return response()->json($data);
        
        // return response()->json($data);
    }
}
