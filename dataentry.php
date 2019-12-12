<?php
    session_start();
?>
<html lang="en">
    <head>
        <title>Add Login - MyPasswords</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ include 'navbar/dashboardnavbar.html';} else {include 'navbar/navbar.html';}?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h4 style="margin:10 auto;display:block; text-align:center;color:black;" >Add New Account Login</h4>
        <center>
	    <div class="loginUserForm">
        <br>
        <form method="POST" action="actionAddData.php">
        <input class="credentialsInput" id="newLoginName" name="newLoginName" type="text" name="" placeholder="Account Name" autofocus="true" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes"/><br><br>
        <input class="credentialsInput" id="newLoginUser" name="newLoginUser" type="text" name="" placeholder="Username or Email" autofocus="false" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes"/><br><br>
        <input class="credentialsInput" id="newLoginPwd" name="newLoginPwd" type="password" name="" placeholder="Password" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes"/><br><br>
        <div>
          <button style="width: 120px;" class="editPwdButton" id="returnDashboard" name="returnDashboard" type="button" onclick="returnToDashboard()">Cancel</button>
          <button style="width: 120px;" class="editPwdButton" id="newDataButton" name="newDataButton" type="submit" >Save</button>
        </div>
        </div>
        </form>
	    </center>
    </body>
    <script>
      function returnToDashboard() {
        window.location="dashboard.php";
      }
    </script>
</html>