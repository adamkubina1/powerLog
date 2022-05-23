<?php

require_once __DIR__ . '/app/config.php';

$data = [];
$data["title"] = "PR log";

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


if(!empty($_POST)){
    $perControler = new PerformancesControler();

    $errors = $perControler->validatePerformance();

    if(empty($errors)){
        $perControler->addPerformance();
        $data["success"] = "Successfully added your PR!";
    } else {
        $data["fail"] = "Something went wrong while trying to log your PR";
    }

}

$header = new HeaderView();
$navbar = new NavbarView();
$prLog = new PrLogView();
$footer = new FooterView();


$header->view($data);
$navbar->view($data);
$prLog->view($data);
$footer->view($data);