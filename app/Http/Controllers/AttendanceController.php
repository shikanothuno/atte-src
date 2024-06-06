<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $user = Auth::user();
        return view("stamping",compact("user"));
    }

    public function startAttendance(Request $request)
    {
        $request->session()->regenerateToken();
        $user = User::find(Auth::user()->id);
        $user->startAttendance($user->id);
        return redirect(route("attendance"));
    }

    public function endAttendance(Request $request)
    {
        $request->session()->regenerateToken();
        $user = User::find(Auth::user()->id);
        $user->endAttendance($user->id);
        return redirect(route("attendance"));
    }

    public function startBreakTime(Request $request)
    {
        $request->session()->regenerateToken();
        $user = User::find(Auth::user()->id);
        $user->startBreakTime($user->id);
        return redirect(route("attendance"));
    }

    public function endBreakTime(Request $request)
    {
        $request->session()->regenerateToken();
        $user = User::find(Auth::user()->id);
        $user->endBreakTime($user->id);
        return redirect(route("attendance"));
    }
}
