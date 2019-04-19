<?php
include ('connection.php');
include('ethicalApp.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Ethical Approval System</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/regForm.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
</head>
<body>

<main class = "grid-container">

    <header>

        <section class = grid-70>
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = grid-30>
            <div class = "login">
                <form id = "loginForm" action = "login.php" method = "post">
                    <?php

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

    <section class = grid-100>

        <div id = "regForm">
            <form method="post" action="newEthicalApp.php" id = "regF" enctype="multipart/form-data">
                <?php include('errors.php'); ?>
                <div id = "title">
                    <p>New Application for Registration</p>
                </div>
                <div class="input">
                    <label>Student ID</label>
                    <input type="text" name="stuID">
                </div>
                <div class="input">
                    <label>RGU Email</label>
                    <input type="email" name="email">
                </div>
                <div class="input">
                    <label>First name</label>
                    <input type="text" name="fname">
                </div>
                <div class="input">
                    <label>Surname</label>
                    <input type="text" name="lname">
                </div>
                <div class="input">
                    <label>Project Title</label>
                    <input type="text" name="title">
                </div>
                <div class="input">
                    <label>Brief Description</label>
                    <textarea type="text" name="desc" placeholder="This should be no more than 250 words"></textarea>
                </div>
                <div class="input">
                    <label>Funding Body</label>
                    <input type="text" name="funding">
                </div>
                <div class="input">
                    <label>Project Outline & Proposed Research methods</label>
                    <input type="file" name="file1">
                </div>
                <div class="input">
                    <label>Consent Forms</label>
                    <input type="file" name="file2">
                </div>
                <div class="input">
                    <label>Additional Documentation</label>
                    <input type="file" name="file3">
                </div>
                <div class="input">
                    <label>Password</label>
                    <input type="password" name="pass1">
                </div>
                <div class="input">
                    <label>Confirm password</label>
                    <input type="password" name="pass2">
                </div>
                <div class="input">
                    <button type="submit" class="fakeButton" name="register">Submit Application for Ethical Approval</button>
                </div>
            </form>
        </div>
    </section>