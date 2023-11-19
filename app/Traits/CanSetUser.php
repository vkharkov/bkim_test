<?php

namespace App\Traits;


use App\Models\User;

trait CanSetUser
{
    /** @var User */
    public $user;

    /**
     * @param  User|int  $user
     * @return $this
     */
    public function setUser(User|int $user): self
    {

        match (true) {
            is_int($user) && $user > 0 => $this->user = User::where('id', '=', $user)->first(),
            $user instanceof User => $this->user = $user
        };

        return $this;

    }

}
