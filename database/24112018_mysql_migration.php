<?php

$buffer = include '../config/database.php';
$config = $buffer['mysql'];

try {

    $conn = new PDO("mysql:host=" . $config['db_host'] . ";dbname=" . $config['db_name'],
        $config['db_user'], $config['db_password']);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($argv[1]) && $argv[1] === 'drop') {
        $dropper = "DROP TABLE IF EXISTS users, task_data_user, tasks";
        $conn->exec($dropper);
        echo "Table dropped";
        return;
    }

    $usersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    login VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('1', '2') DEFAULT '2'
    )";

    $taskDataUserTable = "CREATE TABLE IF NOT EXISTS task_data_user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
    )";

    $tasksTable = "CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_data_id INT UNSIGNED NOT NULL,
    description TEXT(65535) NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_data_id) REFERENCES task_data_user(id) ON DELETE CASCADE
    )";

    $conn->exec($usersTable);
    echo "Table users created successfully ";

    $conn->exec($taskDataUserTable);
    echo "Table task_data_user created successfully ";

    $conn->exec($tasksTable);
    echo "Table tasks created successfully ";

} catch (PDOException $e) {

    echo $sql . "<br>" . $e->getMessage();

}

$conn = null;

