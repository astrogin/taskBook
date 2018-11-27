<?php

namespace app\controllers;

use app\models\ModelFactory;
use app\requests\LoginRequest;

class AuthController
{
    public function login()
    {
        $request = new LoginRequest();
        $credentials = $request->getParams();
        $userModel = ModelFactory::getUserModel();
        $user = $userModel->login($credentials['login'], $credentials['password']);

        $user = [
            'id' => $user->id,
            'role' => $user->role,
            'login' => $user->login
        ];

        setcookie("beejeeTaskUser", json_encode($user), time() + 50000, "/");

        $_SESSION['authUser'] = $user;

        redirect('/');
    }
}