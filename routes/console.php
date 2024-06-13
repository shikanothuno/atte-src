<?php

use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    $users = User::all();
    $yesterday = date("Y-m-d H:i:s",strtotime(date("Y-m-d") . " -1 day" . "00:00:00"));
    $today = date("Y-m-d H:i:s",strtotime(date("Y-m-d" . "00:00:00")));
    foreach($users as $user){
        if($user->breaking){
            $break_time_collection_yesterday = BreakTime::where("user_id","=",$user->id)->where("date","=",$yesterday)->get();
            $break_time_yestarday = BreakTime::find($break_time_collection_yesterday[count($break_time_collection_yesterday)-1]->id);

            $break_time_yestarday->end_time = date("Y-m-d H:i:s",strtotime(date("Y-m-d",strtotime($yesterday) ). "23:59:59"));
            $break_time_yestarday->save();

            $break_time_today = new BreakTime();

            $break_time_today->user_id = $user->id;
            $break_time_today->date = $today;
            $break_time_today->start_time = $today;
            $break_time_today->save();

        }
        if($user->working){

            $attendance_collection_yesterday = Attendance::where("user_id","=",$user->id)->where("date","=",$yesterday)->get();
            $attendance_yesterday = Attendance::find($attendance_collection_yesterday[0]->id);

            $attendance_yesterday->end_time = date("Y-m-d H:i:s",strtotime(date("Y-m-d",strtotime($yesterday) ). "23:59:59"));
            $attendance_yesterday->save();

            $attendance_today = new Attendance();

            $attendance_today->user_id = $user->id;
            $attendance_today->date = $today;
            $attendance_today->start_time = $today;
            $attendance_today->save();

        }
    }
})->everyMinute();
