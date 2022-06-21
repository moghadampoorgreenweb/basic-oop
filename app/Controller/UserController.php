<?php

namespace Controller;

use Helper\Config;
use Model\User;

class UserController
{
    public function __construct()
    {


    }

    public function login($request)
    {
        $userModel = new User();
        $userModel->verifyUser($request['email'], md5($request['password']));

        echo $userModel->email;

    }

    public function register()
    {
        echo 'Register Controller';
    }
}