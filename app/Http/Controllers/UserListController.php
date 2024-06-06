<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    protected $display_limit = 10;
    public function userList()
    {
        $users =User::paginate($this->display_limit);
        return view("user-list",compact("users"));
    }

    public function userDetail($user_id,$target_month)
    {
        $user = User::find($user_id);
        $attendances = Attendance::where("date",">=",$target_month . "-01")->where("date","<",date("Y-m-d",strtotime($target_month . " +1 month")))->where("user_id","=",$user_id)->get()->all();
        return view("user-detail",compact("user","target_month","attendances"));
    }
}
