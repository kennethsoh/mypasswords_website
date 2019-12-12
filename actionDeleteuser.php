<?php
    session_start();
    $con = new mysqli('localhost', 'user', 'password', 'swap');
if(isset($_POST['confirmDelButton']) && $_POST['confirmDel'] == "DELETE") {

    if ($_SESSION['username'] == "Admin" && $_SESSION['email'] == "donotreply.mp@gmail.com" && $_SESSION['admin'] == true) {
        echo "<script type='text/javascript'>alert('Administrator Account cannot be Deleted'); window.location='profile.php'</script>";

    } elseif ($_SESSION['username'] != "Admin" && $_SESSION['email'] != "donotreply.mp@gmail.com" && $_SESSION['admin'] == false) {

        if (($_SESSION['csrf_token']==$_POST['csrf_token'])) {

            $email = mysqli_real_escape_string($con, $_SESSION['email']);
            $sql="delete from swap.data where email='".$email."'";
            $result=mysqli_query($con, $sql);

            $sql2="delete from swap.users where email='".$email."'";
            $result2=mysqli_query($con, $sql2);
        
            // Logging Account Delete
            $datetime = date("l\, d F Y H:i:s");
            $date = date("d-m-Y");
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $clientAgent = $_SERVER['HTTP_USER_AGENT'];
            $log = fopen('logs/'.$date.'delete.txt', "a");
            fwrite($log, "Delete Account: \nUser's name: ".$_SESSION['username']."\nUser's email address: ".$email." \nDate & Time: ".$datetime."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);

            $_SESSION['loggedin'] = false;
            unset($_SESSION['email']);
            unset($_SESSION['username']);  
            unset($_SESSION['csrf_token']); 
            session_destroy();
            header("Location: index");
        } else {
            http_response_code(401);
            echo "Please refresh your page and try again";

        }
    }
      
}
    
        
?>