<?php

include_once __DIR__ . '/../models/usersModel.php';



class UserControler {
    private $userModel;

    function __construct() {
        $this->userModel = new UsersModel();
    }

    function validateRegistration(){
        $errors = [];

        $username = trim(@$_POST['username']);
        if (empty($username) || strlen($username) < 4){
            $errors['username'] = 'Username must be at least 4 characters long';
        }

        $email=trim(@$_POST['email']);
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Enter valid email address';
        }else{

            $mailQuery = $this->userModel->getUserByEmail($email);

            if ($mailQuery->rowCount() != 0){
                $errors['email'] = 'This email address has already registered account with it';
            }
        }

        if (empty($_POST['password']) || (strlen($_POST['password']) < 8)){
            $errors['password'] = 'Password must be at least 8 characters';
        }
        if ($_POST['password'] != $_POST['passwordCheck']){
            $errors['passwordCheck'] = 'Passwords must match';
        }

        if($_POST['gender'] != 'male' && $_POST['gender'] != 'female'){
            $errors['gender'] = 'Gender must be male or female';
        }

        if($_POST['weight'] < 0 || $_POST['weight'] > 6){
            $errors['weight'] = 'Weight must be number between 1 and 6';
        }

        return $errors;
    }

    function registerUser() {
        $this->userModel->insertUser(
            $_POST["username"]
            , $_POST["email"]
            , password_hash($_POST["password"],PASSWORD_DEFAULT)
            , $_POST["gender"]
            , $_POST["weight"]
        );

        $_SESSION['userid'] = $this->userModel->getLastId();
        $_SESSION['username'] = $_POST["username"];
    }

    function loginUser(){
        $errorMsg = "The credentials combination is not valid";
        $user = $this->userModel->getUserByEmail($_POST["email"])->fetch(PDO::FETCH_ASSOC);

        if(!empty($user)) {
            if (password_verify($_POST['password'], $user['password'])){
                $_SESSION['userid'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
            }else{
                return $errorMsg;
            }

        } else {
            return $errorMsg;
        }
    }


    function logOutUser(){
        if(!empty($_SESSION['userid']) && !empty($_SESSION['username'])){
            unset($_SESSION['userid']);
            unset($_SESSION['username']);
        }
    }


    function validateUser(){
        if(!empty($_SESSION['userid'])){
            $userId = $this->userModel->getUserById($_SESSION['userid']);

            if ($userId->rowCount() != 1){
                unset($_SESSION['userid']);
                unset($_SESSION['username']);

                header('Location: home');
                exit();
            }
        }
    }

    function validatePasswordChange(): array{
        $errors = [];

        $user = $this->userModel->getUserById($_SESSION["userid"])->fetch(PDO::FETCH_ASSOC);

        if(!empty($user)) {
            if (!password_verify($_POST['oldPassword'], $user['password'])){
                $errors["oldPassword"] = "Wrong password entered";
            }
        } else {
            $errors["fail"] = "Something is wrong";
        }

        if (empty($_POST['newPassword']) || (strlen($_POST['newPassword']) < 8)){
            $errors['newPassword'] = 'Password must be at least 8 characters';
        }
        if ($_POST['newPassword'] != $_POST['newPasswordCheck']){
            $errors['newPasswordCheck'] = 'Passwords must match';
        }

        return $errors;
    }

    function changePassword(){
        $this->userModel->updateUserPassword($_SESSION["userid"], password_hash($_POST["newPassword"], PASSWORD_DEFAULT));
    }
}
