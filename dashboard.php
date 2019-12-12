<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == false){
        session_regenerate_id();
    } elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true){
        header("Location: adminDashboard.php");
    } else {
        header("Location: index.php");
    }
?>
<html lang="en">
    <head> 
        <title>Dashboard - MyPasswords</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <?php include 'showData.php'; ?>
    </head>
    <body>
    <?php include 'navbar/dashboardnavbar.html';?>
        <div class="container">
            <h3 style="text-align: center;" >MyPasswords Dashboard</h3>
            <br>
            <br> 
            <center>
                <button style="margin-top: 2px; width: 160px;"class="loginButton" id="addNewDataRedirectButton" type="submit" name="addNewDataButton" onclick="redirect()" >Add New Login</button>
            </center>
            <br>
            <h6 style="text-align: center;">All your login data is listed here. You can directly copy the password and paste it into a login form. </h6>
        <?php  showData(); ?>
        </div>
    
        
    </body>

    <script>
    
        function redirect() {
            window.location="dataentry.php"
        }
        
             // Delete Login Data Ajax
            var deleteDataJS = function(x) {   
                $.ajax({
                    url: 'actionDeletedata.php',
                    type: 'POST',
                    data: {id:x},
                    success: function(data) {
                        console.log(data);

                    }
                });
            };

            // Plaintext Password Copy AJAX
            var plainpwdJS = function(x) {  
                 
                $.ajax({
                    url: 'showplaintxt.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {id:x},
                    success: function(data) {
                    console.log(data);
                    

                    }
                });
            };
    </script>
</html>


