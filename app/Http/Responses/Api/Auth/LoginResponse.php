<?php

namespace App\Http\Responses\Api\Auth;

class LoginResponse
{
    /**
     * The access token for the authenticated user.
     *
     * @var string
     */
    public $accessToken;

    /**
     * Create a new login response DTO instance.
     *
     * @param string $accessToken The access token for the authenticated user.
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
