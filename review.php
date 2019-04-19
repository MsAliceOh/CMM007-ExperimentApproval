<?php

session_start();
include ('connection.php');
$user = $_SESSION['user'];

if (isset($_POST['accept'])) {
    $reviewer = $_SESSION['user'];
    $appID = mysqli_real_escape_string($db, $_POST['appID']);
    $comments = mysqli_real_escape_string($db, $_POST['comment']);

    $query = "SELECT * FROM applicationreferal WHERE appID = '$appID'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) {
        $reviewer1 = $row['Reviewer1'];
        $reviewer2 = $row['Reviewer2'];

        if ($reviewer == $reviewer1) {
            $query2 = "UPDATE applicationdec SET review1Dec = 1, review1Com = '$comments' WHERE appID = '$appID'";
            mysqli_query($db, $query2);
            $comp = "UPDATE applicationreferal SET complete1 = 1 WHERE appID = '$appID'";
            mysqli_query($db, $comp);
            $query3 = "SELECT * FROM applicationdec WHERE appID = '$appID'";
            $result3 = mysqli_query($db, $query3);
                while ($row = mysqli_fetch_assoc($result3)) {
                    $review2Dec = $row['review2Dec'];

                    if (is_null($review2Dec)) {
                        header ('location: EAOHomepage.php');
                    }

                    if ($review2Dec == 1){
                        $query4 = "UPDATE applicationdec SET finalDec = 1 WHERE appID = '$appID'";
                        mysqli_query($db, $query4);
                        header ('location: EAOHomepage.php');
                    }
                    if ($review2Dec == 0) {
                        $query5 = "UPDATE applicationdec SET finalDec = 0 WHERE appID = '$appID'";
                        mysqli_query($db, $query5);
                        header ('location: EAOHomepage.php');
                    }
                }
        }
        if ($reviewer == $reviewer2) {
            $query6 = "UPDATE applicationdec SET review2Dec = 1, review2Com = '$comments' WHERE appID = '$appID'";
            mysqli_query($db, $query6);
            $comp2 = "UPDATE applicationreferal SET complete2 = 1 WHERE appID = '$appID'";
            mysqli_query($db, $comp2);
            $query7 = "SELECT * FROM applicationdec WHERE appID = '$appID'";
            $result7 = mysqli_query($db, $query7);
            while ($row = mysqli_fetch_assoc($result7)) {
                $review1Dec = $row['review1Dec'];

                if (is_null($review1Dec)) {
                    header ('location: EAOHomepage.php');
                }

                if ($review1Dec == 1){
                    $query8 = "UPDATE applicationdec SET finalDec = 1 WHERE appID = '$appID'";
                    mysqli_query($db, $query8);
                    header ('location: EAOHomepage.php');
                }
                if ($review1Dec == 0) {
                    $query9 = "UPDATE applicationdec SET finalDec = 0 WHERE appID = '$appID'";
                    mysqli_query($db, $query9);
                    header ('location: EAOHomepage.php');
                }
            }
        }
    }
}

if (isset($_POST['decline'])) {
    $reviewer = $_SESSION['user'];
    $appID = mysqli_real_escape_string($db, $_POST['appID']);
    $comments = mysqli_real_escape_string($db, $_POST['comment']);

    $query = "SELECT * FROM applicationreferal WHERE appID = '$appID'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) {
        $reviewer1 = $row['Reviewer1'];
        $reviewer2 = $row['Reviewer2'];

        if ($reviewer == $reviewer1) {
            $query2 = "UPDATE applicationdec SET review1Dec = 0, review1Com = '$comments' WHERE appID = '$appID'";
            mysqli_query($db, $query2);
            $comp = "UPDATE applicationreferal SET complete1 = 1 WHERE appID = '$appID'";
            mysqli_query($db, $comp);
            $query3 = "SELECT * FROM applicationdec WHERE appID = '$appID'";
            $result3 = mysqli_query($db, $query3);
            while ($row = mysqli_fetch_assoc($result3)) {
                $review2Dec = $row['review2Dec'];

                if (is_null($review2Dec)) {
                    header ('location: EAOHomepage.php');
                }

                else {
                    $query4 = "UPDATE applicationdec SET finalDec = 0 WHERE appID = '$appID'";
                    mysqli_query($db, $query4);
                    header ('location: EAOHomepage.php');
                }
            }
        }
        if ($reviewer == $reviewer2) {
            $query6 = "UPDATE applicationdec SET review2Dec = 0, review2Com = '$comments' WHERE appID = '$appID'";
            mysqli_query($db, $query6);
            $comp2 = "UPDATE applicationreferal SET complete2 = 1 WHERE appID = '$appID'";
            mysqli_query($db, $comp2);
            $query7 = "SELECT * FROM applicationdec WHERE appID = '$appID'";
            $result7 = mysqli_query($db, $query7);
            while ($row = mysqli_fetch_assoc($result7)) {
                $review1Dec = $row['review1Dec'];

                if (is_null($review1Dec)) {
                    header ('location: EAOHomepage.php');
                }

                else {
                    $query8 = "UPDATE applicationdec SET finalDec = 1 WHERE appID = '$appID'";
                    mysqli_query($db, $query8);
                    header ('location: EAOHomepage.php');
                }
            }
        }
    }
}