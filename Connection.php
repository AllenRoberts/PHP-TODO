<?php


class Connection
{
    public PDO $pdo;

    /*
    Makes initial connection to database
    */
    public function __construct()
    {
        try{
        $this->pdo = new PDO('mysql:server=localhost;dbname=todo', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch (PDOException $exception) {
        echo "ERROR: " . $exception->getMessage();
    }
}

    /*
    Gets all tasks by the date they were added
    */
    public function getTasks()
    {
        $statement = $this->pdo->prepare("SELECT * from todo order by date_added DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    Takes inputted data and adds it to database
    */
    public function addTask($task){
        $statement = $this->pdo->prepare("INSERT INTO todo (title, task_description, date_added) VALUES (:title, :task_description, :date)");
        $statement->bindValue(':title', $task['title']);
        $statement->bindValue(':task_description', $task['task_description']);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        return $statement->execute();


    }

    /*
    Takes new data and updates task by ID
    */
    public function updateTask($id, $task)
    {
        $statement = $this->pdo->prepare("UPDATE todo SET title = :title, task_description = :task_description WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->bindValue(':title', $task['title']);
        $statement->bindValue(':task_description', $task['task_description']);
        return $statement->execute();
    }

    /*
    Gets task data by ID
    */
    public function getTaskById($id)
    {
        $statement = $this->pdo->prepare("SELECT * from todo where id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /*
    Removes task data by ID
    */
    public function removeTask($id){
        $statement = $this->pdo->prepare("DELETE from todo where id = :id");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }

}

return new Connection();