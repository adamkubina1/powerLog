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
}