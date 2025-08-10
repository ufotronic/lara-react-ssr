<?php

namespace App\Enum;

enum RolesEnum: string
{
    case Admin = 'admin';

    case User = 'user';

    case Commenter = 'commenter';

    public static function labels():array {

        return [
            self::Admin->value => 'Admin',
            self::Commenter->value => 'Commenter',
            self::User->value => 'User',
        ];
    }

    public function label()
    {
        return match($this) {
            self::Admin => 'Admin',
            self::User => 'User',
            self::Commenter => 'Commenter',
        };
    }


}
