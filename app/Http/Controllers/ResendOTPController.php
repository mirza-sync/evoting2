<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResentOTPRequest;
use Illuminate\Support\Facades\Redirect;

class ResendOTPController extends Controller
{

    public function resend(ResentOTPRequest $request)
    {
        //resend

        auth()->user()->sendOTP($request->via);
        //cache
        return back()->with('message','Your new OTP is sent, please check!');
        // return response(null, 201);
        //redirect back with message

    }
    
}
