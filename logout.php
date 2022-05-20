<?php

require_once __DIR__ . '/app/config.php';

$userControler = new UserControler();

$userControler->logOutUser();

header('Location: home');
