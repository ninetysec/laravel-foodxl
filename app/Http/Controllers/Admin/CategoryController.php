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

        return view('admin.category_list',$data);
    }

    //
    public function info(Request $request)
    {
        $rules = [
                    'id'     => 'required|integer|min:1'
                ];

        $validated = $request->validate($rules);

        $data = Category::info($validated);

        $cat = Category::where('parent_id',0)->where('cat_id','<>',$validated['id'])->get();

        return view('admin.category_info',['data' => $data, 'cat' => $cat]);
    }

    //
    public function add()
    {
        $cat = Category::where('parent_id',0)->get();
        
        return view('admin.category_add',['cat' => $cat]);
    }

    //
    public function act(Request $request)
    {
        $rules = [
                    'action'     => 'required|string',
                    'id'         => 'integer',
                    'name'       => 'string',
                    'desc'       => '',
                    'parent_id'  => 'integer',
                    'sort_order' => 'integer',
                    'value'      => 'integer',
                ];

        $validated = $request->validate($rules);

        $data = Category::act($request,$validated);

        if ($data === true) 
        {
            return redirect('admin/category/list');
        }

        // return response()->json($data);
    }
}
