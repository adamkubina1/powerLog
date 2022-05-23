<?php

require_once __DIR__ . '/app/config.php';

if (!empty($_SESSION['userid'])){
    header('Location: home');
    exit();
}



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