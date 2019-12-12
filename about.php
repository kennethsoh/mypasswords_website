<?php
    session_start();
?>
<html lang="en">
	<head>
        <title>About - MyPasswords</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="styles/main.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ include 'navbar/dashboardnavbar.html';} else {include 'navbar/navbar.html';}?>
	</head>
	<body>
    <div class="container" style="background-color: white">
        <br>
        <h1 style="text-align: center" >Safely Forget your Passwords</h1>
        <p><pre style="text-align: center" >
You only need to remember one password. Save all other passwords  
with MyPasswords and safely forget them. All your data is   
protected by your master password, which only you know.

        
    </pre></p>
	</div>
	</body>
</html>

