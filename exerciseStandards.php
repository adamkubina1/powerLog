<?php

require_once __DIR__ . '/app/config.php';


$userControler = new UserControler();
$userControler->validateUser();

$data = [];
$data["title"] = "Exercise standards";

//If user is not logged he is redirected to signup page
if (!empty($_SESSION['userid']) && !empty($_SESSION['username'])) {
    $data["username"] = $_SESSION['username'];
} else {
    header('Location: signup');
    exit();
}

$exControler = new ExercisesControler();

$data["exercises"] = $exControler->getAllExercises();

if(!empty($_GET["exercise"])){
    $perControler = new PerformancesControler();

    $userData = $perControler->getUserPerformance();
    $allData = $perControler->getAllPerformances();

    $presentingData = $perControler->createDataForExerciseStandards($userData, $allData);

    if(!empty($presentingData)){
        $data["exerciseStandard"] = $presentingData;
    }
}

$header = new HeaderView();
$navbar = new NavbarView();
$exSt = new ExerciseStandartsView();
$footer = new FooterView();


$header->view($data);
$navbar->view($data);
$exSt->view($data);
$footer->view($data);