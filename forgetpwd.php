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
        <title>Forget Password - MyPasswords</title>
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
        <h3 style="margin:10 auto;display:block; text-align:center;color:black;" >Request for Password Reset</h3>
        <h6 style="margin:10 auto;display:block; text-align:center;color:black;" >Enter Your Name and Email Address</h6>
        <p style="margin:0 auto; text-align:center;color:black;" >A reset token will be sent to you.</p>
        <center>
	    <div class="loginUserForm">
        <br>
            <form method="POST" action="actionForgetpwd.php">
            <input class="credentialsInput" id="forgetPwdName" name="forgetPwdName" type="text" placeholder="Your Name" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus/><br>
            <input style="margin-top: 20px;" class="credentialsInput" id="forgetPwdEmail" type="text" name="forgetPwdEmail" placeholder="Email Address" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus/><br><br>
            <button style="margin-top: 2px;"class="loginButton" id="forgetPwdButton" type="submit" name="forgetPwdButton" >Send reset token</button>
            <h6 style="margin-top: 2px; font-size:10px">Don't have an Account? <a style="font-size:10px" href="signup.php">Sign Up here</a></h6>
            <h6 style="margin-top: 2px; font-size:10px">Need Help? <a style="font-size:10px" href="mailto:donotreply.mp@gmail.com">Email us</a></h6>
            </form>    
        </div>
	    </center>
    </body>

    <!-- 
        1. User forgets password and requests for reset by keying in username and email.
        2. Random TokenA generated and stored in PWDREQ table. 
        3. TokenA sent to User
        4. User retrieves TokenA and enters into reset password page, TokenA is compared with TokenA residing in PWDREQ table.
        5. If both tokens match, User is allowed to reset password. 

    -->
</html>