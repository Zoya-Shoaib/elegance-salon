<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StylistController extends Controller
{
    function myWork(){
        return view('stylist-portal.stylist-work');
    }
}
