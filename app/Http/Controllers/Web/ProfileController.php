<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends WebController
{
    public function index(){
        return view('web.profile.index');
    }
}
