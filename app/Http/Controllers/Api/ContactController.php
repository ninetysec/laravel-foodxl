<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api\Contact;

class ContactController extends Controller
{
    //
    public function post(Request $request)
    {
        $rules = [
/*            'name'    => 'required|string',
            'email'   => 'required|string',
            'message' => 'required|string'*/
        ];

        $validated = $request->validate($rules);

        $data = Contact::post($validated);

        return response()->json($data);
    }
}
