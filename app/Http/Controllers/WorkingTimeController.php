<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class WorkingTimeController extends Controller
{
    protected $display_limit = 5;

    public function showList($date)
    {
        $attendances = Attendance::where("date","=",$date)->paginate($this->display_limit);
        return view("show-list",compact("date","attendances"));
    }
}
