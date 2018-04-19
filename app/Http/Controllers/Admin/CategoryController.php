<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;

class CategoryController extends Controller
{
    //
    public function getList(Request $request)
    {
        $rules = [
                    'page'     => 'integer|min:1',
                    'per_page' => 'integer|min:1',
                ];

        $validated = $request->validate($rules);

        $data = Category::getList($validated);

        return response()->json($data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
                    'id'     => 'required|integer|min:1'
                ];

        $validated = $request->validate($rules);

        $data = Category::info($validated);

        return response()->json($data);
    }

    //
    public function act(Request $request)
    {
        $rules = [
                    'action'     => 'required|string|min:1',
                    'id'         => 'integer|min:1',
                    'name'       => 'required|string|min:1',
                    'desc'       => 'string|min:1',
                    'parent_id'  => 'integer',
                    'sort_order' => 'integer',
                ];

        $validated = $request->validate($rules);

        $data = Category::act($validated);

        return response()->json($data);
    }
}
