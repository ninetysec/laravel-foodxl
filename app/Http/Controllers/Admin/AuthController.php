<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Model\Admin\Admin;

class AuthController extends Controller
{
    use ThrottlesLogins;

//    protected $redirectTo = 'admin';
//    protected $guard = 'admin';
//    protected $loginView = 'admin.login';
//    protected $registerView = 'admin.register';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }
    //登录
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->validateLogin($request->input());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if (Auth::guard('admin')->attempt(['name'=>$request->name, 'password'=>$request->password])) {
                return Redirect::to('admin')->with('success', '登录成功！');
            } else {
                return back()->with('error', '账号或密码错误')->withInput();
            }
        }
        return view('admin.login');
    }
    // 登录页面验证
    protected function validateLogin(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'password' => 'required|min:2',
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求'
        ], [
            'name' => '账号',
            'password' => '密码'
        ]);
    }
    //退出登录  
    public function logout()
    {
        if(Auth::guard('admin')->user()){
            Auth::guard('admin')->logout();
        }
        return Redirect::to('admin/login');
    }
}