<?php
session_start();
    $con = new mysqli('localhost', 'user', 'password', 'swap');
if(isset($_POST['signupButton'], $_POST['signupName'], $_POST['signupEmail'], $_POST['signupPwd'])) {
    $name=mysqli_real_escape_string($con, $_POST['signupName']);
    $pwd=mysqli_real_escape_string($con, $_POST['signupPwd']);
    $email=mysqli_real_escape_string($con, $_POST['signupEmail']);

    if (preg_match("(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", $pwd)){

    // Check CSRF Token, otherwise send 401 error
    if (($_SESSION['signup_csrf_token']==$_POST['signup_csrf_token'])){
        
    // Check for similar email address in database
    $check_existing_user="select * from users where email='$email' limit 1";
    $check_result=mysqli_query($con, $check_existing_user);
    $user = mysqli_fetch_assoc($check_result);

    if ($user) {
        echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('Email already registered, sign in instead'); window.location='signin.php';</SCRIPT>");
    } else {
            
        // Remove all illegal characters from email
        $checkemail = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (filter_var($checkemail, FILTER_VALIDATE_EMAIL)) {
            $hpwd = password_hash($pwd, PASSWORD_BCRYPT);
            
            // Generate random userid (45,239,040 unique permuations)
            // $uniqid = md5(uniqid(rand(), true));
            // $userid = substr($uniqid,0,5);

            $role=mysqli_real_escape_string($con, "User");

            $stripedName = strip_tags($name);
            $stripedRole = strip_tags($role);
            
            $stmt = $con->prepare("INSERT INTO swap.users (name, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $stripedName, $hpwd, $checkemail, $stripedRole);
            $stmt->execute();
            $stmt->close();
            $_SESSION['username'] = $stripedName;
            $_SESSION['email'] = $checkemail;
            $_SESSION['loggedin'] = true;
            unset($_SESSION['signup_csrf_token']);

            // Logging Sign Up
            $datetime = date("l\, d F Y H:i:s");
            $date = date("d-m-Y");
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $clientAgent = $_SERVER['HTTP_USER_AGENT'];
            $log = fopen('logs/'.$date.' auth.txt', "a");
            fwrite($log, "Sign Up: \nUser's name: ".$name."\nUser's email address: ".$emailaddr." \nDate & Time: ".$datetime."\nSign Up Status: Success "."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);
            
            if ($role == "Admin" && $_SESSION['email'] == "donotreply.mp@gmail.com") {
                $_SESSION['admin'] = true;
                header("Location: adminDashboard");
            } else {
                $_SESSION['admin'] = false;
                header("Location: dashboard");
            }
            
        } else {
            unset($_SESSION['signup_csrf_token']);
            $log = fopen('logs/'.$date.' auth.txt', "a");
            fwrite($log, "Sign Up: \nUser's name: ".$name."\nUser's email address: ".$emailaddr." \nDate & Time: ".$datetime."\nSign Up Status: Failure "."\nUser's IPADDR: ".$clientIP."\nUser's Agent: ".$clientAgent." "."\n" ."\n");
            fclose($log);

            echo ("<SCRIPT LANGUAGE='JavaScript'>window.location='signup';</SCRIPT>");
            $_SESSION['emailfail'] = "1";
                }
            }
        } else {
            unset($_SESSION['signup_csrf_token']);
            http_response_code(401);
            echo "Unauthorised. Please try to refresh your page or browser";
        }
    } else {
        unset($_SESSION['signup_csrf_token']);
        header("Location: signup");
    }
}      
?>