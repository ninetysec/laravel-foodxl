<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api\Category;
use App\Model\Api\Goods;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $data = Category::index();

        return response()->json($data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
            'id'    => 'required|integer|min:1'
        ];

        $validated = $request->validate($rules);

        $data = Goods::index($validated);

        return response()->json($data);
    }
}
