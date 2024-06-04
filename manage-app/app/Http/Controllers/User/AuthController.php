<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->route('home')->with('Bạn đã đăng nhập rồi');
        }
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        $intendedUrl = session('url.intended');
        $credentials = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ];
        $redirectTo = route('home');
        $message = "Đăng nhập thành công";
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', "Sai thông tin đăng nhập, vui lòng nhập lại");
        }
        $request->session()->regenerate();

        if (Auth::user()->type == ConstCommon::TypeUser && $intendedUrl && $intendedUrl != route('login')) {
            $redirectTo = $intendedUrl;
        }

        return redirect()->to($redirectTo)->with('message', $message);
    }

    public function logOut(){
        Auth::logout();
        return redirect()->route('login');
    }



}

