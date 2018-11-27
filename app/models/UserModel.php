<?php

namespace app\models;


class UserModel extends BaseModel
{
    /**
     * @param string $username
     * @param $password
     * @return mixed
     * @throws \Exception
     */
    public function login(string $username, $password)
    {
        $sql = "SELECT id, login, role FROM users WHERE login = ? AND password = ? ";

        $user = $this->query($sql, [$username, $password])->fetchObject();

        if ($user) {

            return $user;
        }

        throw new \Exception('Wrong credentials', 422);
    }
}