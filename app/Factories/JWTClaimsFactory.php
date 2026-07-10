<?php

namespace App\Factories;

use App\Models\User;

class JWTClaimsFactory
{
    public static function createClaims(User $user)
    {
        return [
            'id' => $user->id,
            'nombre' => $user->nombre,
            'role' => [
                'id' => $user->role_id,
                'nombre' => $user->role->nombre
            ],
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
