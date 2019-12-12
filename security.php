<?php
    session_start();
?>
<html lang="en">
	<head>
        <title>Security - MyPasswords</title>
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
        <h1 style="text-align: center" >Security: Our Top Priority</h1>
        <p><pre style="text-align: center" >
We handle your data very seriously. Everything we do 
is bulit upon the fundamentals of privacy and security.
	</pre></p>
	<hr>
	<br>
		<h5 style="text-align: center" >Secure Encryption</h5>
		<p><pre style="text-align: center" >
Information you store in MyPasswords is only accessible 
by you. We use AES-256 bit encryption to protect your data.
	</pre></p>
	<br>
	<div class='databox' style='background-color:white; border:none;  padding:20px;'>
		<div class='row'>
			<div class='col-sm-5'><b>The one key to rule them all</b><Br>
			Create one master password that only you know.
			
		
		</div>
			<img class='col-sm-7' style='width: 640px; height: 400px'src='signin.png'>
		 </div>
		 
	</div>
	</div>
	</body>
</html>