<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AccountCreatedEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest();

        if (!empty($request->get('keyword'))) {
            $users = $users->Where('name', 'like', '%' . $request->get('keyword') . '%');
            $users = $users->orWhere('email', 'like', '%' . $request->get('keyword') . '%');
        }

        $users = $users->paginate(15);

        return view('admin.users.list', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();

            $subject = 'Account Created';
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AccountCreatedEmail($subject, $name, $email, $password));

            session()->flash('success', 'Added user successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Added user successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            $message = 'User not found.';
            session()->flash('error', $message);
            return redirect()->route('users.index');
        }
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            $message = 'User not found.';
            session()->flash('error', $message);

            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->password != '') {
                $user->password = Hash::make($request->password);
            }

            $user->update();

            session()->flash('success', 'Updated user successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Updated user successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function destroy($userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            $message = 'User not found.';
            session()->flash('error', $message);

            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        }
        $user->delete();

        $message = 'Deleted user successfully.';
        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
}
