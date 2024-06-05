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
            return redirect()->route('home')->with('error','Bạn chưa đăng nhập');
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

            return redirect()->route('home')->with('success', 'Yêu cầu của bạn đã được gửi và đang chờ phê duyệt');
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
