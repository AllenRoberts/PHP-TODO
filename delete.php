<?php 

$connection = require_once './Connection.php';


/*
Deletes Task
*/

$connection->removeTask($_POST['id']);

header('Location: index.php');