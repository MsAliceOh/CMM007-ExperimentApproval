<?php

include ('connection.php');
$user = $_SESSION['user'];

$errors = array();

if (isset($_POST['refer'])) {

    $app = mysqli_real_escape_string($db, $_POST['appID']);
    $EAO1 = mysqli_real_escape_string($db, $_POST['EAO1']);
    $EAO2 = mysqli_real_escape_string($db, $_POST['EAO2']);

    if ($EAO1 == $EAO2) {
        array_push($errors, "You cannot choose the same EAO twice");
    }

    else {

        $query = "INSERT INTO applicationreferal (appID, Reviewer1, Reviewer2) VALUES ('$app', '$EAO1','$EAO2')";
        mysqli_query($db, $query);
        $query2 = "UPDATE application SET referred = 1 WHERE appID = '$app'";
        mysqli_query($db, $query2);
        $query3 = "INSERT INTO applicationdec (appID) VALUES ('$app')";
        header ('adminHomepage.php');

    }
}