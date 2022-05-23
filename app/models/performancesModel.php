<?php

class PerfomancesModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }


    function insertPerfomance($userid, $exerciseid, $performance, $gender, $weight){
        $timestamp = date("Y-m-d h:i:sa");
        $query = $this->connection->prepare('INSERT INTO performances (user_id, exercise_id, performance, timestamp, gender, weight) VALUES (:userid, :exerciseid, :performance, :timestamp, :gender, :weight);');
        $query->execute([
            ':userid'=>$userid,
            ':exerciseid'=>$exerciseid,
            ':performance'=>$performance,
            ':timestamp'=>$timestamp,
            ':gender'=>$gender,
            ':weight'=>$weight
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

    function getPerformancesByParams($exerciseid, $gender, $weight){
        $query = $this->connection->prepare('SELECT * FROM performances WHERE exercise_id=:exerciseid AND gender=:gender AND weight=:weight');
        $query->execute([
            ':exerciseid'=>$exerciseid,
            ':gender'=>$gender,
            ':weight'=>$weight
        ]);

        return $query;
    }
}