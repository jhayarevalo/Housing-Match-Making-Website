<?php
session_start();
if(isset($_POST['login'])){ 

	if (empty($_POST['user_email']) || empty($_POST['user_password'])) {
		echo "<script type='text/javascript'>alert(\"Please enter an e-mail and password.\");
			window.location.href = '../index.php';</script>";
	}
	
	else{
	
	$username = $_POST['user_email'];
	$pass = md5($_POST['user_password']);
	
	$dbserver = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbName = "rental_7344333";

	//Connecting to database rental_7344333
	$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbName);
	/*echo "<br>Checking connection: ";
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	else
		echo "Connection is good.";*/

	//Checking user
	$selectUser = "SELECT * FROM users WHERE email = '$username' AND password = '$pass'";
	$sign_in = mysqli_query($conn,$selectUser);
	$checkUser = mysqli_num_rows($sign_in);
	
	if($checkUser == true){
	$_SESSION['user_email']=$username;   
	
    echo "<script type='text/javascript'>alert(\"Hello '$username'.\");
	window.location.href = '../index.php';</script>";
	}
	else
		echo "<script type='text/javascript'>alert(\"E-mail or password is incorrect. Please try again.\");
			window.location.href = '../index.php';</script>";
}
}


?>