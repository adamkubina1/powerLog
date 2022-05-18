<?php

class ExercisesModel {
    private $connection;

    function __construct(){
        require __DIR__ . '/../db.php';
        $this->connection = $db;
    }

    function getAllExercises(){
        $exercisesQuery = $this->connection->prepare('SELECT * FROM exercises;');
        $exercisesQuery->execute();

        return $exercisesQuery;
    }

    function getExerciseById($id){
        $exerciseQuery = $this->connection->prepare('SELECT * FROM exercises WHERE exercise_id=:id LIMIT 1;');
        $exerciseQuery->execute([
            ':id'=>$id
        ]);

        return $exerciseQuery;
    }
}