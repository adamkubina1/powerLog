<?php

class UsersModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }

    function getUserById($id){
        $userQuery = $this->connection->prepare('SELECT user_id FROM users WHERE user_id=:id LIMIT 1;');
        $userQuery->execute([
            ':id'=>$id
        ]);

        return $userQuery;
    }

    function getUserByEmail($email){
        $userQuery = $this->connection->prepare('SELECT * FROM users WHERE email=:email LIMIT 1;');
        $userQuery->execute([
            ':email'=>trim($email)
        ]);

        return $userQuery;
    }

    function getLastId(){
        return $this->connection->lastInsertId();
    }

    function insertUser($username, $email, $password, $gender, $weight){
        $query = $this->connection->prepare('INSERT INTO users (username, email, password, gender, weight) VALUES (:username, :email, :password, :gender, :weight);');
        $query->execute([
            ':username'=>trim($username),
            ':email'=>trim($email),
            ':password'=>$password,
            ':gender'=>$gender,
            ':weight'=>$weight,
        ]);
    }
}