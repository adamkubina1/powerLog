<?php
session_start();

include __DIR__ . '/app/views/headerView.php';
include __DIR__ . '/app/views/homeView.php';
include __DIR__ . '/app/views/navbarView.php';
include __DIR__ . '/app/views/footerView.php';
include __DIR__ . '/app/config.php';
include __DIR__ . '/app/controlers/userControler.php';


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