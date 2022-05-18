<?php

include_once __DIR__ . '/../models/exercisesModel.php';
include_once __DIR__ . '/../models/performancesModel.php';

class PerformancesControler{
    private $performancesModel;
    private $exercisesModel;

    function __construct() {
        $this->performancesModel = new PerfomancesModel();
        $this->exercisesModel = new ExercisesModel();
    }


    function validatePerformance(){
        $errors = [];


        //Check if exercise is in the database
        $exercise = $this->exercisesModel->getExerciseById($_POST["exercise"]);
        if($exercise->rowCount() != 1){
            $errors["exercise"] = "This exercise does not exist in our system";
        }


        $performance = intval($_POST["performance"]);
        //Intval is 0 if the field is empty or different format
        if($performance <= 0 || $performance > 1000) {
            $errors["performance"] = "Performance is not in allowed format";
        }

        return $errors;
    }

    function addPerformance(){
        $this->performancesModel->insertPerfomance($_SESSION["userid"],$_POST["exercise"], intval($_POST["performance"]));
    }
}