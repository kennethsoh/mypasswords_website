<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require '/Users/kenneth/SWAP/PHPMailer/src/Exception.php';
/* The main PHPMailer class. */
require '/Users/kenneth/SWAP/PHPMailer/src/PHPMailer.php';
/* SMTP class, needed if you want to use SMTP. */
require '/Users/kenneth/SWAP/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// Forget Password Process Handling after form submission on forgetpwd.php
session_start();
$con=mysqli_connect('localhost','user','password', 'swap')  or die($con);
if(isset($_POST['forgetPwdName'], $_POST['forgetPwdEmail'], $_POST['forgetPwdButton'])){
    $name=mysqli_real_escape_string($con, $_POST['forgetPwdName']);
    $email=mysqli_real_escape_string($con, $_POST['forgetPwdEmail']);

    // Generate Unique Token.
    $token = substr(bin2hex(random_bytes(17)),0,9);

    // Check if name & email entered is valid. 
    $sql="select name, email from swap.users where name='".$name."' and email='".$email."'";
    $result=mysqli_query($con, $sql);
    $num=mysqli_num_rows($result);
    if ($num >= 1){
        // Remove all exisiting tokens
        $s="delete from swap.pwdreq where email='".$email."'";
        $r=mysqli_query($con, $s);
        $stmt = $con->prepare("INSERT INTO swap.pwdreq (name, email, token) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $token);
        $stmt->execute();

        $date = date("l\, d F Y H:i:s");
        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '';                                     // SMTP username
            $mail->Password   = '';                                     // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable SSL encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;

            /* Mail Settings */

            // Plain text body (for mail clients that cannot read HTML)
            $text_body  = 'Hello ' . $name . ", \n";
            $text_body .= "On ".$date.". You requested for a password reset token. \n";
            $text_body .= "Your token is: '".$token."' \n";
            $text_body .= "Your token will expire if you request for a new token.\n\n";
            $text_body .= "Please change your password immediately if you have not requested for a reset.\n\n";
            $text_body .= "Sincerely, \n";
            $text_body .= 'MyPasswords';


            $mail->setFrom('dtpstpvtpppp@gmail.com', 'MyPasswords');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset Request'; 
            $mail->Body = $text_body;
            $mail->send();
            $stmt->close();

            // Logging Password Reset Success
            $datetime = date("l\, j F Y H:i:s");
            $date = date("d-m-Y");
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $clientAgent = $_SERVER['HTTP_USER_AGENT'];
            $log = fopen('logs/'.$date.'reset.txt', "a");
            fwrite($log, "Password Reset Request: \nUser's email address: ".$email."\nRequest Date & Time: ".$datetime.""."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);

            header("Location:resetpassword");
         }
         catch (Exception $e)
         {
            /* PHPMailer exception. */
            echo $e->errorMessage(); 
         }
         catch (\Exception $e)
         {
            /* PHP exception (note the backslash to select the global namespace Exception class).   */
            echo $e->getMessage();
         }

         

    } else {

        echo  "<script> alert('Please enter a valid registered name and email address'); window.location='signin'</script>";
    }
}





?>
