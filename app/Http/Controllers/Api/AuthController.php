<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Responses\Api\Auth\LoginResponse;
use App\Http\Responses\Api\Auth\RegisterResponse;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\Api\Auth\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $accessToken = $user->createToken('LaravelAuthApp')->accessToken;
        $response = new RegisterResponse($accessToken);

        return $this->successResponse($response, 'User registered successfully.');
    }

    /**
     * Login a user and return an access token.
     *
     * @param  \App\Http\Requests\Api\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $accessToken = Auth::user()->createToken('LaravelAuthApp')->accessToken;
            $response = new LoginResponse($accessToken);

            return $this->successResponse($response, 'User logged in successfully.');
        } else {
            return $this->errorResponse('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }
    }
}
