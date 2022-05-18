<?php

class PerfomancesModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }


    function insertPerfomance($userid, $exerciseid, $performance){
        $timestamp = date("Y-m-d h:i:sa");
        $query = $this->connection->prepare('INSERT INTO performances (user_id, exercise_id, performance, timestamp) VALUES (:userid, :exerciseid, :performance, :timestamp);');
        $query->execute([
            ':userid'=>$userid,
            ':exerciseid'=>$exerciseid,
            ':performance'=>$performance,
            ':timestamp'=>$timestamp
        ]);
    }

    function getPerformancesByUserId($userid, $exerciseid){
        $query = $this->connection->prepare('SELECT * FROM performances WHERE user_id=:userid AND exercise_id=:exerciseid;');
        $query->execute([
            ':userid'=>$userid,
            ':exerciseid'=>$exerciseid
        ]);

        return $query;
    }

    function getPerformancesByExercise($exerciseid){
        $query = $this->connection->prepare('SELECT * FROM performances WHERE exercise_id=:exerciseid');
        $query->execute([
            ':exerciseid'=>$exerciseid
        ]);

        return $query;
    }
}