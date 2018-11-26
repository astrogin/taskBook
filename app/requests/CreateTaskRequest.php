<?php

namespace app\requests;

use app\types\Image;
use app\types\Task;

class CreateTaskRequest extends Request
{

    /**
     * @return Task
     * @throws \Exception
     */
    public function getParams(): Task
    {
        if (
            isset($this->data['first_name']) && strlen($this->data['first_name']) > 1
            && isset($this->data['last_name']) && strlen($this->data['last_name']) > 1
            && isset($this->data['email']) && filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)
            && isset($this->data['description']) && strlen($this->data['description']) > 1
            && isset ($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])
            && getimagesize($_FILES['image']['tmp_name']) !== false
        ) {

            $image = $_FILES['image'];
            $image = new Image($image['name'], $image['type'], $image['tmp_name'], $image['size']);

            return new Task($this->data['first_name'], $this->data['last_name'],
                $this->data['email'], $this->data['description'], $image);
        }

        throw new \Exception('Bad request', 400);
    }
}
