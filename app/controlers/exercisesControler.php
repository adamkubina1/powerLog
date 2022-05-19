<?php

include_once __DIR__ . '/../models/exercisesModel.php';

class ExercisesControler{
    private $exercisesModel;

    function __construct() {
        $this->exercisesModel = new ExercisesModel();
    }

    function getAllExercises(){
        $exercises = $this->exercisesModel->getAllExercises();
        return $exercises->fetchAll(PDO::FETCH_ASSOC);
    }

    function getExerciseName($exercise_id){
        $exercise =  $this->exercisesModel->getExerciseById($exercise_id)->fetchAll();

        if(count($exercise) < 1){
            return "";
        }

        return $exercise[0]["name"];
    }
}