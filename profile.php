<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $_SESSION['profile_csrf_token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
        session_regenerate_id();
    } else {
        header("Location: index.php");
    }
?>

<html lang="en">
    <head>
        <title>Profile - MyPasswords</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
    <?php include 'navbar/dashboardnavbar.html';?>
    <div class="container">
        <h3 style="text-align: center" ><?php echo $_SESSION['username']."'s Profile";?></h3>
        <br>
        <br>
        <center>
	    <div class="loginUserForm">
            <div>
                    <button class="editPwdButton" id="editPwdButton" type="button" name="editPwdButton" onclick="showeditfields()" >Change Password</button></button>
                    <button class="delUserButton" id="delUserButton" type="submit" name="delUserButton" onclick="confirmDelUser()" >Delete User</button>   
            </div> 
                <form method="POST" action="actionSignout.php">
                    <button class="signoutButton" id="signoutButton" type="submit" name="signoutButton" >Sign Out</button>   
                </form>
                <form method="POST" action="actionEditpwd.php">
                    <br>
                    <h6 style="visibility: hidden; font-size: 11px;" id="setpwdtxt">Set new master password:</h6>
                    <input style="visibility: hidden" class="newPwdInput" id="changePwd" type="password" name="changePwd" placeholder="New Master Password" autocapitalize="none" autocomplete="off" spellcheck="false" required="yes" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Use at least 8 characters, including 1 number, 1 uppercase and 1 lowercase character')" oninput="setCustomValidity('')"/><br><br>
                    <div> 
                    <button style="visibility: hidden; width: 115px" class="deleteChangeButton" id="deleteChangeButton" type="button" name="deleteChangeButton" onclick="hideeditfields()" >Delete Changes</button></button>
                    <button style="visibility: hidden; width: 115px" class="changeButton" id="changeButton" type="submit" name="changeButton" >Save Changes</button>  
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['profile_csrf_token']?>"/>
                    </div>
                </form>    
        </div>
	    </center>
		</div>
    
        
    </body>

    <script>
    function showeditfields(){
            document.getElementById("changePwd").style.visibility = "visible"
            document.getElementById("changeButton").style.visibility = "visible"
            document.getElementById("deleteChangeButton").style.visibility = "visible"
            document.getElementById("setpwdtxt").style.visibility = "visible"
            document.getElementById("editPwdButton").style.visibility = "hidden"
            document.getElementById("delUserButton").style.visibility = "hidden"
            document.getElementById("signoutButton").style.visibility = "hidden"}
    function hideeditfields(){
            document.getElementById("changePwd").style.visibility = "hidden"
            document.getElementById("changeButton").style.visibility = "hidden"
            document.getElementById("deleteChangeButton").style.visibility = "hidden"
            document.getElementById("setpwdtxt").style.visibility = "hidden"
            document.getElementById("editPwdButton").style.visibility = "visible"
            document.getElementById("delUserButton").style.visibility = "visible"
            document.getElementById("signoutButton").style.visibility = "visible"}
    function confirmDelUser(){
        window.location.href='confirmDelete.php';
    }
    </script>
</html>