<?php

namespace app\controllers;

use app\models\ModelFactory;
use app\requests\CreateTaskRequest;

class TaskController
{
    public function index()
    {
        $data = ['asdasd'];
        view('tasks', $data);
    }

    public function create()
    {
        $request = new CreateTaskRequest();
        $newTask = $request->getParams();
        /*$task = ModelFactory::getTaskModel();
        $result = $task->create($request->getParams());*/

        echo 'created';
    }

}