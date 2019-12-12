<?php
session_start();
if(isset($_POST['signoutButton'])){

    // Logging Sign Out
    $datetime = date("l\, d F Y H:i:s");
    $date = date("d-m-Y");
    $clientIP = $_SERVER['REMOTE_ADDR'];
    $clientAgent = $_SERVER['HTTP_USER_AGENT'];
    $log = fopen('logs/'.$date.' auth.txt', "a");
    fwrite($log, "Sign out: \nUser's name: ".$_SESSION['username']."\nUser's email address: ".$_SESSION['email']." \nDate & Time: ".$datetime."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
    fclose($log);

    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['admin']);
    $_SESSION['loggedin'] = false;
    session_destroy();
    header("Location: index.php");
    
}

?>