<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    //
    public function index()
    {
        if(auth()->check()) {
            return view('guide');
        } else {
            return view('guide_');
        }
    }
}
