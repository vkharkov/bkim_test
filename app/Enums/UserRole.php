<?php

namespace App\Enums;

enum UserRole: string
{

    /** Admin role */
    case Admin = 'admin';

    /** Client role */
    case Client = 'client';

    /** User role, without any surveys */
    case User = 'user';

    /** Utility */
    public function role(): string
    {
        return match($this) {
            UserRole::User => 'user',
            UserRole::Admin => 'admin',
            UserRole::Client => 'client',
        };
    }

    /** Utility for lists */
    public function bgColor(): string
    {
        return match($this) {
            UserRole::User => '#F4D03F',
            UserRole::Admin => '#3498DB',
            UserRole::Client => '#2ECC71',
        };
    }

}
