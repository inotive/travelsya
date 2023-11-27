<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '0')->get();
        return view('admin.management-user.index', compact('users'));
    }

    public function create(CreateUserRequest $request)
    {
        $request['name'] = $request->name;
        // $request['role'] = $request->role;
        $request['role'] = 0;
        $request['email'] = $request->email;
        $request['password'] = password_hash($request->password, PASSWORD_DEFAULT);
        User::create($request->all());

        toast('User has been created', 'success');
        return redirect()->back();
    }

    public function editJson(Request $request)
    {
        $user = User::find($request->id);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        if (!is_null($request->password)) {
            $request['password'] = bcrypt($request->password);
        } else {
            unset($request['password']);
        }
        $user->update($request->all());

        toast('User has been updated', 'success');
        return redirect()->route('admin.user');
        // return redirect()->route('admin.management-user.index');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        toast('User has been deleted', 'success');
        return redirect()->route('admin.user');
        // return redirect()->route('admin.management-user.index');
    }
}
