<?php

namespace app\controllers;

class Router
{
    /**
     * @var array
     */
    private $uri = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->uri = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);
        array_shift($this->uri);
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->handleStorageImages();

        if (!file_exists($this->getFile())) {

            throw new \Exception('file doesn\'t exist', 404);
        }

        if (class_exists($this->getClass())) {

            $class = $this->getClass();
            $controller = new $class();

        } else {

            throw new \Exception('class doesn\'t exist', 404);
        }

        if (method_exists($controller, $this->getAction())) {

            $method = $this->getAction();
            $controller->$method();

        } else {

            throw new \Exception('method doesn\'t exist', 404);
        }
    }

    /**
     * @return string
     */
    private function getFile(): string
    {
        if (count($this->uri)
            && array_key_exists(0, $this->uri)
            && strlen($this->uri[0]) > 1
        ) {
            return __DIR__ . '/' . ucfirst($this->uri[0]) . 'Controller.php';
        }
        return __DIR__ . '/' . 'TaskController.php';
    }

    /**
     * @return string
     */
    private function getClass(): string
    {
        if (count($this->uri)
            && array_key_exists(0, $this->uri)
            && strlen($this->uri[0]) > 1
        ) {

            return 'app\controllers\\' . ucfirst($this->uri[0]) . 'Controller';
        }
        return 'app\controllers\TaskController';
    }

    /**
     * @return string
     */
    private function getAction(): string
    {
        if (count($this->uri) && array_key_exists(1, $this->uri)) {
            return strtolower($this->uri[1]);
        }
        return 'index';
    }

    private function handleStorageImages()
    {
        if (count($this->uri)
            && array_key_exists(0, $this->uri)
            && $this->uri[0] === 'storage'
            && array_key_exists(1, $this->uri)
            && strlen($this->uri[1]) > 1
        ) {
            $file = '../storage/' . $this->uri[1];

            if (file_exists($file)) {
                $size = getimagesize($file);

                $fp = fopen($file, 'rb');

                if ($size and $fp) {

                    header('Content-Type: ' . $size['mime']);
                    header('Content-Length: ' . filesize($file));

                    fpassthru($fp);

                    exit();
                }
            }
        }
    }
}