<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicWebsiteController extends Controller
{
    function index(){
        return view('public-web.index');
    }
}
