<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'first_name',
        'middle_name',
        'last_name',

        'dob',

        'email',
        'phone',

        'address',
    ];


    protected $hidden = [
        'user_id',
    ];

}
