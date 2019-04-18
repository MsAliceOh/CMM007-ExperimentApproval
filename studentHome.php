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

            <h2>Reviewer Decision</h2>
            <?php
            $query2 = "SELECT * FROM applicationdec D, application A WHERE D.appID = A.appID AND A.stID = '$username'";
            $result2 = mysqli_query($db, $query2);
            if (mysqli_num_rows($result2) == 0) {
                echo
                "<div id = ".'OS'.">
                        <p>Application Decision Outstanding</p>";            }
            else {
            while ($row = mysqli_fetch_assoc($result2)) {
                $rev1 = $row['review1Dec'];
                $rev2 = $row['review2Dec'];
                $com1 = $row['review1Com'];
                $com2 = $row['review2Com'];
                $dec = $row['finalDec'];

                if ($rev1 == 1) {
                    $rev1D = "Accept";
                }
                if ($rev1 == 0) {
                    $rev1D = "Decline";
                }
                if ($rev2 == 1) {
                    $rev2D = "Accept";
                }
                if ($rev2 == 0) {
                    $rev2D = "Decline";
                }

                if ($rev1 == 0 AND $rev2 == 0) {
                    ?>
                    <div id = "dec">
                        <p>Application Approval Rejected</p>
                    </div>
            <?php
                }
                if ($rev1 == 1 AND $rev2 == 0) {
                    ?>
                    <div id = "dec">
                        <p>Application Approval Rejected</p>
                    </div>
                    <?php
                }
                if ($rev1 == 0 AND $rev2 == 1) {
                    ?>
                    <div id = "dec">
                        <p>Application Approval Rejected</p>
                    </div>
                    <?php
                }
                if ($rev1 == 1 AND $rev2 == 1) {
                 ?>
                    <div id = "acc">
                        <p>Application Approval Accepted</p>
                    </div>
            <?php
                }
                else if ($rev1 == NULL || $rev2 == NULL) {
                 ?>
                    <div id = "OS">
                        <p>Application Decision Outstanding</p>
                    </div>
            <?php
                    }
                ?>
            <div id = "com">
                <h2>Reviewer 1 Comments</h2>
                    Reviewer 1 Decision: <?php echo $rev1D?><br>
                    Comments: <?php echo $com1?><br><br>
                <h2>Reviewer 2 Comments</h2>
                    Reviewer 2 Decision: <?php echo $rev2D?><br>
                    Comments: <?php echo $com2?><br><br>
            </div>
            <?php }}?>


        </div>

    </section>
</main>

</main>
</body>
</html>
