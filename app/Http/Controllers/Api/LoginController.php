<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt($request->only("email", "password")))
        {
            throw ValidationException::withMessages([
                'email' => ["Lütfen bilgilerinizi kontrol edin"]
            ]);
        }

        $user = User::query()
            ->where("email", $request->email)
            ->first();

        return response()
            ->json([
                'message' => "Login başarılı",
                "user" => $user,
                "token" => $user->createToken("mobillium")->plainTextToken
            ]);
    }

    public function deleteToken(Request $request)
    {
        $userTokens = $request->user()->tokens()->delete();
        $currentToken = $request->user()->currentAccessToken()->token;
        dd($userTokens, $currentToken);

//        foreach ($userTokens as $token)
//        {
//            if ($token->token != $currentToken)
//            {
//                $token->delete();
//            }
//        }
    }
}
