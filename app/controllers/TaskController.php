<?php

namespace app\controllers;

use app\models\ModelFactory;
use app\requests\CreateTaskRequest;
use app\services\fileService\ImageService;

class TaskController
{
    public function index()
    {
        $task = ModelFactory::getTaskModel();
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1;
        $data = $task->paginate($page);

        view('tasks', $data);
    }

    public function create()
    {
        $request = new CreateTaskRequest();

        $newTask = $request->getParams();

        $image = $newTask->getImage();
        $imageService = new ImageService($image);
        $image->setPath($imageService->saveFile());

        $task = ModelFactory::getTaskModel();
        $result = $task->create($newTask);

        if ($result) {
            echo 'good';
        }

    }

}