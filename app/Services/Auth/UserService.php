<?php

namespace App\Services\Auth;

use App\Mappers\Auth\UserMapper;

class UserService{
    public static function getById($id){
        return UserMapper::getById($id);
    }

    public static function getByEmail($email){
        return UserMapper::getByEmail($email);
    }
}
