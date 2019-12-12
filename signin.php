<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: profile.php");
    } else {
        ;
    }
?>

<html lang="en">
    <head>
        <title>SignIn - MyPasswords</title>
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
        <h4 style="margin:10 auto;display:block; text-align:center;color:black;" >Sign In</h4>
        <center>
	    <div class="loginUserForm">
        <br>
            <form method="POST" action="actionSignin.php">
            <input style="margin-top: 20px;" class="credentialsInput" id="signinEmail" type="text" name="signinEmail" placeholder="Email Address" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus/><br><br>
            <input class="credentialsInput" id="signinPwd" type="password" name="signinPwd" placeholder="Master Password" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" /><br><br>
            <h6 id="loginerrmsg" <?php if($_SESSION['loginfail'] === '1'){echo 'style="visibility:visible; margin-top: 20px; font-size:10px; color: red"';}else{echo 'style="visibility:hidden; margin-top: 20px; font-size:10px; color: red"';}?> >Your Email Address or Password is Invalid </h6>
            <button style="margin-top: 2px;"class="loginButton" id="signinButton" type="submit" name="signinButton" >Login</button>
            <h6 style="margin-top: 2px; font-size:10px">Don't have an Account? <a style="font-size:10px" href="signup.php">Sign Up here</a></h6>
            <a <?php if($_SESSION['loginfail'] === '1'){echo 'style="visibility:visible; margin-top: 1px; font-size:10px;"';}else{echo 'style="visibility:hidden; margin-top: 1px; font-size:10px;"';}?>  href="forgetpwd.php">Forgot Your Password?</a><br>
            </form>    
        </div>
	    </center>
    </body>
</html>


