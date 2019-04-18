<?php

include ('connection.php');
session_start();

if ( !isset( $_SESSION['user'])) {
    header('location: mainpage.php');
    exit();
}else{

    $username = $_SESSION['user'];
    $userType = "SELECT userTypeID from login WHERE username = '$username'";
    $res = mysqli_query($db, $userType);
    $rows = mysqli_fetch_assoc($res);

    if ($rows ['userTypeID'] != "3") {
        header ('location: mainpage.php');
    }
}

if (isset($_POST['view'])) {

    $appID = $_POST["view"];

    $query = "SELECT * from application WHERE appID = '$appID'";
    $result = $db->query($query);
    while ($row = $result->fetch_assoc()) {
        $appID = $row['appID'];
        $title = $row['title'];
        $description = $row['description'];
        $funding = $row['funding'];
        $outline = $row['outline'];
        $consent = $row['consent'];
        $add = $row['additionalDocs'];
    }
}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Application</title>
    <link rel = "stylesheet" href = "Style/unsemantic-grid-responsive-tablet.css">
    <link rel = "stylesheet" href = "Style/primaryColour.css">
    <link rel = "stylesheet" href = "Style/style.css">
    <link rel = "stylesheet" href = "Style/regForm.css">
    <link rel = "stylesheet" href = "Style/EAO.css">
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
    <div class = "home">
        <a href = EAOHomepage.php>Return to Home</a>
    </div>

    <section class = grid-60>

<div id = "appli">
    <h3>Application ID</h3>
    <?php echo  $appID; ?>
    <h3>Title</h3>
<?php echo  $title; ?>
    <h3>Description</h3>
<?php echo  $description; ?>
    <h3>Funding</h3>
<?php echo  $funding; ?>
    <h3>Project Outline Document</h3>
<?php echo $outline; ?><br>
<?php $file1 = $outline;
echo "<a href='download.php?name=".$file1."'>download</a> "; ?>
    <h3>Consent Forms</h3>
<?php echo $consent; ?><br>
<?php $file2 = $consent;
echo "<a href='download.php?name=".$file2."'>download</a> "; ?>
    <h3>Additonal Documents</h3>
<?php echo $add; ?> <br>
<?php $file3 = $add; echo "<a href='download.php?name=".$file3."'>download</a> "; ?>
</div>
    </section>

    <section class = "grid-40">
        <div id = "reviewF">
        <form method = "post" action = "review.php" id = "review" onsubmit="return confirm('Are you sure?')">
            <h1>Comments and Response</h1>
            <label>Application ID: </label>
            <input type="text" name="appID" id = "appID" value="<?php echo $appID ?>" readonly><br>
            <div class="input">
                <label>Comments</label>
                <textarea name="comment" placeholder = "Please state your decision and discuss the reasons for this."></textarea>
            </div>
            <div id = "ass">
                <button type = "submit" class = "Abutton" action = "decision.php" name = "accept">Accept</button>
            </div>
            <div id = "dec">
                <button type = "submit" class = "Dbutton" action = "decision.php" name = "decline">Decline</button>
            </div>

        </form>
        </div>

    </section>

</main>
</body>
</html>