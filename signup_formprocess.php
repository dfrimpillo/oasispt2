<?php

    if (isset($_POST["submit"])){

        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["passwordRepeat"];

        require_once 'dbconnection.php';
        require_once 'functions.php';
        
        if (emptyInputSignup($firstName, $lastName, $username, $email, $password, $passwordRepeat) !== false){
            header("location: signup.php?error=emptyinput");
            exit();
        } 
        if (invalidUsername($username) !== false){
            header("location: signup.php?error=invalidusername");
            exit();
        } 
        if (invalidEmail($email) !== false){
            header("location: signup.php?error=invalidemail");
            exit();
        } 
        if (passwordMatch($password, $passwordRepeat) !== false){
            header("location: signup.php?error=passwordsdontmatch");
            exit();
        }
        if (usernameExists($conn, $username, $email) !== false){
            header("location: signup.php?error=usernametaken");
            exit();
    } 

    createUser($conn,$firstName, $lastName, $username, $email, $password, $passwordRepeat);
    else {
        header("location: signup.php");
        exit();
    }