<?php

$connection = require_once './Connection.php';
$tasks = $connection->getTasks();

$currentTask = [
    'id' => '',
    'title' => '',
    'task_description' => ''
];


if (isset($_GET['id'])) {
    $currentTask = $connection->getTaskById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="app.css?v=<?php echo time(); ?>">
</head>

<body>
    <div>
        <form class="new-task" action="save.php" method="post">
            <input type="hidden" name="id" value="<?php echo $currentTask['id'] ?>">
            <input type="text" name="title" placeholder="Task Name" autocomplete="off" required value="<?php echo $currentTask['title'] ?>">
            <textarea name="task_description" cols="30" rows="4" maxlength="30" placeholder="Brief Description"><?php echo $currentTask['task_description'] ?></textarea>
            <button><?php
                    if ($currentTask['id']) :
                    ?>
                    Update Task
                <?php else : ?>
                    Add New Task
                <?php endif; ?>
            </button>
        </form>
        <div class="tasks">
            <?php foreach ($tasks as $task) : ?>
                <div class="task">
                    <div class="title">
                        <a href="?id=<?php echo $task['id'] ?>">
                            <?php echo $task['title'] ?>
                        </a>
                    </div>
                    <div class="description">
                        <?php echo $task['task_description'] ?>
                    </div>
                    <small><?php echo date('d/m/Y H:i', strtotime($task['date_added'])) ?></small>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $task['id'] ?>">
                        <button class="close">X</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>