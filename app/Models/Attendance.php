<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "date",
        "start_time",
        "end_time",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAttendanceStart($user_id,$date)
    {
        return $attendance_start = Attendance::select("start_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    public function getAttendanceEnd($user_id,$date)
    {
        return $attendance_end = Attendance::select("end_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    public function calcWorkingTime($user_id,$date)
    {
        $attendance_start = $this->getAttendanceStart($user_id,$date);
        $attendance_end = $this->getAttendanceEnd($user_id,$date);
        if(empty($attendance_start)||empty($attendance_end)){
            return "00:00:00";
        }
        $total_attendance = strtotime($attendance_end[0]->end_time) - strtotime($attendance_start[0]->start_time);

        $break_time = new BreakTime();
        $total_break_time = $break_time->calcBreakTime($user_id,$date);

        $totalWorkingTime = $total_attendance - $total_break_time;

        date_default_timezone_set("UTC");
        return date("H:i:s",$totalWorkingTime);
    }

    public function getTotalBreakTime($user_id,$date)
    {
        $break_time = new BreakTime();
        $total_break_time = $break_time->calcBreakTime($user_id,$date);

        date_default_timezone_set("UTC");
        return date("H:i:s",$total_break_time);
    }
}
