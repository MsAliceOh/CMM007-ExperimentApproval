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

    if ($rows ['userTypeID'] != "3") {
        header ('location: mainpage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ethical Approval Officer Homepage</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
    <link rel = "stylesheet" href = "Style/EAO.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

</head>
<body>

<main class = grid-container>
    <header>
    <section class = "grid-100">

        <section class = grid-70>
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = grid-30>

            <div id = "logout">
                <p>You are signed in as <?php echo $username?></p>
                <a href = "signout.php">sign out</a>
            </div>
        </section>
    </section>
    </header>

<section class = "grid-100">

            <div id = "apps">
                <h1>Applications to Review</h1>
                <table id = "app" class = "table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>Application ID</td>
                        <td>Title</td>
                        <td>View Application</td>
                    </tr>
                    </thead>
                    <?php
                    $query = "SELECT * from applicationreferal WHERE (Reviewer1 = '$username' AND complete1 = 0) OR (Reviewer2 = '$username' AND complete2 = 0)";
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $appID = $row['appID'];
                        $query2 = "SELECT * from application WHERE appID = '$appID'";
                        $result2 = mysqli_query($db, $query2);
                        while ($rows = mysqli_fetch_assoc($result2)){
                            echo "
                    <tr>
                    <td>" . $rows["appID"] . "</td>
                    <td>" . $rows["title"] . "</td>
                    <td><form method = ".'post'." action = ".'viewApp.php'." class = ".'buttonForm'."> 
                    <button type = ".'submit'." class= ".'but'." name = ".'view'." value = " . $rows["appID"] . ">View Application</button>
                    </form></td>
                    </tr>
                    ";

                        }
                    }
                    ?>

                </table>
            </div>
    </section>
    </main>
</body>
</html>

<script>
    $(document).ready(function(){
        $('#app').DataTable();
    });
</script>
