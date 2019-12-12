<?php
session_start();

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
  
    $x = $_POST['id'];
    
    $con = new mysqli('localhost','user','password', 'swap');
    $chk="select * from swap.data order by dataName ASC";
    $chkresult=mysqli_query($con, $chk);    
    $num=mysqli_num_rows($chkresult);
    for($i=1; $i <= $num; $i++){
        $row=mysqli_fetch_assoc($chkresult);
        if ($i == $_POST['id']){
            $dataPassword=$row['dataPassword'];
            }
        }

    $PlainPwd=decrypt($dataPassword);
    echo $PlainPwd;
        exit;


    
?>