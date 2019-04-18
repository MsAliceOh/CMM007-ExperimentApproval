<?php
session_start();
include ('connection.php');

if ( !isset( $_SESSION['user'])) {
    header('location: mainpage.php');
    exit();
}else{

    $username = $_SESSION['user'];
    $userType = "SELECT userTypeID from login WHERE username = '$username'";
    $res = mysqli_query($db, $userType);
    $rows = mysqli_fetch_assoc($res);

    if ($rows ['userTypeID'] != "1") {
        header ('location: mainpage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Application</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="Style/student.css">
</head>
<body>

<main class = grid-container>

    <header>
        <section class = grid-70>
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = grid-30>

            <div id = "logout">
                <p>You are signed in as <?php echo $username?></p>
                <a href = "signout.php">sign out</a>
            </div>
        </section>
    </header>

</main>

<main class = grid-container>

    <section class = grid-70>
        <div class = "application">

            <div>
            <a href = "editApp.php">Edit Application</a>
            </div>

            <h1>Your Application</h1>

            <?php
            $query = "SELECT * from application WHERE stID = '$username'";
            $result  = mysqli_query ($db, $query);
            while ($row = $result -> fetch_assoc()) {
                $appID = $row['appID'];
                $title = $row['title'];
                $description = $row['description'];
                $funding = $row['funding'];
                $outline = $row['outline'];
                $consent = $row['consent'];
                $add = $row['additionalDocs'];
                ?>

                <h3>Title</h3>
                <?php
                echo $title;
                ?>
                <h3>Description</h3>
                <?php
                echo $description;
                ?>
                <h3>Funding</h3>
                <?php
                echo $funding;
                ?>
                <h3>Project Outline Document</h3>
                <?php
                echo $outline;
                ?>
                <br>
                <?php
                $file1 = $outline;
                echo "<a href='download.php?name=" . $file1 . "'>download</a> ";
                ?>
                <h3>Consent Forms</h3>
                <?php
                echo $consent;
                ?>
                <br>
                <?php
                $file2 = $consent;
                echo "<a href='download.php?name=" . $file2 . "'>download</a> ";
                ?>
                <h3>Additonal Documents</h3>
                <?php
                echo $add;
                ?>
                <br>
                <?php
                $file3 = $add;
                echo "<a href='download.php?name=" . $file3 . "'>download</a> ";
            }?>
        </div>

    </section>

    <section class = grid-30>

        <div class = "status">

            <h1>Reviewer Decision</h1>

            <?php

            $query2 = "SELECT referred FROM application WHERE stID = '$username'";
            $result2 = mysqli_query($db, $query2);
            while ($row = $result2 -> fetch_assoc()) {
                $refer = $row['referred'];
                }
            if ($refer == 0) {
                echo "<div id = ".'OS'.">
            <p>Application Decision Outstanding</p>
            </div>";
            }

            else {

                $query3 = "SELECT * FROM application, applicationdec WHERE application.stID = '$username' AND application.appID = applicationdec.appID";
                $result3 = mysqli_query($db, $query3);
                while ($row = $result3 -> fetch_assoc()) {
                    $r1 = $row['review1Dec'];
                    $r2 = $row['review2Dec'];
                    $r1c = $row['review1Com'];
                    $r2c = $row['review2Com'];
                }

                if(is_null($r1)) {
                    echo "<div id = ".'OS'.">
            <p>Application Decision Outstanding</p>
            </div>";
                }
                else if(is_null($r2)) {
                    echo "<div id = ".'OS'.">
            <p>Application Decision Outstanding</p>
            </div>";
                }
                else if($r1 === 0 and $r2 === 0) {
                    echo "<div id = ".'acc'.">
            <p>Application Approval Accepted</p>
        </div>";
                }
                else if($r1 === 1 and $r2 === 0) {
                    echo "<div id = ".'dec'.">
            <p>Application Approval Rejected</p>
        </div>";
                }
                else if($r1 === 0 and $r2 === 1) {
                    echo "<div id = ".'dec'.">
            <p>Application Approval Rejected</p>
        </div>";
                }
            }

            ?>

        </div>

    </section>
</main>

</main>
</body>
</html>
