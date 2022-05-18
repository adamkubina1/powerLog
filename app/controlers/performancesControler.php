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

    function getUserPerformance() {
        return $this->performancesModel->getPerformancesByUserId($_SESSION["userid"], $_GET["exercise"])->fetchAll();
    }

    function getAllPerformances() {
        return $this->performancesModel->getPerformancesByExercise($_GET["exercise"])->fetchAll();
    }

    function createDataForExerciseStandards($userPerformance, $allPerformances){
        $best = $this->findBestPerformance($userPerformance);
        $worst = $this->findWorstPerformance($userPerformance);
        $allPerformances = $this->filterBestPerformances($allPerformances);

        if(empty($best) || empty($worst)){
            return [];
        }
        $countLatest = 1;
        $countBest = 1;
        $countWorst = 1;
        $count = 1;

        $totalCount = count($allPerformances);
        if($totalCount == 0){
            return [];
        }

        $columns = array_column($allPerformances, 'performance');
        array_multisort($columns, SORT_ASC, $allPerformances);

        foreach ( $allPerformances as $allP){
            if($allP["performance"] == $best["performance"]){
                $countBest = $count;
            }
            if($allP["performance"] == $worst["performance"]){
                $countWorst = $count;
            }

            $count++;
        }


        $bestPrc = ($countBest / $totalCount) * 100;
        $worstPrc = ($countWorst / $totalCount) * 100;

        $resultArray = [];
        $resultArray["best"] = $bestPrc;
        $resultArray["worst"] = $worstPrc;

        return $resultArray;
    }

    private function findWorstPerformance($userPerformance){
        if(count($userPerformance) <= 0){
            return [];
        }
        $worst = $userPerformance[0];

        foreach ($userPerformance as $up){
            if($up["performance"] < $worst["performance"]){
                $worst = $up;
            }
        }

        return $worst;
    }

    private function findBestPerformance($userPerformance){
        if(count($userPerformance) <= 0){
            return [];
        }
        $best = $userPerformance[0];

        foreach ($userPerformance as $up){
            if($up["performance"] > $best["performance"]){
                $best = $up;
            }
        }

        return $best;
    }

    //This function is stupid, but necessary due to poor architecture design decisions
    private function filterBestPerformances($allPerformances){
        $newArray = [];

        if(count($allPerformances) <= 1){
            return $newArray;
        }
        for( $i = 0; $i < count($allPerformances); $i++){
            if(!array_search($allPerformances[$i]["user_id"], array_column($newArray, "user_id"))){
                $next = $allPerformances[$i];

                for( $j = $i + 1; $j < count($allPerformances); $j++){
                    if($allPerformances[$i]["user_id"] == $allPerformances[$j]["user_id"] && $allPerformances[$j]["performance"] > $next["performance"]){
                        $next = $allPerformances[$j];
                    }
                }

                $newArray[] = $next;
            }
        }


        return $newArray;
    }

}