<?php

require_once __DIR__ . '/app/config.php';

$userControler = new UserControler();
$userControler->validateUser();

$data = [];
$data["title"] = "Home";

if(!empty($_SESSION['userid']) && !empty($_SESSION['username'])){
    $data["username"] = $_SESSION['username'];
}


$header = new HeaderView();
$navbar = new NavbarView();
$home = new HomeView();
$footer = new FooterView();



$header->view($data);
$navbar->view($data);
$home->view($data);
$footer->view($data);