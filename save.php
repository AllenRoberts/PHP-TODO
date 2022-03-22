<?php 

$connection = require_once './Connection.php';

$id = $_POST['id'] ?? '';
if ($id) {
    $connection->updateTask($id, $_POST);
} else {
    $connection->addTask($_POST);
}

header('Location: index.php');