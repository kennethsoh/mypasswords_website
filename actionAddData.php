<?php
session_start();
include 'sensitive.php';
    $con = new mysqli('localhost','user','password', 'swap');
    if(isset($_POST['newDataButton'], $_POST['newLoginName'], $_POST['newLoginUser'], $_POST['newLoginPwd'])){
        $email = $_SESSION['email'];
        $name=mysqli_real_escape_string($con, $_POST['newLoginName']);
        $usr=mysqli_real_escape_string($con, $_POST['newLoginUser']);
        $pwd=mysqli_real_escape_string($con, $_POST['newLoginPwd']);
            
        $stripedEmail = strip_tags($email);
        $stripedName = strip_tags($name);
        $stripedUsr = strip_tags($usr);
        $stripedPwd = strip_tags($pwd);
        $epwd=encrypt($stripedPwd);

        $sql = "INSERT INTO swap.data (email, dataName, dataLogin, dataPassword) VALUES ('".$stripedEmail."', '".$stripedName."', '".$stripedUsr."', '".$epwd."')";
        $result=mysqli_query($con, $sql);
    
        header("Location: dashboard");
       
}      
?>