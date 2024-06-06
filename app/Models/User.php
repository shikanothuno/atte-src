<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function attendences()
    {
        return $this->hasMany(Attendance::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }

    public function startAttendance($user_id)
    {
        date_default_timezone_set("Asia/Tokyo");
        $attendance = new Attendance();
        $attendance->user_id = $user_id;
        $attendance->date = date("Y-m-d 00:00:00");
        $attendance->start_time = date("Y-m-d H:i:s");
        $attendance->save();

        $user = User::find($user_id);
        $user->working = true;
        $user->save();
    }

    public function endAttendance($user_id)
    {
        date_default_timezone_set("Asia/Tokyo");
        $attendance_collection = Attendance::where("user_id","=",$user_id)->where("date","<=",date("Y-m-d H:i:s"))->where("date",">=",date("Y-m-d"))->get();

        $attendance = Attendance::find($attendance_collection[0]->id);
        $attendance->end_time = date("Y-m-d H:i:s");
        $attendance->save();

        $user = User::find($user_id);
        $user->working = false;
        $user->save();
    }

    public function startBreakTime($user_id)
    {
        date_default_timezone_set("Asia/Tokyo");
        $break_time = new BreakTime();
        $break_time->user_id = $user_id;
        $break_time->date = date("Y-m-d 00:00:00");
        $break_time->start_time = date("Y-m-d H:i:s");
        $break_time->save();

        $user = User::find($user_id);
        $user->breaking = true;
        $user->save();
    }

    public function endBreakTime($user_id)
    {
        date_default_timezone_set("Asia/Tokyo");
        $break_times_collections = BreakTime::where("user_id","=",$user_id)->where("date","<=",date("Y-m-d H:i:s"))->where("date",">=",date("Y-m-d"))->get();

        foreach($break_times_collections as $break_times_collection){
            if($break_times_collection->end_time == null){
                $break_time = BreakTime::find($break_times_collection->id);
                $break_time->end_time = date("Y-m-d H:i:s");
                $break_time->save();
            }
        }

        $user = User::find($user_id);
        $user->breaking = false;
        $user->save();
    }

    public function getUserStartTime($user_id,$target_month)
    {
        $number_of_days_in_a_month = date("t",strtotime($target_month));
        $attendance = new Attendance();
        $result = [];
        for($i=0;$i<$number_of_days_in_a_month;$i++){
            $result[$i] = $attendance->getAttendanceStart($user_id,$target_month . "-" . str_pad($i+1,2,0,STR_PAD_LEFT));
        }

        return $result;
    }

    public function getUserEndTime($user_id,$target_month)
    {
        $number_of_days_in_a_month = date("t",strtotime($target_month));
        $attendance = new Attendance();
        $result = [];
        for($i=0;$i<$number_of_days_in_a_month;$i++){
            $result[$i] = $attendance->getAttendanceEnd($user_id,$target_month . "-" . str_pad($i+1,2,0,STR_PAD_LEFT));
        }

        return $result;
    }

    public function getUserWorkingTime($user_id,$target_month)
    {
        $number_of_days_in_a_month = date("t",strtotime($target_month));
        $attendance = new Attendance();
        $result = [];
        for($i=0;$i<$number_of_days_in_a_month;$i++){
            $result[$i] = $attendance->calcWorkingTime($user_id,$target_month . "-" . str_pad($i+1,2,0,STR_PAD_LEFT));
        }

        return $result;
    }

    public function getUserTotalBreakTime($user_id,$target_month)
    {
        $number_of_days_in_a_month = date("t",strtotime($target_month));
        $attendance = new Attendance();
        $result = [];
        for($i=0;$i<$number_of_days_in_a_month;$i++){
            $result[$i] = $attendance->getTotalBreakTime($user_id,$target_month . "-" . str_pad($i+1,2,0,STR_PAD_LEFT));
        }

        return $result;
    }


}
