<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function admindashboard() {
        return view ('cms.dashboard.admindashboard');
    }

    public static function userdashboard() {
        return view ('cms.dashboard.userdashboard');
    }
}
