<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getById($id) {
        return UserService::getById($id);
    }

    public function getByUsername($username) {
        return UserService::getByUsername($username);
    }
}
