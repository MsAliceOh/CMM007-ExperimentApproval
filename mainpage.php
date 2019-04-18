<?php
include ('login.php');
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
</head>
<body>

<main class = "grid-container">

        <header>

        <section class = grid-70>
    <img id = rguLogo src="Images/Robert_Gordon_University_logo.svg.png" alt = "RGU Header">
        </section>

    <section class = grid-30>
        <div class = "login">
        <form id = "loginForm" action = "mainpage.php" method = "post">
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


    <section class = grid-50>

            <h1> Welcome to the Ethical Approval Application System</h1>

            <p>
                Ethical approval is required for any research conducted within the university.<br>
                <br>
                There are five main principles of research ethics by which each student must take into account when
                performing research within the university. In order for any experiment to be approved a student must
                demonstrate that each of these have been considered and that reasonable steps have been taken to ensure
                that these are adhered to.
                <h3>Do no Harm</h3>
                Your research should not harm participants in any way. If there is a possibility of minor discomfort,
            there must be well reasoned and strongly grounded justification.
                <h3>Informed Consent</h3>
                All participants must give informed consent to the study. They need to know that there are taking part
            in research and the purposes of the research.
                <h3>Anonymity and Confidentiality</h3>
                Data needs to be treated confidentially and all participants must be protected. The identity of
            idivudals should not be disclosed and their should be a variety of measures in place to ensure this.
                <h3>Avoiding Deception</h3>
                For some studies, a measure of deception is necessary and can be justified provided it is not possible
            to let all participants know what is taking place or if it is likely that observation would alter the
            behaviour one is hoping to observed. If covert research is to be justified it must be well reasoned and
            strongly grounded justification.
                <h3>Right to Withdraw</h3>
                Each participant has a right to withdraw from the study at any stage of the research
            process. They must be informed of this right and cannot be pressured or coerced to remain.
        </p>

        </section>

        <section class = grid-50>

            <form class = "buttonForm" action = "newEthicalApp.php">
            <button type = "submit" class = "fakeButton" id = "firstBut">Submit a New Application for Ethical Approval</button>
            </form>

            <div id = "picHolder">
                <img id = science  alt = "Experiment Example" src="Images/science.jpg" />
            </div>

            <form class = "buttonForm"  action = "secondarySignIn.php">
                <button type = "submit" class = "fakeButton">Check on the Status of a Submitted Application</button>
            </form>

        </section>

    <section class = grid-100>

    <footer>
        <div id = footer>
            <p>Alice Cox-Owen: 1808957 - CMM007 System for Ethical Approval</p>
        </div>
    </footer>

    </section>

</main>
</body>
</html>