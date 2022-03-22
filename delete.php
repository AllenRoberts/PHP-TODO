<?php 

$connection = require_once './Connection.php';

$connection->removeTask($_POST['id']);

header('Location: index.php');