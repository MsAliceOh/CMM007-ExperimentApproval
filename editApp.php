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
    <title>Administrator Homepage</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="Style/student.css">
    <link rel="stylesheet" href="Style/regForm.css">
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

    <section class = "grid-100">
        <div class = "home">
            <a href = studentHome.php>Back to Application - Do not store changes</a>
        </div>

        <?php
        $query = "SELECT * from application WHERE stID = '$username'";
        $result  = $db->query($query);
        while ($row = $result -> fetch_assoc()){
            $appID = $row['appID'];
            $title = $row['title'];
            $description = $row['description'];
            $funding = $row['funding'];
            $outline = $row['outline'];
            $consent = $row['consent'];
            $add = $row['additionalDocs'];
        ?>

        <form method = "post" action = "edit.php" enctype="multipart/form-data">
            <div class="input">
                <label>AppID</label>
                <input type="text" name="appID" value = <?php echo $appID?> readonly>
            </div>
            <div class="input">
                <label>Project Title</label>
                <input type="text" name="title" value = <?php echo $title?>>
            </div>
            <div class="input">
                <label>Brief Description</label>
                <textarea type="text" name="desc"><?php echo $description?></textarea>
            </div>
            <div class="input">
                <label>Funding Body</label>
                <input type="text" name="funding" value = <?php echo $funding ?>>
            </div>
            <div class="input">
                <?php $file1 = $outline;
                echo $file1;
                echo "<a href='download.php?name=".$file1."'>download</a> ";?>
                <label>Project Outline & Proposed Research methods</label>
                <input type="file" name="file1" id = "file1">
            </div>
            <div class="input">
                <?php $file2 = $consent;
                echo $file2;
                echo "<a href='download.php?name=".$file2."'>download</a> ";?>
                <label>Consent Forms</label>
                <input type="file" name="file2" id="file2">
            </div>
            <div class="input">
                <?php $file3 = $add;
                echo $file3;
                echo "<a href='download.php?name=".$file3."'>download</a> ";?>
                <label>Additional Documentation</label>
                <input type="file" name="file3" id="file3">
            </div>
            <div class="input">
                <button type="submit" class="fakeButton" name="update">Update Application</button>
            </div>

        </form>

        <?php } ?>
    </section>

</main>
</body>
</html>
