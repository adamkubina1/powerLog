<?php

require_once __DIR__ . '/app/config.php';

$data = [];
$data["title"] = "Friend progress";

$userControler = new UserControler();
$userControler->validateUser();

$friendControler = new FriendsControler();
if(!($friendControler->validateFriend()) || $_GET["name"] == $_SESSION["username"]){
    header('Location: home');
    exit();
}

$data["friendName"] = $_GET["name"];

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

    $userPer = $perControler->getUserPerformance();

    if(!empty($userPer)){
        $graphData = $perControler->prepareDataForGraph($userPer);

        $data["graphData"] = $graphData;
        $data["graphTitle"] = $exControler->getExerciseName($_GET["exercise"]);
    }

    $friendPer = $perControler->getFriendPerformance();

    if(!empty($friendPer)){
        $graphDataFr = $perControler->prepareDataForGraph($friendPer);

        $data["graphDataFr"] = $graphDataFr;
    }
}


$header = new HeaderView();
$navbar = new NavbarView();
$frProgres = new FriendProgressView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$frProgres->view($data);
$footer->view($data);