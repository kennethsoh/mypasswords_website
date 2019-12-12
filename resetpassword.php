<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("Location: profile.php");
    } else {
        $_SESSION['csrf_token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        session_regenerate_id();
    }
?>

<html lang="en">
    <head>
        <title>Reset Password - MyPasswords</title>
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
        <h4 style="margin:10 auto;display:block; text-align:center;color:black;" >Password Reset</h4>
        <center>
	    <div class="loginUserForm">
        <br>
            <form method="POST" action="actionResetpwd.php">
            <input class="credentialsInput" id="resetPwdEmail" name="resetPwdEmail" type="text" placeholder="Email Address" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus/><br>
            <input style="margin-top: 20px;" class="credentialsInput" id="resetPwdPassword" type="password" name="resetPwdPassword" placeholder="New Master Password" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Use at least 8 characters, including 1 number, 1 uppercase and 1 lowercase character')" oninput="setCustomValidity('')"/><br>
            <input style="margin-top: 20px;" class="credentialsInput" id="resetPwdToken" type="text" name="resetPwdToken" placeholder="Reset Token" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" /><br><br>
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>"/>
            <button style="margin-top: 2px;"class="loginButton" id="resetPwdButton" type="submit" name="resetPwdButton" >Reset Password</button>
            <h6 style="margin-top: 2px; font-size:10px">Didn't receive a token? <a style="font-size:10px" href="forgetpwd.php">Request for one</a></h6>
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