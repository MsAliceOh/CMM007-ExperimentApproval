<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();


include ('connection.php');

// REGISTER USER
if (isset($_POST['register'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($fname)) { array_push($errors, "Firstname is required"); }
    if (empty($lname)) { array_push($errors, "Surname is required"); }
    if (empty($pass1)) { array_push($errors, "Password is required"); }
    if ($pass1 != $pass2) {
        array_push($errors, "The two passwords do not match");
    }

    $userCheck = "SELECT * from login WHERE username = '$username'OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $userCheck);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($pass1);

        $query = "INSERT INTO login (username, email, password, userTypeID) VALUES ('$username','$email','$password','3')";

        mysqli_query($db, $query);

        $query2 = "INSERT INTO eao (staffID, fname, lname) 
VALUES ('$username', '$fname', '$lname')";

        mysqli_query($db, $query2);

        "<div class='success'>";
        echo "Registration Successful";
        "</div>";

        $username = "";
        $email = "";

    }
}