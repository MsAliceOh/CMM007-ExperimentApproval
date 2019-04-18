<?php

include ('login.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Ethical Approval System</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/mainpageStyle.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="Style/regForm.css">
    <link rel="stylesheet" href="Style/student.css">

</head>
<body>

<main class = "grid-container">

    <header>

        <section class = grid-70>
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = grid-30>
            <div class = "login">
                <form id = "loginForm" action = "secondarySignIn.php" method = "post">
                    <?php
                    include('errors.php');
                    ?>
                    <table id = "loginT">
                        <tr>
                            <td>Username</td>
                            <td>Password</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="username" placeholder="username" required></td>
                            <td><input type="password" name="password" placeholder="password" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="login" value="login"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
    </header>

<form id = "loginF" method = "post" action = "secondarySignIn.php">
    <?php include('errors.php'); ?>
    <h2>Sign-In</h2>
    <div class = "input">
    <label>StudentID</label>
    <input type="text" name="username" placeholder="Student ID">
    <label>Password</label>
    <input type="password" name="password" placeholder="password">
    </div>
    <div class = "input">
    <input type="submit" name="login" value="login" class = "fakeButton">
    </div>
    <div class = "input">
        <p>If you don't have an account, sign up <a href = "../../../../xampp/htdocs/CMM007-ExperimentApproval/ethicalApp.html">here</a> or contact an administrator</p>
    </div>
</form>
    </div>
    </section>

</main>
</body>
</html>