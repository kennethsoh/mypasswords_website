<?php
function encrypt($string) {
    $output = false;
     $encrypt_method = "AES-256-CBC";

    $secret_key = 'regYUDkadi9dbBJB7J';
    $secret_iv = 'AVGthJJUiik3366iwhd9';
  
    // hash
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
   
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    
    return $output;
}

// Decryption Method
function decrypt($string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'regYUDkadi9dbBJB7J';
    $secret_iv = 'AVGthJJUiik3366iwhd9';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    
    return $output;
}

function copyepwd() {
    $PlainPwd=decrypt();
    clipboardData.setData ($PlainPwd);
}

function deleteData($x) {

    $con = new mysqli('localhost','user','password', 'swap');
    $chk="select * from swap.data";
    $chkresult=mysqli_query($con, $chk);
    $num=mysqli_num_rows($chkresult);
    for($i=1; $i <= $num; $i++){
        $row=mysqli_fetch_assoc($result);
        if ($i == $x){
            $email=$row['email'];
            $dataName=$row['dataName'];
            $dataLogin=$row['dataLogin'];
            $dataPassword=$row['dataPassword'];
            }
        }
    
        $sql="delete from swap.data where email='.$email.' and dataName='.$dataName.' and dataLogin='.$dataLogin.' and dataPassword='.$dataPassword.'";
        $result=mysqli_query($con, $sql);
    
    }

?>