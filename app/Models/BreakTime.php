<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
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

    public function getStartBreakTimes($user_id,$date)
    {
        return $start_break_times = BreakTime::select("start_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    public function getEndBreakTimes($user_id,$date)
    {
        return $end_break_times = BreakTime::select("end_time")->where("user_id","=",$user_id)
        ->where("date","=",$date)->get()->all();
    }

    public function calcBreakTime($user_id,$date)
    {
        $start_break_times = $this->getStartBreakTimes($user_id,$date);

        $end_break_times = $this->getEndBreakTimes($user_id,$date);

        $totalBreakTime = 0;

        foreach(array_map(null,$end_break_times,$start_break_times) as [$end,$start]){
            if($end->end_time != null){
                $totalBreakTime += (strtotime(date("H:i:s",strtotime($end->end_time))) - strtotime(date("H:i:s",strtotime($start->start_time))));
            }
        }

        return $totalBreakTime;

    }
}
