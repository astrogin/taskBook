<?php

function view(string $name, array $data = [])
{
    require_once 'views/header.php';
    require_once 'views/' . $name . '.php';
    require_once 'views/footer.php';
}

function redirect(string $path)
{
    header("Location: $path");
}
