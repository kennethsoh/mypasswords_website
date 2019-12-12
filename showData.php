<?php
function showData(){
    include 'sensitive.php';
    $con=mysqli_connect('localhost','user','password', 'swap')  or die($con);
        $email=mysqli_real_escape_string($con, $_SESSION['email']);

        $sql="select * from swap.data where email='$email' order by dataName ASC";
        $result=mysqli_query($con, $sql);
        $num=mysqli_num_rows($result);
    
        for($i=1; $i <= $num; $i++){
            $row=mysqli_fetch_assoc($result);
            $dataName = $row['dataName']; 
            $epwd = $row['dataPassword'];
            $pwd = decrypt($epwd);
        
            echo"
            <div>
                <div class='databox echoed' style='background-color:white; border:2px solid black; margin: 2 auto; padding:20px; '>
                    <div class='row echoed'>
                        <div class='col-sm-2 echoed' id='loginNameTitle' style='font-weight:bold'>Login Name:</div>
                        <div class='col-sm-4 echoed' id='loginName'>". $row['dataName'] . "</div>
                    </div>
                    <div class='row echoed'>
                        <div class='col-sm-2 echoed' id='loginUsrTitle' style='font-weight:bold'>Login Username:</div>
                        <div class='col-sm-4 echoed' id='loginUsr'>". $row['dataLogin'] . "</div>
                    </div>
                    <div class='row echoed'>
                        <div class='col-sm-2 echoed' id='loginPwdTitle' style='font-weight:bold'>Login Password:</div>
                        <div class='col-sm-4 echoed' id='loginPwd".$i."' style=' -webkit-user-select: all; user-select:all; text-shadow: 0 0 11px #000; color: transparent;' >".$pwd."</div>
                        <div class='col-sm-4 echoed' ></div>
                        <form>
                        <button class='deleteLoginButton echoed delete' id='deleteDataButton' name='deleteDataButton' type='submit' value=".$i."'' onclick='deleteDataJS(".$i.")'>Delete Login</button>
                        <!-- <button class='deleteLoginButton' id='revealPlaintxtButton' name='revealPlaintxtButton' type='submit' value=".$i."'' onclick='plainpwdJS(".$i.")'>Copy Password</button> -->
                        </form>
                    </div>
                </div>
            </div> 
            ";

        
        } 
}  

// style='text-shadow: 0 0 11px #000; color: transparent;'
// value=".$i."''
// onclick='deleteDataJS(".$i."
// Set deleteDataButton in a POST form with action="actionDeletedata.php"
// actionDeletedata.php to check isset($_POST['deleteDataButton'])

?>

