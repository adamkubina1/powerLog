<?php

require_once __DIR__ . '/app/config.php';

$data = [];
$data["title"] = "Settings";

$userControler = new UserControler();
$userControler->validateUser();

//If user is not logged he is redirected to signup page
if (!empty($_SESSION['userid']) && !empty($_SESSION['username'])) {
    $data["username"] = $_SESSION['username'];
} else {
    header('Location: signup');
    exit();
}

if (!empty($_POST)){

    $userControler = new UserControler();

    $errors = $userControler->validatePasswordChange();

    if(empty($errors)){
        $userControler->changePassword();

        $data["success"] = "Password successfully changed!";
    } else {
        $data["errors"] = $errors;
    }
}

$header = new HeaderView();
$navbar = new NavbarView();
$settings = new SettingsView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$settings->view($data);
$footer->view($data);