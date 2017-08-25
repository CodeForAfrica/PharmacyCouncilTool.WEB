<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function index()
    {
        // Destroying session.
        session()->forget('user');
        session()->flush();
        return redirect('admin/login');
    }
}