<?php

require_once __DIR__ . '/app/config.php';

if (!empty($_SESSION['userid'])){
    header('Location: home');
    exit();
}


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