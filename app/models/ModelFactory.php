<?php

namespace app\models;

class ModelFactory
{
    public static function getTaskModel()
    {
        return new TaskModel();
    }

    public static function getUserModel()
    {
        return new UserModel();
    }
}