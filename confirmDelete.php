<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $_SESSION['csrf_token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        session_regenerate_id();
    } else {
        header("Location: index.php");
    }
?>

<html lang="en">
    <head>
        <title>Delete Account - MyPasswords</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
	<?php include 'navbar/dashboardnavbar.html';?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h4 style="margin:10 auto;display:block; text-align:center;color:black;" >Delete Account</h4>
        <p style="margin:10 auto;display:block; text-align:center;color:red; font-size:10px;">Warning: This action is permament and ireversible<p>
        <center>
	    <div class="loginUserForm">
            <form method="POST" action="actionDeleteuser.php">
            <input style="margin-top: 20px;" class="credentialsInput" id="confirmDel" type="text" name="confirmDel" placeholder="Type 'DELETE' to confirm " autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" autofocus pattern="DELETE" oninvalid="this.setCustomValidity('Type DELETE to confirm')" oninput="setCustomValidity('')"/><br><br>
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>"/>
            <button style="margin-top: 2px;"class="loginButton" id="confirmDelButton" type="submit" name="confirmDelButton" >Confirm Delete</button>
            <h6 style="margin-top: 2px; font-size:10px">Changed your mind? <a style="font-size:10px" href="profile.php">Return to profile</a></h6>
            </form>    
        </div>
	    </center>
    </body>
</html>