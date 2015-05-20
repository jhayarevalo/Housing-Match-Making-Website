<!DOCTYPE html>

<html>
<head>
	<title>Registration - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../javascript/functions.js"></script>
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>

		<div class="titlePage">
			<h1>REGISTRATION</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id = "content" class="content3" >

	<div class="form">
	<h4>USER REGISTRATION FORM</h4> 
		<form name="userRegForm" action="registration.php" method="post" onsubmit="return validReg();" class="regForm">
		<p><label>First Name <input type="text" id="firstName" name="firstName" /></label></p>
		<p class="details">Letters and hyphens only</p>
		<p><label>Last Name <input type="text" id="lastName" name="lastName"/></label></p>
		<p class="details">Letters and hyphens only</p>
		<p><label>Registered as 
			<select id="regType" name="regType">
				<option value="null">--Select an option--</option>
				<option value="tenant">Tenant</option>
				<option value="owner">Property Owner</option>
			</select>
		</label></p>
		<p class="details">Note: If you do not select a type, 'tenant' will be set as default.</p>
		<p>Phone Number (<input type="text" id="areaCode" name="areaCode" size="3"/>)<input type= "text" id="phoneNumber" name="phoneNumber" size="8"/></p>
		<p class="details">Format:(xxx)xxx-xxxx</p>
		<p><label>E-mail address <input type="text" id="e-mail" name="e-mail"/></label></p>
		<p class="details">eg: rental287@concordia.ca</p>
		<p><label>Password <input type="password" id="password" name="password"/></label></p>
		<p class="details">Must contain at least one of number and one letter.<br>Password is case sensitive. (Minimum 6 characters)</p>
		<p><label>Confirm password <input type="password" id="repassword" name="repassword"> </label></p>
		<p class="details">Re-enter your password</p>
		<p><input type="submit" class="buttons" value="Register" /><input type="reset" class="buttons" value="Reset"/></p>
		
	</form></div>	

	</div>
	<?php 
	
	include 'includes/footer.php';

	$dbserver = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "rental_7344333";

	//Creating the connection to the server
	$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

	//Displaying connection results
	/*if ($conn->connect_error) {
		die("Connection unsuccessful. ".$conn->connect_error);
	}
	else
		echo "Connected successfully";*/
	
	//Checking if user can be created -- will only submit form if these variables are set
	if(	isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['regType']) && isset($_POST['areaCode']) && isset($_POST['phoneNumber']) && isset($_POST['e-mail']) && isset($_POST['password'])){
	
	//Getting values from form for new user
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$regType = $_POST['regType'];
	$completePhone = "(".$_POST['areaCode'].")".$_POST['phoneNumber'];
	$email = $_POST['e-mail'];
	$password = $_POST['password'];	
	
	//Checking if e-mail already taken
	$selectUser = "SELECT * FROM users WHERE email = '$email'";
	$emailValid = mysqli_query($conn,$selectUser);
	$checkEmail = mysqli_num_rows($emailValid);
	
	if($checkEmail == true){
		echo "<script type='text/javascript'>alert(\"'$email' is already registered.\");
	window.location.href = 'registration.php';</script>";
	}
	else{
	$newUser = "INSERT INTO users (first_name,last_name,user_type,phone,email,password)
				VALUES('$firstName','$lastName','$regType','$completePhone','$email',md5('$password'))";
		
	
	if (mysqli_query($conn, $newUser)) {
		echo "<script type='text/javascript'>alert(\"Account for '$email' created!\");
	window.location.href = 'index.php';</script>";
	} 
	else 
		echo "<br>Error. " . $newUser . "<br>" . mysqli_error($conn);
	}
	}
	mysqli_close($conn);			
	?> 	
</body>
	
</html>