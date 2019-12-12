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

if (isset($_POST['exportLogsButton'])){

    $zip = new ZipArchive();
    $res = $zip->open("export.zip", ZipArchive::CREATE);
    
    // Add log files to the zip file
    $dir = "logs/";
    
    // Remove hidden files
    $allFiles = preg_grep('/^([^.])/', scandir($dir)); 
    $logs = array_diff($allFiles, array('.', '..'));
    if ($logs != null){
    foreach ($logs as $log){
        $zip->addFile('logs/'.$log);
    }
    // All files are added, so close the zip file.
    $zip->close();
    

    $date = date("l\, d F Y H:i:s");
    try {

        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '';                                     // SMTP username
        $mail->Password   = '';                                        // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable SSL encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;

        /* Mail Settings */

        // Plain text body (for mail clients that cannot read HTML)
        $text_body = "Here are all the log files exported on '".$date."'.\n";
        $text_body .= "All log files have been deleted from the server \n";

        $mail->setFrom('donotreply.mp@gmail.com', 'MyPasswords');
        $mail->addAddress('donotreply.mp@gmail.com');
        $mail->Subject = 'Log Files Export'; 
        $mail->Body = $text_body;
        $mail->addAttachment('export.zip');
        $mail->send();
        
        // Delete zip file
        unlink('export.zip');
        
        // Delete all files after export
        $allfiles = glob('logs/*');
        foreach ($allfiles as $file){
            if(is_file($file)){
                unlink($file);
            }
        }

        echo  "<script> location.replace('adminDashboard.php');</script>";
     }
     catch (Exception $e)
     {
        /* PHPMailer exception. 
        echo $e->errorMessage(); */
     }
     catch (\Exception $e)
     {
        /* PHP exception (note the backslash to select the global namespace Exception class).    
        echo $e->getMessage();*/
     }
    header("Location:adminDashboard.php");

    } else {
        unlink('export.zip');
        header("Location:adminDashboard.php");
    }
    
}
      
?>