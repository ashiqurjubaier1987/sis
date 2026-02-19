<?php
/*
 * Created on Sun Feb 08 2026
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2026 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('admin.dashboard',compact('title'));
    }
}
