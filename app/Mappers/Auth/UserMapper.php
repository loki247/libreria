<?php

namespace App\Mappers\Auth;

use App\Models\Auth\User;

class UserMapper{
    public static function getById($id) {
        return User::select(
            "usuario.id",
            "roles.id as id_rol",
            "roles.nombre as nombre_rol",
            "usuario.rut",
            "usuario.nombres",
            "usuario.apellidos",
            "usuario.email",
            "usuario.telefono",
            "usuario.direccion",
            "comuna.id as id_comuna",
            "comuna.nombre as nombre_comuna")
        ->leftjoin("auth.roles", "roles.id", "=", "usuario.id_rol")
        ->leftjoin("configs.comuna", "comuna.id", "=", "usuario.id_comuna")
        ->where([
            ['usuario.id', $id]
        ])->first();
    }

    public static function getByEmail($email){
        return User::where("email", $email)->first();
    }
}
