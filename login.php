<?php
session_start();

if (!empty($_SESSION['userid'])){
    header('Location: home');
    exit();
}

include __DIR__ . '/app/views/headerView.php';
include __DIR__ . '/app/views/loginView.php';
include __DIR__ . '/app/views/navbarView.php';
include __DIR__ . '/app/views/footerView.php';
include __DIR__ . '/app/config.php';
include __DIR__ . '/app/controlers/userControler.php';



$data = [];
$data["title"] = "Login";

if(!empty($_POST)){
    $userControler = new UserControler();

    $errors = $userControler->loginUser();

    //Login successful
    if(empty($errors)){
        header('Location: home');
        exit();
    } else {
        $data["errors"] = $errors;
    }
}





$header = new HeaderView();
$navbar = new NavbarView();
$login = new LoginView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$login->view($data);
$footer->view($data);