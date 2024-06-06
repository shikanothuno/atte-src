<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WorkingTimeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(AttendanceController::class)->middleware("auth")->group(function(){
    Route::get("/","attendance")->name("attendance");
    Route::get("/start-attendance","startAttendance")->name("startAttendance");
    Route::get("/end-attendance","endAttendance")->name("endAttendance");
    Route::get("/start-break-time","startBreakTime")->name("startBreakTime");
    Route::get("/end-break-time","endBreakTime")->name("endBreakTime");
});

Route::get("/{date}/show-list",[WorkingTimeController::class,"showList"])->middleware("auth")->name("showList");

Route::get("/{month}/home",[HomeController::class,"home"])->middleware("auth")->name("home");

Route::get('/{month}/calendar', [CalendarController::class, 'show'])->middleware("auth")->name('calendar.show');

Route::get("/user-list",[UserListController::class,"userList"])->middleware("auth")->name("userList");
Route::get("/{user}/{month}/user-detail",[UserListController::class,"userDetail"])->middleware("auth")->name("userDetail");
