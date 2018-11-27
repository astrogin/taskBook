<?php

session_start();

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../app/Application.php';


$app = new \App\Application();

$app->init();
