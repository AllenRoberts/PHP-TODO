<?php 

$connection = require_once './Connection.php';


/*
Checks if there is currently a selected task
If so updates the info for that task in the database instead 
of adding a new one.
*/
$id = $_POST['id'] ?? '';
if ($id) {
    $connection->updateTask($id, $_POST);
} else {
    $connection->addTask($_POST);
}

header('Location: index.php');