<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function login()
    {
        if (session()->get('user'))
            return redirect()->route('home');

        return view('auth.login', ['message' => ""]);
    }

    public function loginPost(LoginRequest $request)
    {


        $data = $request->all();

        $login = $this->travelsya->login($data);

        if ($login['meta']['code'] == 401)
            return view('auth.login', ['message' => $login['meta']['message']]);


        $sesLogin = ['data' => $login['data']['user'], 'token' => 'Bearer ' . $login['data']['access_token']];
        $request->session()->put('user', $sesLogin);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $logout = $this->travelsya->logout();

        if (isset($logout['message'])) {
            if ($logout['message'] == "Unauthorized") {

                $request->session()->flush();
            }
        } else {
            $request->session()->flush();
        }

        return redirect()->route('home');
    }

    public function register()
    {

        if (session()->get('user'))
            return redirect()->route('home');

        return view('auth.register', ['message' => ""]);
    }

    public function registerPost(RegisterRequest $request)
    {
        $data = $request->all();
        $register = $this->travelsya->register($data);
        if ($register['meta']['code'] == 401)
            return view('auth.register', ['message' => $register['meta']['message']]);

        return redirect()->route('login', ['message' => 'Account registered']);
    }

    public function resetPasswordEmail()
    {

        if (session()->get('user'))
            return redirect()->route('home');

        return view('auth.reset-email', ['message' => ""]);
    }

    public function resetPasswordEmailPost(Request $request)
    {
        $data = $request->all();
        $tokenEmail = $this->travelsya->tokenEmail($data);

        if ($tokenEmail['meta']['code'] == 401)
            return view('auth.reset-email', ['message' => $tokenEmail['meta']['message']]);

        return redirect()->route('reset.password.view', ['message' => 'Token sent to email']);
    }

    public function resetPassword()
    {
        if (session()->get('user'))
            return redirect()->route('home');

        return view('auth.reset-password', ['message' => ""]);
    }

    public function resetPasswordPost(Request $request)
    {
        $data = $request->all();
        $resetPassword = $this->travelsya->resetPassword($data);

        if ($resetPassword['meta']['code'] == 401)
            return view('auth.reset-email', ['message' => $resetPassword['meta']['message']]);

        return redirect()->route('login.view', ['message' => 'Password has been reset']);
    }

    
}
