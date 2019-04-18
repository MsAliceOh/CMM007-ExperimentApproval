<?php

session_start();
include 'connection.php';

$username = "";
$email    = "";
$errors = array();

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['user'] = $username ;
            $_SESSION['success'] = "You are now logged in";

            $userType = "SELECT userTypeID from login WHERE username = '$username'";
            $res = mysqli_query($db, $userType);
            $rows = mysqli_fetch_assoc($res);


            if ($rows ['userTypeID'] == "1") {
                header ('location: studentHome.php');
            }
            else if ($rows ['userTypeID'] == "2") {
                header ('location: adminHomepage.php');
            }
            else if ($rows ['userTypeID'] == "3") {
                header ('location: EAOHomepage.php');
            }

        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}