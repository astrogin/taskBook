<?php

namespace app\models;

class TaskModel extends BaseModel
{
    public function create($params)
    {
        $selectUserData = "SELECT id, first_name, last_name, email
        FROM task_data_user
        WHERE first_name = ? AND last_name = ? AND email = ?";

        $userData = $this->query($selectUserData, $params);

        // try {

        //$this->pdo->beginTransaction();
        if (!$userData->fetchObject()) {

            $this->query("INSERT INTO task_data_user(`first_name`,`last_name`,`email`) VALUES (?,?,?)", $params);

            $userData = $this->query($selectUserData, $params)->fetchObject();

        }

        $this->query("INSERT INTO tasks(`user_data_id`,`descrition`,`image`) VALUES (?,?,?)", $params);

        print_r($userData->fetchObject());

        /*} catch (\Exception $exception) {

            $this->pdo->rollBack();
        }*/
        //$userData = $this->query("INSERT INTO $this->table(`firstname`,`lastname`,`email`) VALUES (?,?,?)", $params);
        //print_r($userData);
        //$this->query("INSERT INTO $this->table(`reality`,`vertual`,`statistic`) VALUES (?,?,?)", $params);
    }
}