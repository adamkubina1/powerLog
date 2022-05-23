<?php

require_once __DIR__ . '/app/config.php';

$data = [];
$data["title"] = "Progress Tracker";

$userControler = new UserControler();
$userControler->validateUser();

//If user is not logged he is redirected to signup page
if(!empty($_SESSION['userid']) && !empty($_SESSION['username'])){
    $data["username"] = $_SESSION['username'];
} else {
    header('Location: signup');
    exit();
}

$exControler = new ExercisesControler();

$data["exercises"] = $exControler->getAllExercises();

if(!empty($_GET["exercise"])){
    $perControler = new PerformancesControler();

    $userPer = $perControler->getUserPerformance();

    if(!empty($userPer)){
        $graphData = $perControler->prepareDataForGraph($userPer);

        $data["graphData"] = $graphData;
        $data["graphTitle"] = $exControler->getExerciseName($_GET["exercise"]);
    }
}


$header = new HeaderView();
$navbar = new NavbarView();
$progressTracker = new ProgressTrackerView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$progressTracker->view($data);
$footer->view($data);