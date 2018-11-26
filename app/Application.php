<?php

namespace app;

use app\controllers\Router;

class Application
{
    public function init()
    {
        require_once 'helpers.php';

        $router = new Router();
        $router->handle();
    }
}
