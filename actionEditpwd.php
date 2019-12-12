<?php
    $con = new mysqli('localhost','user','password', 'swap');
    if(isset($_POST['changeButton'], $_POST['changePwd'])){
        if (($_SESSION['profile_csrf_token']==$_POST['profile_csrf_token'])){
        $pwd=mysqli_real_escape_string($con, $_POST['changePwd']);

        
        $stripedPwd = strip_tags($pwd);
        if (preg_match("(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", $stripedPwd)){

        $hpwd = password_hash($stripedPwd, PASSWORD_BCRYPT);

    
        $stmt = $con->prepare("UPDATE swap.users SET password='$hpwd'");
        $stmt->bind_param("s", $hpwd);
        $stmt->execute();
        $stmt->close();
        header("Location: profile");
        echo "<script type='text/javascript'>alert(' User Create success!')</script>";
        unset($_SESSION['profile_csrf_token']);

    } else {
        unset($_SESSION['profile_csrf_token']);
        header("Location: profile");
    }
      
    } else {
        unset($_SESSION['profile_csrf_token']);
        http_response_code(401);
        echo "Please try to refresh your page";

    }
}
    
        
?>