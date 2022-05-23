<?php

include_once __DIR__ . '/../models/friendsModel.php';
include_once __DIR__ . '/../models/usersModel.php';

class FriendsControler{
    private $friendsModel;
    private $userModel;

    function __construct() {
        $this->friendsModel = new FriendsModel();
        $this->userModel = new UsersModel();
    }

    function getAllPendingFriendRequests(){
        return $this->friendsModel->getAllFriendsRequestsAccepter($_SESSION["userid"], "pending")->fetchAll();
    }
    function getAllAcceptedFriendRequests(){
        return $this->friendsModel->getAllFriendsRequestsBoth($_SESSION["userid"], "accepted")->fetchAll();
    }

    function appendUsernameToRequests($friendRequests){
        $newArray = $friendRequests;

        foreach ($newArray as $key => $fr){
            $user = $this->userModel->getUserById($fr["requester"])->fetch(PDO::FETCH_ASSOC);

            $newArray[$key]["requesterUsername"] = $user["username"];
        }

        return $newArray;
    }
    function appendUserNameWithoutUser($friends){
        $newArray = $friends;

        foreach ($newArray as $key => $fr){
            if($_SESSION["userid"] != $fr["requester"]){
                $user = $this->userModel->getUserById($fr["requester"])->fetch(PDO::FETCH_ASSOC);

                $newArray[$key]["username"] = $user["username"];
            } else {
                $user = $this->userModel->getUserById($fr["accepter"])->fetch(PDO::FETCH_ASSOC);

                $newArray[$key]["username"] = $user["username"];
            }

        }

        return $newArray;
    }

    function verifySend(){
        $user = $this->userModel->getUserByUserName($_POST["send"])->fetch(PDO::FETCH_ASSOC);
        if (empty($user)){
            //User does not exist
            return false;
        }

        $request = $this->friendsModel->getAllFriendsRequestsBoth($user["user_id"], "pending");
        if ($request->rowCount() > 0){
            //Request already exists
            return false;
        }

        $request1 = $this->friendsModel->getAllFriendsRequestsBoth($user["user_id"], "accepted");
        if ($request1->rowCount() > 0){
            //Request already exists
            return false;
        }

        return true;
    }

    function createFriendsRequest(){
        $user = $this->userModel->getUserByUserName($_POST["send"])->fetch(PDO::FETCH_ASSOC);

        $this->friendsModel->insertFriendRequest($_SESSION["userid"], $user["user_id"], "pending");
    }

    function acceptRequest(){
        $user = $this->userModel->getUserById($_POST["accept"])->fetch(PDO::FETCH_ASSOC);

        $this->friendsModel->updateRequestStatus($_SESSION["userid"], $user["user_id"], "accepted");
    }

    function deleteRequest(){
        $user = $this->userModel->getUserById($_POST["delete"])->fetch(PDO::FETCH_ASSOC);

        $this->friendsModel->deleteFriend($_SESSION["userid"], $user["user_id"]);
    }

    function validateFriend(){
        $user = $this->userModel->getUserByUserName($_GET["name"])->fetch(PDO::FETCH_ASSOC);

        $request = $this->friendsModel->getAllFriendsRequestsBoth($user["user_id"], "accepted");
        if ($request->rowCount() > 0){

            return true;
        }

        return false;
    }
}