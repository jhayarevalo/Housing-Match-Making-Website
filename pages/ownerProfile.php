<!DOCTYPE html>
<html>
<head>
	<title>My Tenant Profile - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
		<div class="titlePage">
			<h1>MY OWNER PROFILE</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id="content" class="content7" >
	<div class="form">
	<form name="ownerCriteria" action="ownerProfile.php" method="post">
	<h4>TENANT SELECTION CRITERIA</h4>
	<p class="instructions">This form will allow you to be matched with tenants who best suit your desired criteria</p>
	<p><label>Pets Allowed
		<select id="pets" name="pets">
			<option value="yes">Yes</option>
			<option value="no">No</option>
		</select></label></p>	
	<p><label>Smoking Permitted
		<select id="smoking" name="smoking">
			<option value="yes">Yes</option>
			<option value="no">No</option>	
		</select></label></p>
	<p><label>Maximum Vehicles Allowed
		<select id="vehicles" name="vehicles">
			<option value="0">None</option>	
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3+">3+</option>			
		</select></label></p>
	<p><label>Maximum Number of Occupants
		<select id="occupants" name="occupants">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4+">4+</option>				
		</select></label></p>			
	<p><pre>Age	Minimum <input type="text" id="minAge" name="minAge" size="5" />
	Maximum <input type="text" id="maxAge" name="maxAge"size="5" /></pre>
	</p>
	<p><label>Employment Status of Tenant
		<select id="emplStatus" name="emplStatus">
			<option value="null">--Select Status--</option>
			<option value="student">Student</option>
			<option value="fulltime">Full Time</option>
			<option value="parttime">Part Time</option>
			<option value="unemployed">Unemployed</option>
			<option value="retired">Retired</option>
			<option value="any">Any</option>
		</select></label></p>
	<p><label>Level of Income of Tenant
		<select id="income" name="income">
			<option value="null">--Select Income--</option>
			<option value="low">Less than $20,000</option>
			<option value="mid-low">$20,000 to $30,000</option>
			<option value="mid">$30,000 to $60,000</option>
			<option value="mid-high">$60,000 to $150,000</option>
			<option value="high">Over $150,000</option>
			<option value="any">Any</option>
		</select></label></p>

	<p><input type="submit" class="buttons" value="Save Changes"/>&nbsp;&nbsp;<input type="reset" class="buttons" value="Reset"/></p>
	</form>
	</div>
		

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
	if(	isset($_POST['pets']) && isset($_POST['smoking']) && isset($_POST['vehicles']) && isset($_POST['occupants']) && isset($_POST['minAge']) && isset($_POST['maxAge']) && isset($_POST['emplStatus']) && isset($_POST['income'])){
	
	//Getting values from form for new user
	$pets = $_POST['pets'];
	$smoking = $_POST['smoking'];
	$vehicles = $_POST['vehicles'];
	$occupants = $_POST['occupants'];
	$minAge = $_POST['minAge'];
	$maxAge = $_POST['maxAge'];
	$emplStatus = $_POST['emplStatus'];	
	$income = $_POST['income'];	
	
	$email = $_SESSION['user_email'];
	$query = mysqli_query($conn,"SELECT user_id FROM users WHERE email = '$email'");

	$varID = 'user_id';
	$rows = mysqli_fetch_assoc($query);
	$userID = $rows[$varID];
		
	$newOPref = "INSERT INTO owner_preferences (user_id,pets_allowed,smoking_allowed,max_vehicles,max_occupants,age_min,age_max,empl_status,lvl_income)
				VALUES('$userID','$pets','$smoking','$vehicles','$occupants',$minAge,$maxAge,'$emplStatus','$income')";
				
		if (mysqli_query($conn, $newOPref)) {
			echo "<br>New record created successfully";
		} 
		else 
			echo "<br>Error. " . $newOPref . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);			
	?> 
</body>

</html>