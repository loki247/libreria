<?php

namespace App\Mappers\Auth;

use App\Models\Auth\User;

class UserMapper{
    public static function getById($id) {
        return User::select(
            "users.id",
            "users.username",
            "roles.id as id_rol",
            "roles.nombre as nombre_rol",
            "users.email")
        ->leftjoin("roles", "roles.id", "=", "users.role_id")
        ->where([
            ['users.id', $id]
        ])->first();
    }

    public static function getByEmail($email){
        return User::select(
            "users.id",
            "users.username",
            "roles.id as id_rol",
            "roles.nombre as nombre_rol",
            "users.email")
        ->leftjoin("roles", "roles.id", "=", "users.role_id")
        ->where([
            ["email", $email]
        ])->first();
    }

    public static function getByUsername($username){
        return User::select(
            "users.id",
            "users.username",
            "roles.id as idRol",
            "roles.nombre as nombreRol",
            "users.email",
            "users.foto_perfil as fotoPerfil")
        ->leftjoin("roles", "roles.id", "=", "users.role_id")
        ->where([
            ["username", $username]
        ])->first();
    }
}
