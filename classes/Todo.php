<?php

class Todo {
    private $conn;
    private $table_name = "todos";

    public $id;
    public $title;
    public $context;
    public $time;

    public function __construct($db) {
        $this->conn = $db;

    }
    //Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title, context, time) VALUES (:title, :context, :time)"; 
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
    
    //Read
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //Update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title = :title, context = :context, time = :time WHERE id = :id";
        $stmt = $this->conn->preprare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":context", $this->context);
        $stmt->bindParam(":time", $this->time);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    //delele 
    public function delele() {
        $query= "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
        
    
}

?>