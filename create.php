<?php

$connection = require_once './Connection.php';
$connection->addTask($_POST);

header('Location: index.php');