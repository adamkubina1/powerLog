<?php

include_once __DIR__ . '/../models/exercisesModel.php';
include_once __DIR__ . '/../models/performancesModel.php';
include_once __DIR__ . '/../models/usersModel.php';

class PerformancesControler{
    private $performancesModel;
    private $exercisesModel;
    private $usersModel;

    function __construct() {
        $this->performancesModel = new PerfomancesModel();
        $this->exercisesModel = new ExercisesModel();
        $this->usersModel = new UsersModel();
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
        $user = $this->usersModel->getUserById($_SESSION["userid"])->fetch(PDO::FETCH_ASSOC);

        $this->performancesModel->insertPerfomance($_SESSION["userid"],$_POST["exercise"], intval($_POST["performance"]), $user["gender"], $user["weight"]);
    }

    function getUserPerformance() {
        return $this->performancesModel->getPerformancesByUserId($_SESSION["userid"], $_GET["exercise"])->fetchAll();
    }

    function getFriendPerformance() {
        $user = $this->usersModel->getUserByUserName($_GET["name"])->fetch(PDO::FETCH_ASSOC);

        return $this->performancesModel->getPerformancesByUserId($user["user_id"], $_GET["exercise"])->fetchAll();
    }

    function getAllPerformances() {
        $user = $this->usersModel->getUserById($_SESSION["userid"])->fetch(PDO::FETCH_ASSOC);

        return $this->performancesModel->getPerformancesByParams($_GET["exercise"], $user["gender"], $user["weight"])->fetchAll();
    }

    function createDataForExerciseStandards($userPerformance, $allPerformances){
        $best = $this->findBestPerformance($userPerformance);
        $worst = $this->findWorstPerformance($userPerformance);
        $allPerformances = $this->filterBestPerformances($allPerformances);

        if(empty($best) || empty($worst)){
            return [];
        }
        $countBest = 0;
        $countWorst = 0;
        $count = 0;

        $totalCount = count($allPerformances) - 1;
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
        $resultArray["bestPerformance"] = $best["performance"];

        $resultArray["worst"] = $worstPrc;
        $resultArray["worstPerformance"] = $worst["performance"];

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

    function prepareDataForGraph($userPerformance){
        $newArray = [];

        foreach ($userPerformance as $up){
            //Extracts date from timestamp, there is probably cleaner way to do this, but no time xd
            $dateArr = explode(' ', $up["timestamp"]);

            $newArray[] = array("y" => $up["performance"], "label" => $dateArr[0]);
        }

        return $newArray;
    }

}