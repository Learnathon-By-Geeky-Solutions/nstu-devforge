<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function chat($driver='')
    {
        return view('chat.index',compact('driver'));
    }
}
