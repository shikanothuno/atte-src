<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home($target_month)
    {
        $user = User::find(Auth::user()->id);
        $attendances = Attendance::where("date",">=",$target_month . "-01")->where("date","<",date("Y-m-d",strtotime($target_month . " +1 month")))->where("user_id","=",Auth::user()->id)->get()->all();
        return view("home",compact("user","target_month","attendances"));
    }
}
