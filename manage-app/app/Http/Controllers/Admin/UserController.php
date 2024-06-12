<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest();
        $users = $users->paginate(15);
        
        return view('admin.users.list', [
            'users' => $users,
        ]);
    }
}
