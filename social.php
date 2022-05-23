<?php

require_once __DIR__ . '/app/config.php';

$data = [];
$data["title"] = "Social";

$userControler = new UserControler();
$userControler->validateUser();

//If user is not logged he is redirected to signup page
if(!empty($_SESSION['userid']) && !empty($_SESSION['username'])){
    $data["username"] = $_SESSION['username'];
} else {
    header('Location: signup');
    exit();
}

$friendsControler = new FriendsControler();
$friendRequests = $friendsControler->getAllPendingFriendRequests();
$friendRequests = $friendsControler->appendUsernameToRequests($friendRequests);
$data["friendRequests"] = $friendRequests;

$friends = $friendsControler->getAllAcceptedFriendRequests();
$friends = $friendsControler->appendUserNameWithoutUser($friends);
$data["friends"] = $friends;

if(!empty($_POST)){
    if(!empty($_POST["send"])){
        if($friendsControler->verifySend()){
            $friendsControler->createFriendsRequest();
            header('Location: social');
        }
    }
    if(!empty($_POST["accept"])){
        $friendsControler->acceptRequest();
        header('Location: social');
    }
    if(!empty($_POST["delete"])){
        $friendsControler->deleteRequest();
        header('Location: social');
    }
}



$header = new HeaderView();
$navbar = new NavbarView();
$social = new SocialView();
$footer = new FooterView();

$header->view($data);
$navbar->view($data);
$social->view($data);
$footer->view($data);


