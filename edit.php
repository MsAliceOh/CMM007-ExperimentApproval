<?php

include ('connection.php');

if (isset($_POST['update'])) {

    $appID = mysqli_real_escape_string($db, $_POST['appID']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $desc = mysqli_real_escape_string($db, $_POST['desc']);
    $fund = mysqli_real_escape_string($db, $_POST['funding']);

    /*$targetDir = "C:/xampp/htdocs/CMM007-ExperimentApproval/docUpload/";
    */
    $targetDir = "C:/inetpub/wwwroot/1808957/CMM007-ExperimentApproval/docUpload/";
    $fileName1 = basename($_FILES["file1"]["name"]);
    $targetFilePath1 = $targetDir . $fileName1;
    $fileName2 = basename($_FILES["file2"]["name"]);
    $targetFilePath2 = $targetDir . $fileName2;
    $fileName3 = basename($_FILES["file3"]["name"]);
    $targetFilePath3 = $targetDir . $fileName3;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $query = "UPDATE application set title = '$title', description = '$desc', funding = '$fund' WHERE appID = '$appID' ";
    mysqli_query($db, $query);

    if (empty($fileName1) == FALSE) {
        $query2 = "UPDATE application SET outline = '$fileName1' WHERE appID = '$appID'";
        mysqli_query($db,$query2);
        move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFilePath1);
    }

    if (empty($fileName2) == FALSE) {
        $query3 = "UPDATE application SET consent = '$fileName2'WHERE appID = '$appID'";
        mysqli_query($db,$query3);
        move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFilePath2);
    }

    if (empty($fileName3) == FALSE) {
        $query4 = "UPDATE application SET additionalDocs = '$fileName3'WHERE appID = '$appID'";
        mysqli_query($db,$query4);
        move_uploaded_file($_FILES["file3"]["tmp_name"], $targetFilePath3);
    }

    header ('location: studentHome.php');
}