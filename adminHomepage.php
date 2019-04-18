<?php
session_start();
include ('connection.php');
include ('refer.php');

if ( !isset( $_SESSION['user'])) {
    header('location: mainpage.php');
    exit();
}else{

    $username = $_SESSION['user'];
    $userType = "SELECT userTypeID from login WHERE username = '$username'";
    $res = mysqli_query($db, $userType);
    $rows = mysqli_fetch_assoc($res);

    if ($rows ['userTypeID'] != "2") {
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
    <link rel="stylesheet" href="Style/mainpageStyle.css">
    <link rel="stylesheet" href="Style/adminStyle.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
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

    <section class = grid-33>
        <div id = "adminMenu">

            <form class = "buttonForm" action = "newAdminReg.php">
                <button type = "submit" class = "fakeButton">Register a New Administrator</button>
            </form>
            <form class = "buttonForm" action = "newEAOReg.php">
                <button type = "submit" class = "fakeButton">Register a New Experiment Approval Officer</button>
            </form>
            <form class = "buttonForm" action = "viewAllApps.php">
                <button type = "submit" class = "fakeButton">View All Applications</button>
            </form>

        </div>

    </section>

    <section class = grid-67>

        <div id = "apps">



            <?php
            $query = "SELECT * from application WHERE referred = 0";
            $result = mysqli_query($db, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $app = $row['appID'];
                    $title = $row['title'];
                    $description = $row['description'];
                ?>
                    <div>
            <form method = "post" action = "adminHomepage.php" class = "refer">
                <?php include('errors.php'); ?>
                <label>Application ID: </label>
                <input type="text" name="appID" id = "appID" value="<?php echo $app ?>" readonly><br>
                <label>Title: <?php echo $title ?> <br></label>
                <label>Description: <?php echo $description ?> <br></label>
                <label>Reviewer 1:</label>
                <select name = 'EAO1'> <br>
                    <?php
                    $getEAO= "SELECT * FROM eao";
                    $EAORes = mysqli_query($db,$getEAO);
                    while ($rows = $EAORes-> fetch_assoc()) {
                    $staffID = $rows['staffID'];
                    $fname = $rows['fname'];
                    $lname = $rows ['lname'];
                    echo "<option value = '$staffID'>$fname $lname</option>";
                    }
                    ?>
                </select><br>
                <label>Reviewer 2:</label>
                <select name = 'EAO2'> <br>
                    <?php
                    $getEAO= "SELECT * FROM eao";
                    $EAORes = mysqli_query($db,$getEAO);
                    while ($rows = $EAORes-> fetch_assoc()) {
                        $staffID = $rows['staffID'];
                        $fname = $rows['fname'];
                        $lname = $rows ['lname'];
                        echo "<option value = '$staffID'>$fname $lname</option>";
                    }
                    ?>
                </select><br>
                <button type = "submit" name = "refer">Refer</button>
            </form>
                    </div>
                <?php
            }
            ?>

        </div>

    </section>

</main>

</body>
</html>