<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends controller
{
    public function index(){
        return view('admin.home.index');
    }
}
