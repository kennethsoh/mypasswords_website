<?php
session_start();
$con=mysqli_connect('localhost','user','password', 'swap')  or die($con);
if(isset($_POST['signinButton'], $_POST['signinEmail'], $_POST['signinPwd'])){
    $email=mysqli_real_escape_string($con, $_POST['signinEmail']);
    $pwd=mysqli_real_escape_string($con, $_POST['signinPwd']);

    $stripedEmail = strip_tags($email);

    $sql="select * from swap.users where email='".$stripedEmail."'";
    $result=mysqli_query($con, $sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        $name=$row['name'];
        $password=$row['password'];
        $emailaddr=$row['email'];
        $role=$row['role'];
        if (password_verify($pwd, $row['password'])) {

            $_SESSION['username'] = $name;
            $_SESSION['email'] = $emailaddr;
            $_SESSION['loginfail'] = "0";
            $_SESSION['loggedin'] = true;

            // Logging sign in
            $datetime = date("l\, d F Y H:i:s");
            $date = date("d-m-Y");
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $clientAgent = $_SERVER['HTTP_USER_AGENT'];
            $log = fopen('logs/'.$date.' auth.txt', "a");
            fwrite($log, "Sign In: \nUser's name: ".$name."\nUser's email address: ".$emailaddr." \nDate & Time: ".$datetime." \nSign In Status: Success \nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);

            if($role == "Admin" && $_SESSION['email'] == "donotreply.mp@gmail.com" ){
                $_SESSION['admin'] = true;
                session_regenerate_id();

                header("Location: adminDashboard");
            } else {
                $_SESSION['admin'] = false;
                session_regenerate_id();
                header("Location: dashboard");
            }            

        } else {
            echo "<script type='text/javascript'>window.location='signin'</script>";
            $_SESSION['loginfail'] = "1";
            $_SESSION['loggedin'] = false;
            $datetime = date("l\, d F Y H:i:s");
            $date = date("d-m-Y");
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $clientAgent = $_SERVER['HTTP_USER_AGENT'];
            $log = fopen('logs/'.$date.' auth.txt', "a");
            fwrite($log, "Sign In: \nUser's name: ".$name."\nUser's email address: ".$emailaddr." \nDate & Time: ".$datetime."\nSign In Status: Failure "."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);
        }
    } 
}

?>
