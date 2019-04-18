<?php
include ('connection.php');
include('EAOReg.php');

$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>New Experiment Approval Officer Registration</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/regForm.css">
    <link rel="stylesheet" href="Style/primaryColour.css">
    <link rel="stylesheet" href="Style/unsemantic-grid-responsive-tablet.css">
</head>

<body>

<main class = "grid-container">

    <header>

        <section class = grid-70>
            <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

        <section class = grid-30>

            <div id = "logout">
                <p>You are signed in as <?php echo $user?></p>
                <a href = "logout.php">log out</a>
            </div>

        </section>

    </header>

    <section class = grid-100>
        <div class = "home">
            <a href = adminHomepage.php>Return to Home</a>
        </div>

<div id = "regForm">
<form method="post" action="newEAOReg.php" id = "regF">
    <?php include('errors.php'); ?>
    <div id = "title">
    <p> Register New Experiment Approval Officer</p>
    </div>
    <div class="input">
        <label>Staff ID</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input">
        <label>Staff Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
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
        <label>Password</label>
        <input type="password" name="pass1">
    </div>
    <div class="input">
        <label>Confirm password</label>
        <input type="password" name="pass2">
    </div>
    <div class="input">
        <button type="submit" class="fakeButton" name="register">Register new EAO</button>
    </div>
</form>
</div>
    </section>
</main>
</body>
</html>