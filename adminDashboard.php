<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true){
        session_regenerate_id();
    } else {
        header("Location: dashboard.php");
    }
?>
<html lang="en">
    <head> 
        <title>MyPasswords</title>
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
            <h3 style="text-align: center;" >Administrator Dashboard</h3>
            <br>
            <hr> 
            <center>   
                <?php  adminReport(); ?>
                <br>
                <h5 style="text-align: center;" ><b>Web Application Logs</b></h5>
                <form method="POST" action="actionlogs.php">
                <button style="width: 200px;" class="editPwdButton" id="exportLogsButton" type="submit" name="exportLogsButton" >Export and Delete All Logs</button> 
                </form>
                <br>
                <?php  showLogs(); ?>
                <br>
            </center>

        </div>
    </body>
</html>
<?php

function showLogs() {
$dir = "logs/";
// Remove hidden files
$allFiles = preg_grep('/^([^.])/', scandir($dir)); 
$logs = array_diff($allFiles, array('.', '..'));
if($logs == null){
    echo "
    <center>
        <h5>There are no logs available.</h5>
    </center>
    ";

} else {


foreach ($logs as $log){
    echo "
    <div >
        <div class='databox' style='background-color:white; border:2px solid black; width: 550px; padding:15px;'>
            <div class='row '>
                <div class='col-sm-9' style='text-align: left;' id='loginName'> $log </div>
                <div class='col-sm-1' style='text-align: center;' id='loginName'><a href='logs/$log' target='_blank'> View</a></div>
                <div class='col-sm-1' style='text-align: center;' id='loginName'><a href='logs/$log' download> Download </a></div>
            </div>
        </div>
    </div>";
}
}
}

function adminReport(){
    $con=mysqli_connect('localhost','user','password', 'swap')  or die($con);
    
        $sql="select count(*) from users where role='user'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        $numberOfUsers = $row['count(*)'];

        $sql1="select count(*) from data";
        $result1=mysqli_query($con, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $numberOfData = $row1['count(*)'];

        $sql2="select count(*) from pwdreq";
        $result2=mysqli_query($con, $sql2);
        $row2=mysqli_fetch_assoc($result2);
        $numberOfPwdreq = $row2['count(*)'];


        echo "
        <div >
            <div class='databox' style='background-color:white; border:none; width: 550px; padding:15px;'>
                <div class='row '>
                    <div class='col-sm-4' style='text-align: center; font-size: 44px; weight:bold;' id='loginName'> $numberOfUsers </div>
                    <div class='col-sm-4' style='text-align: center; font-size: 44px; weight:bold;' id='loginName'> $numberOfData </div>
                    <div class='col-sm-4' style='text-align: center; font-size: 44px; weight:bold;' id='loginName'> $numberOfPwdreq </div>
                </div>
                <div class='row '>
                    <div class='col-sm-4' style='text-align: center; font-size: 11px;' id='loginName'> Users</div>
                    <div class='col-sm-4' style='text-align: center; font-size: 11px;' id='loginName'> Credentials Stored</div>
                    <div class='col-sm-4' style='text-align: center; font-size: 11px;' id='loginName'> Password Reset Requests </div>
                </div>
            </div>
        </div>";

}  

?>



