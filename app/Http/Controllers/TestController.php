<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Klangch\LaravelIRCaptcha\Rules\IRCaptcha;

class TestController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        // Method 1
        // if (ir_captcha()->validateCaptchaToken($request->input('captcha_token'))) {
        //     $message = 'Captcha token is valid! Login success!';
        // } else {
        //     $message = 'Invalid captcha token!';
        // }

        // Method 2
        $rules = [
            'email' => ['required'],
            'password' => ['required'],
            'captcha_token' => ['required', new IRCaptcha],
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->validate();

        $message = 'Captcha token is valid! Login success!';

        return view('success', [
            'message' => $message,
        ]);
    }
}
