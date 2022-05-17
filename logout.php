<?php
session_start();

include __DIR__ . '/app/controlers/userControler.php';


$userControler = new UserControler();

$userControler->logOutUser();

header('Location: home');
