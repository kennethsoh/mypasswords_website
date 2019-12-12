<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: profile.php");
    } else {
        $_SESSION['signup_csrf_token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        session_regenerate_id();
    }
?>
<html lang="en">
    <head>
        <title>SignUp - MyPasswords</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
	<?php include 'navbar/navbar.html';?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h4 style="margin:10 auto;display:block; text-align:center;color:black;" >Sign Up</h4>
        <center>
	    <div class="loginUserForm">
        <br>
        <form method="POST" action="actionSignup.php">
        <input class="credentialsInput" id="signupName" name="signupName" type="text" name="" placeholder="Your Name" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus/><br><br>
        <input class="credentialsInput" id="signupEmail" name="signupEmail" type="text" name="" placeholder="Email Address" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes"/><br><br>
        <input class="credentialsInput" id="signupPwd" name="signupPwd" type="password" name="" placeholder="Master Password" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Use at least 8 characters, including 1 number, 1 uppercase and 1 lowercase character')" oninput="setCustomValidity('')"/><br><br>
        <input type="hidden" name="signup_csrf_token" value="<?=$_SESSION['signup_csrf_token']?>"/>
        <h6 id="emailinvalidmsg" <?php if($_SESSION['emailfail'] === '1'){echo 'style="visibility:visible; margin-top: 0px; font-size:10px; color: red"';}else{echo 'style="visibility:hidden; margin-top: 0px; font-size:10px; color: red"';}?> >Your Email Address is Invalid </h6>
        <button style="margin-top: 2px;" class="loginButton" id="signupButton" name="signupButton" type="submit" >Sign Up</button>
        <h6 style="margin-top: 2px; font-size:10px">Already have an Account? <a style="font-size:10px" href="signin.php">Sign In here</a></h6><br>
        </div>
        </form>
	    </center>
    </body>
</html>
