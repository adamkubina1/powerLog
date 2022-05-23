<?php

require_once 'config.php';

$db = new PDO('mysql:host=127.0.0.1;dbname=kuba10;charset=utf8', 'kuba10', 'Aidohn3ho9Yu3Eiy3g');

//Throw error
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);