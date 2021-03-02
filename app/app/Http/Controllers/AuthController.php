<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $response =  [
                'token' => $user->createToken('MyApp')->plainTextToken,
                'csrf_token' => Session::token(),
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'email' => $user->email,
                ]
            ];

//            dd($response);

            return $this->sendResponse($response, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorized.', ['error'=>'Unauthorized']);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        return Auth::user()->tokens()->delete() ? $this->sendResponse([], 'User logged out.') : $this->sendError('Error.', ['error'=>'Something went wrong!'], 400);;
    }
}
