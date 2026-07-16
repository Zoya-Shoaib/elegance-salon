<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    function dashboard(){
        return view('receptionist.dashboard');
    }
    function clients(){
        return view('receptionist.clients');
    }
    function pos_checkout(){
        return view('receptionist.pos-checkout');
    }
    function schedular(){
        return view('receptionist.schedular');
    }
}
