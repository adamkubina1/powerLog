<?php


include __DIR__ . '/app/views/headerView.php';
include __DIR__ . '/app/views/homeView.php';
include __DIR__ . '/app/views/navbarView.php';
include __DIR__ . '/app/views/footerView.php';

include __DIR__ . '/app/config.php';


$header = new Header();
$navbar = new Navbar();
$home = new Home();
$footer = new Footer();

$data = [];
$data["title"] = "Home";

$header->view($data);
$navbar->view();
$home->view();
$footer->view();