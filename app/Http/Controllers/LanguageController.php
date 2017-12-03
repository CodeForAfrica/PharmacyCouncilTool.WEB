<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App;
use Lang;

class LanguageController extends Controller
{
    /**
     * @desc To change the current language
     * @request Ajax
     */

    public function index(Request $request)
    {
        if($request->lang){
            $request->session()->put('locale', $request->lang);
        }

        return redirect()->back();
    }
}
