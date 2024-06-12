<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        return view('user.timecard');
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error','You are not logged in, please log in');
        }
        $user = Auth::user();
        $type = $request->input('type');
        // nếu type là request
        if ($type === 'request') {
            $attendance = [
                'user_id' => $user->id,
                'date' => $request->input('date'),
                'type' => $type,
                'status' => 'pending',
                'note' => $request->input('note')
            ];

            Attendance::create($attendance);

            return redirect()->route('home')->with('success', 'Your request has been sent and is awaiting approval');
        }
        $attendance = [
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'type' => $type,
            'status' => 'success',
        ];
        Attendance::create($attendance);
        return redirect()->route('home');
    }
}
