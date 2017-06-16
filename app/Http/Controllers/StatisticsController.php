<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class StatisticsController extends Controller
{
    /**
     * Display statistical information/report on a user's experience and activity on iPub
     * @return View
     */
    public function statistics() {
        return view('statistics');
    }
}
