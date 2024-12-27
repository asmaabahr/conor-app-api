<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
Use Otp;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Notifications\ResetNotifi;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Hash;
use function Laravel\Prompts\password;

class ResetPasswordController extends Controller
{
    private $otp;

    public function __construct(){
       //$this->otp = new Otp;

    }

    public function paswwordreset(ResetPasswordRequest $request)
    {
        $otp2 = $this->otp->validate($request->email, $request->otp);
            if (! $otp2->status) {
                return response()->json(['error'=> $otp2,401]);
        }
        $user = User::where('email',$request->email)->first();
       // $user->update(['password' =>Hash::make($request->password)]);
        $user->tokens()->delete();
        $success['success'] =true;
        return response()->json($success,200);
        }


}
