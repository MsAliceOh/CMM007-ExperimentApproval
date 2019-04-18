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
    <title>View All Applications</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/mainpageStyle.css">
    <link rel="stylesheet" href="Style/adminStyle.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
</head>
<body>

<main class = grid-container>

    <header>

        <section class = "grid-100">

        <section class = "grid-70">
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = "grid-30">

            <div id = "logout">
                <p>You are signed in as <?php echo $username?></p>
                <a href = "signout.php">sign out</a>
            </div>

        </section>
        </section>
    </header>

    <section class = "grid-100">
        <div class = "home">
            <a href = adminHomepage.php>Return to Home</a>
        </div>

        <table id="allApps" class = "table table-striped table-bordered">
            <thead>
            <h2>All Applications</h2>
            <tr>
                <td>StudentID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>ApplicationID</td>
                <td>Referred (0 = no, 1 = yes)</td>
            </tr>
            </thead>
            <?php
            $query = "SELECT S.stID, S.fname, S.lname, A.appID, A.stID, A.title, A.referred
                FROM student S, application A
                WHERE S.stID = A.stID";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['stID'] ?></td>
                    <td><?php echo $row['fname'] ?></td>
                    <td><?php echo $row['lname'] ?></td>
                    <td><?php echo $row['appID'] ?></td>
                    <td><?php echo $row['referred'] ?></td>
                </tr>
                <?php
            }?>

        </table>


        <table id="ref" class = "table table-striped table-bordered">
            <thead>
            <h2>Referred Applications</h2>
            <tr>
                <td>StudentID</td>
                <td>ApplicationID</td>
                <td>Reviewer 1</td>
                <td>Reviewer 1 Decision</td>
                <td>Reviewer 1 Comments</td>
                <td>Reviewer 2</td>
                <td>Reviewer 2 Decision</td>
                <td>Reviewer 2 Comments</td>
            </tr>
            </thead>
                <?php
                $query = "SELECT S.stID, A.appID, A.stID, A.title, R.appID, R.Reviewer1, R.Reviewer2, D.appID, D.review1Dec, D.review1Com, D.review2Dec, D.review2Com
                FROM student S, application A, applicationreferal R, applicationdec D
                WHERE S.stID = A.stID AND A.appID = R.appID AND R.appID = D.appID";
                $result = mysqli_query($db, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
            <tr>
                <td><?php echo $row['stID'] ?></td>
                <td><?php echo $row['appID'] ?></td>
                <td><?php echo $row['Reviewer1'] ?></td>
                <td><?php echo $row['review1Dec'] ?></td>
                <td><?php echo $row['review1Com'] ?></td>
                <td><?php echo $row['Reviewer2'] ?></td>
                <td><?php echo $row['review1Dec'] ?></td>
                <td><?php echo $row['review1Com'] ?></td>
            </tr>
                <?php
                }?>

        </table>

    </section>

</main>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#allApps').DataTable();
    });
</script>
<script>
    $(document).ready(function(){
        $('#ref').DataTable();
    });
</script>