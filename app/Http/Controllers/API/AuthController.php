<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Mail\SendTokenResetPassword;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'string', new Password(8)],
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Authentication Failed', 500);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 2
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            return ResponseFormatter::success([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 'User Registered');
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Authentication Failed', 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Authentication Failed', 500);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return ResponseFormatter::success([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 'Login succesed');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Authentication Failed', 500);
        }
    }

    public function update(Request $request)
    {
        // return $request->only('email', 'password');
        try {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'User update failed', 500);
            }

            $user = User::find($request->user()->id);
            if (isset($data['old_password'])) {

                $validator = Validator::make($request->all(), [
                    'password' => ['required', 'string', new Password(8)],
                    'old_password' => ['required', 'string'],
                ]);

                if ($validator->fails()) {
                    return ResponseFormatter::error([
                        'response' => $validator->errors(),
                    ], 'User update failed', 500);
                }
                if (!password_verify($data['old_password'], $request->user()->password)) {
                    return ResponseFormatter::error([
                        'message' => 'Old password didnt match'
                    ], 'Update Failed', 401);
                }
                unset($data['old_password']);
                $data['password'] = Hash::make($data['password']);
            }
            $data['phone'] = $request->phone;
            $update = $user->update($data);
            if ($update) {
                return ResponseFormatter::success($user, "User update success");
            } else {
                return ResponseFormatter::error(null, "User update failed");
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'User update Failed', 500);
        }
    }

    public function sendTokenPassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'User update failed', 500);
        }

        $check = PasswordReset::where('email', $data['email'])->first();
        if ($check)
            $check->delete();

        // Generate random code
        $data['token'] = (string)mt_rand(100000, 999999);

        // return $data;
        // create token
        $createToken = PasswordReset::create($data);

        if (!$createToken)
            exit('Token create failed');

        //send email
        $mail = Mail::to($data['email'])->send(new SendTokenResetPassword($createToken->token));

        if ($mail) {
            return ResponseFormatter::success(null, "Token sent to email");
        } else {
            return ResponseFormatter::error(null, "Token sent failed");
        }
    }

    public function tokenCheck(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'token' => 'required|string|exists:password_resets',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'Token not found', 500);
        }

        $check = PasswordReset::firstWhere('token', $data['token']);

        // check if it does not expired: the time is one hour
        if ($check->created_at > now()->addHour()) {
            $check->delete();
            return ResponseFormatter::error(null, "Token expired");
        }
        return ResponseFormatter::success(['token' => $check->token], "Token is valid");
    }

    public function resetPassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'token' => 'required|string|exists:password_resets',
            'password' => ['required', 'string', new Password(8)],
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'Register failed', 500);
        }

        $passwordReset = PasswordReset::firstWhere('token', $data['token']);
        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return ResponseFormatter::error(null, "Token expired");
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $update = $user->update(['password' => Hash::make($data['password'])]);

        if ($update) {
            return ResponseFormatter::success($user, "Password reset success");
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success([
            $token
        ], 'Token revoked');

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function profile(Request $request)
    {
        $user = User::with('historyPoint.transaction')->find($request->user()->id);

        if ($user) {
            return ResponseFormatter::success($user, "User successfuly loaded");
        } else {
            return ResponseFormatter::error(null, "User failed");
        }
    }
}
