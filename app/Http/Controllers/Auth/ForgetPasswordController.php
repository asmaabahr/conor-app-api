<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ResetNotifi;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    public function forgetpassword(ForgetPasswordRequest $request){
        $input = $request->only('email');
        $user = User::where('email',$input)->first();
        $user->notify(new ResetNotifi());
        $success['success'] =true;
        return response()->json($success,200);

    }

}
