<?php

class PerfomancesModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }


    function insertPerfomance($userid, $exerciseid, $performance){
        $query = $this->connection->prepare('INSERT INTO performances (user_id, exercise_id, performance) VALUES (:userid, :exerciseid, :performance);');
        $query->execute([
            ':userid'=>$userid,
            ':exerciseid'=>$exerciseid,
            ':performance'=>$performance,
        ]);
    }
}