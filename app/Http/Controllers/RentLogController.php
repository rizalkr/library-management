<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;

class RentLogController extends Controller
{
    public function index(){
        $rentLogs = RentLogs::all();
        return view('admin-feature.rent-log',compact('rentLogs'));
    }
}


