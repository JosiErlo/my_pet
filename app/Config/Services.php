<?php

namespace Config;

use App\Services\UserService;

class Services extends \CodeIgniter\Config\Services
{
    public static function userService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService(new \App\Models\UserModel());
    }

    public $aliases = [
        'userService' => UserService::class,
    ];
}
