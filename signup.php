<?php
session_start();

if (!empty($_SESSION['userid'])){
    header('Location: home');
    exit();
}

include __DIR__ . '/app/views/headerView.php';
include __DIR__ . '/app/views/signupView.php';
include __DIR__ . '/app/views/navbarView.php';
include __DIR__ . '/app/views/footerView.php';
include __DIR__ . '/app/config.php';
include __DIR__ . '/app/controlers/userControler.php';


$data = [];
$data["title"] = "Signup";

if (!empty($_POST)){

    $userControler = new UserControler();

    $errors = $userControler->validateRegistration();

    if(empty($errors)){
        $userControler->registerUser();

        header('Location: home');
        exit();
    } else {
        $data["errors"] = $errors;
    }
}

$header = new HeaderView();
$navbar = new NavbarView();
$signup = new SignupView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$signup->view($data);
$footer->view($data);