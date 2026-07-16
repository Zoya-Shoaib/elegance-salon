<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }
    function analytics(){
        return view('admin.analytics');
    }
    function clients(){
        return view('admin.clients');
    }
    function inventory(){
        return view('admin.inventory');
    }
    function pos_checkout(){
        return view('admin.pos-checkout');
    }
    function schedular(){
        return view('admin.schedular');
    }
    function staff(){
        return view('admin.staff');
    }
}
