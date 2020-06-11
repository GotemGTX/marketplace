<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){

    	return view('backend.admins.login');
    }
    public function register(){

    	return view('backend.admins.register');
    }
}
