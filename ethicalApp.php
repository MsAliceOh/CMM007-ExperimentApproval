<?php

session_start();
include ('connection.php');

$errors = array();

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($db, $_POST['stuID']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $desc = mysqli_real_escape_string($db, $_POST['desc']);
    $fund = mysqli_real_escape_string($db, $_POST['funding']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);


    /*$targetDir = "C:/xampp/htdocs/CMM007-ExperimentApproval/docUpload/";*/

    $targetDir = "C:/inetpub/wwwroot/1808957/CMM007-ExperimentApproval/docUpload/";
    $fileName1 = basename($_FILES["file1"]["name"]);
    $targetFilePath1 = $targetDir . $fileName1;
    $fileName2 = basename($_FILES["file2"]["name"]);
    $targetFilePath2 = $targetDir . $fileName2;
    $fileName3 = basename($_FILES["file3"]["name"]);
    $targetFilePath3 = $targetDir . $fileName3;

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($fname)) { array_push($errors, "Firstname is required"); }
    if (empty($lname)) { array_push($errors, "Surname is required"); }
    if (empty($pass1)) { array_push($errors, "Password is required"); }
    if (empty($title)) { array_push($errors, "Title is required"); }
    if (empty($desc)) { array_push($errors, "Description is required"); }
    if (empty($title)) { array_push($errors, "You must enter a funding body. If it is not externally funded, 
    please state RGU in this section"); }

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
        
        $_SESSION['user'] = $username ;
        $password = md5($pass1);

        $query = "INSERT INTO login (username, email, password, userTypeID) VALUES ('$username','$email','$password','1')";

        mysqli_query($db, $query);

        $query2 = "INSERT INTO student (stID, fname, lname) VALUES ('$username','$fname','$lname')";

        mysqli_query($db, $query2);

        move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFilePath1);
        move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFilePath2);
        move_uploaded_file($_FILES["file3"]["tmp_name"], $targetFilePath3);

        $query3 = "INSERT INTO application (stID, title, description, funding, outline, consent, additionalDocs, referred)
VALUES ('$username','$title', '$desc', '$fund','$fileName1','$fileName2','$fileName3', 0)";

        mysqli_query($db, $query3);

        header ('location: studentHome.php');

    }

}