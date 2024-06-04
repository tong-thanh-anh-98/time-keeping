<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index(){
        return view('user.timecard');
    }

    public function add(Request $request){
        if (!Auth::check()) {
            return redirect()->route('login')->with('Bạn chưa đăng nhập');
        }
        $user = Auth::user();
        $type = $request->input('type');
        $attendance = [
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'type' => $type,
        ];
        Attendance::create($attendance);
        return redirect()->route('home');
    }
}
