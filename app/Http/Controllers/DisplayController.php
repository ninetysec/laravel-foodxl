<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    //
    public function contact()
    {
        return view('contact');
    }

	//
    public function cart()
    {
        return view('cart');
    }

    //
    public function services()
    {
        return view('services');
    }

    //
    public function order()
    {
        return view('order');
    }
}
