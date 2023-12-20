<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '0')->get();
        return view('admin.management-user.index', compact('users'));
    }

    public function create(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'email|required|unique:users,email|min:7|max:255',
            'password' => 'required|min:7|confirmed'
        ]);

        if($validators->fails()){
            toast('Tolong berikan konfirmasi yang benar', 'warning');
            return redirect()->back();
        }

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

    // public function update(Request $request)
    // {

    //     $user = User::find($request->id);
    //     if (!is_null($request->password)) {
    //         $request['password'] = bcrypt($request->password);
    //     } else {
    //         unset($request['password']);
    //     }
    //     $user->update($request->all());

    //     toast('User has been updated', 'success');
    //     return redirect()->route('admin.user');
    //     // return redirect()->route('admin.management-user.index');
    // }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        $userId = $user->id;
        //dd($userId);
        $validator = Validator::make($request->all(), [
            'email' => [
                'email',
                'required',
                Rule::unique('users', 'email')->ignore($userId),
                'min:7',
                'max:255',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'type' => 'danger',
                'message' => 'Data Akun yang ditambahkan sudah terdaftar',
            ])->withErrors($validator->errors());
        }

        if (!is_null($request->password)) {
            $request['password'] = bcrypt($request->password);
        } else {
            unset($request['password']);
        }

        $user->update($request->all());

        toast('User has been updated', 'success');
        return redirect()->route('admin.user');
    }


    public function delete($id)
    {
        User::find($id)->delete();
        toast('User has been deleted', 'success');
        return redirect()->route('admin.user');
        // return redirect()->route('admin.management-user.index');
    }
}
