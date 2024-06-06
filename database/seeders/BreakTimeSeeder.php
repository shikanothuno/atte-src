<?php

namespace Database\Seeders;

use App\Models\BreakTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreakTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=100;$i++){
            for($j=0;$j<30;$j++){
                BreakTime::create([
                    "user_id" => $i,
                    "date" => date("Y-m-d :00:00:00",strtotime("2024-5-1 +" . strval($j) . "day")),
                    "start_time" => date("Y-m-d H:i:s",strtotime("2024-5-1 +" . strval($j) . "day" . "12:00:00")),
                    "end_time"=> date("Y-m-d H:i:s",strtotime("2024-5-1 +" . strval($j) . "day" . "13:00:00")),
                ]);

                BreakTime::create([
                    "user_id" => $i,
                    "date" => date("Y-m-d",strtotime("2024-5-1 +" . strval($j) . "day")),
                    "start_time" => date("Y-m-d H:i:s",strtotime("2024-5-1 +" . strval($j) . "day" . "15:00:00")),
                    "end_time"=> date("Y-m-d H:i:s",strtotime("2024-5-1 +" . strval($j) . "day" . "15:10:00")),
                ]);
            }
        }
    }
}
