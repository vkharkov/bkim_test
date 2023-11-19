<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientRepository
{

    public function getBuilder($email)
    {
        return Client::query()->leftJoin('users','userd.id','=','clients.user_id');
    }

    public function findByPhone($phone): Client|null
    {
        return $this->getBuilder()->where('users.phone','=', $phone)->first(['clients.*']);
    }

    public function findByEmail($email): Client|null
    {
        return $this->getBuilder()->where('users.email','=', $email)->first(['clients.*']);
    }

}
