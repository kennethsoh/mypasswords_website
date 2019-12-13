<?php
session_start();
$con=mysqli_connect('localhost','user','password', 'swap')  or die($con);
if(isset($_POST['resetPwdEmail'], $_POST['resetPwdPassword'], $_POST['resetPwdToken'], $_POST['resetPwdButton'])){
    $email=mysqli_real_escape_string($con, $_POST['resetPwdEmail']);
    $password=mysqli_real_escape_string($con, $_POST['resetPwdPassword']);
    $token=mysqli_real_escape_string($con, $_POST['resetPwdToken']);

    $hpwd = password_hash($password, PASSWORD_BCRYPT);
    
    // Check CSRF Token, otherwise send 401 error
    if (($_SESSION['csrf_token']==$_POST['csrf_token'])){
        
    $sql="select * from swap.pwdreq where email='".$email."' and token='".$token."'";
    $result=mysqli_query($con, $sql);
    $num=mysqli_num_rows($result);
    if ($num >= 1){
        $stmt = $con->prepare("UPDATE swap.users SET password='$hpwd'");
        $stmt->bind_param("s", $hpwd);
        $stmt->execute();
        $stmt->close();

        // Logging Password Reset Success
        $datetime = date("l\, d F Y H:i:s");
        $date = date("d-m-Y");
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $clientAgent = $_SERVER['HTTP_USER_AGENT'];
        $log = fopen('logs/'.$date.' reset.txt', "a");
        fwrite($log, "Password Reset: \nUser's email address: ".$email."\nReset Status: Success "."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
        fclose($log);

        $sql2="delete from swap.pwdreq where email='".$email."'";
        $result2=mysqli_query($con, $sql2);

        $_SESSION['loginfail'] = "0";
        $_SESSION['emailfail'] = "0";
        unset($_SESSION['csrf_token']);
        echo  "<script> alert('Password reset successful'); window.location='signin.php'</script>";

    } else {
        unset($_SESSION['csrf_token']);
        echo  "<script> alert('Please enter a registered email address and a valid token.'); window.location='resetpassword.php'</script>";

        // Logging Password Reset Failure
        $datetime = date("l\, d F Y H:i:s");
        $date = date("d/m/Y");
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $clientAgent = $_SERVER['HTTP_USER_AGENT'];
        $log = fopen('logs/'.$date.' reset.txt', "a");
        fwrite($log, "Password Reset: \nUser's email address: ".$email."\nReset Status: Failure "."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
        fclose($log);
    }
} else {
    http_response_code(401);
    echo "Unauthorised. Please try to refresh your page or browser";
    unset($_SESSION['csrf_token']);

}

}

?>
