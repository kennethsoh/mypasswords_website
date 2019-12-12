<?php
session_start();
  
   
    
    $x = $_POST['id'];
    $con = new mysqli('localhost','user','password', 'swap');
    $email=mysqli_real_escape_string($con, $_SESSION['email']);
    $chk="select dataName, dataLogin from swap.data where email='$email' order by dataName ASC";
    $chkresult=mysqli_query($con, $chk);    
    $num=mysqli_num_rows($chkresult);
    for($i=1; $i <= $num; $i++){
        $row=mysqli_fetch_assoc($chkresult);
        $dataName=$row['dataName'];
        $dataLogin=$row['dataLogin'];
        if ($i == $_POST['id']){
            $sql="DELETE from swap.data where email='$email' and dataName=\"".$dataName."\" and dataLogin=\"".$dataLogin."\" LIMIT 1";
            mysqli_query($con, $sql);
            $sql2="DELETE from swap.data where email='$email' and dataName='$dataName' and dataLogin='$dataLogin' LIMIT 1";
            mysqli_query($con, $sql2);
            }
        }
      
        exit;
    
?>