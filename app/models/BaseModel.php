<?php

namespace app\models;
use PDO;

class BaseModel
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $buffer = include '../config/database.php';
        $config = $buffer['mysql'];

        $this->pdo = new PDO("mysql:host=" . $config['db_host'] . ";dbname=" . $config['db_name'],
            $config['db_user'], $config['db_password']);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function query($str, $param)
    {
        $stmt = $this->pdo->prepare($str);
        $stmt->execute($param);
        return $stmt;
    }
}