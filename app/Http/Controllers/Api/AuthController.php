<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Responses\Api\Auth\LoginResponse;
use App\Http\Responses\Api\Auth\RegisterResponse;
use App\Http\Responses\Api\Users\UserResponse;

class AuthController extends Controller
{
    /**
     * Get the current authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $user = Auth::user();
        $response = new UserResponse($user);

        return $this->successResponse($response, 'User retrieved successfully.');
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\Api\Auth\RegisterRequest $request
     * @return \App\Http\Responses\Api\Auth\RegisterResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole(['user']);

        $accessToken = $user->createToken('LaravelAuthApp')->accessToken;
        $response = new RegisterResponse($accessToken);

        return $this->successResponse($response, 'User registered successfully.');
    }

    /**
     * Login a user and return an access token.
     *
     * @param  \App\Http\Requests\Api\Auth\LoginRequest  $request
     * @return \App\Http\Responses\Api\Auth\LoginResponse
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
