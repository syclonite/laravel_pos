<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function display_dashboard(){
        return view('backend.dashboard');
    }
}
