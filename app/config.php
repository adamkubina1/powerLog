<?php

session_start();

//const DB_NAME = 'kuba10';
//const DB_USERNAME = 'kuba10';
//const DB_PASSWORD = 'Aidohn3ho9Yu3Eiy3g';
//NOT VALID CREDENTIALS

const BASE_URL = '/~kuba10/powerLog-4iz278';


include __DIR__ . '/views/headerView.php';
include __DIR__ . '/views/exerciseStandartsView.php';
include __DIR__ . '/views/navbarView.php';
include __DIR__ . '/views/footerView.php';
include __DIR__ . '/views/homeView.php';
include __DIR__ . '/views/loginView.php';
include __DIR__ . '/views/prLogView.php';
include __DIR__ . '/views/progressTrackerView.php';
include __DIR__ . '/views/settingsView.php';
include __DIR__ . '/views/signupView.php';
include __DIR__ . '/views/socialView.php';
include __DIR__ . '/views/friendProgressView.php';

include __DIR__ . '/controlers/userControler.php';
include __DIR__ . '/controlers/exercisesControler.php';
include __DIR__ . '/controlers/performancesControler.php';
include __DIR__ . '/controlers/friendsControler.php';