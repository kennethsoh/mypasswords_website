<?php
	session_start();
	session_regenerate_id();
	$_SESSION['loginfail'] = "0";
	$_SESSION['emailfail'] = "0";
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == false){
        header("Location: dashboard");
    } elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['admin'] == true) {
        header("Location: adminDashboard");
    } else {
		;
	}
?>
<html lang="en">
	<head>
        <title>MyPasswords</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="styles/main.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<?php include 'navbar/navbar.html';?>
	</head>
	<body>
	<div class="container" style="background-color: white">
			<p><h3 style="text-align: center" >MyPasswords</h3></p>
	</div>
	</body>
</html>
