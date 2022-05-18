<?php
session_start();

include __DIR__ . '/app/views/headerView.php';
include __DIR__ . '/app/views/exerciseStandartsView.php';
include __DIR__ . '/app/views/navbarView.php';
include __DIR__ . '/app/views/footerView.php';
include __DIR__ . '/app/config.php';
include __DIR__ . '/app/controlers/userControler.php';


$userControler = new UserControler();
$userControler->validateUser();

$data = [];
$data["title"] = "Exercise standarts";

//If user is not logged he is redirected to signup page
if (!empty($_SESSION['userid']) && !empty($_SESSION['username'])) {
    $data["username"] = $_SESSION['username'];
} else {

    header('Location: signup');
    exit();

}


$header = new HeaderView();
$navbar = new NavbarView();
$exSt = new ExerciseStandartsView();
$footer = new FooterView();


$header->view($data);
$navbar->view($data);
$exSt->view($data);
$footer->view($data);