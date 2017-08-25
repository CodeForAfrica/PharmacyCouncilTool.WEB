<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class LoginController extends Controller
{
    public function index()
    {
        // Checking for session.
        if(session()->has('user'))
        {
            return redirect('admin/dashboard');
        }
        else{
            return view('admin.login');
        }
    }
}
