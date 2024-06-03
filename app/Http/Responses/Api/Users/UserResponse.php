<?php

namespace App\Http\Responses\Api\Users;

use App\Models\User;

class UserResponse
{
    /**
     * The id for the user.
     *
     * @var int
     */
    public $id;

    /**
     * The name for the user.
     *
     * @var string
     */
    public $name;

    /**
     * The email for the user.
     *
     * @var string
     */
    public $email;

     /**
     * The roles for the user.
     *
     * @var array
     */
    public $roles;

    /**
     * The created_at for the user.
     *
     * @var DateTime
     */
    public $created_at;

    /**
     * The updated_at for the user.
     *
     * @var DateTime
     */
    public $updated_at;

    /**
     * User response DTO instance.
     *
     * @param User $user The user.
     */
    public function __construct(User $user)
    {
        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->roles = $user->getRoleNames();
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];
    }
}
