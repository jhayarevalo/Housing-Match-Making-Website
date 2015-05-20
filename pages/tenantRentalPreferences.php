<!DOCTYPE html>
<html>
<head>
	<title>List Properties - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
		<div class="titlePage">
			<h1>MY PREFERENCES</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id="content" class="content6" >
	<div class="form">
	<h4>HOUSING PREFERENCES</h4>
	<form name="propertySearchForm" action="tenantRentalPreferences.php" method="post">
		<a href="tenantProfile.php" class="preferences">Back To My Profile</a>
	<p><label>Location
		<select id="location" name="location">
			<option value="null">--Select Preferred Location--</option>
			<option value="all">All</option>
			<option value="AB">Alberta</option>
			<option value="BC">British Columbia</option>
			<option value="MB">Manitoba</option>
			<option value="NB">New Brunswick</option>
			<option value="NL">Newfoundland and Labrador</option>
			<option value="NS">Nova Scotia</option>
			<option value="ON">Ontario</option>
			<option value="PE">Prince Edward Island</option>
			<option value="QC">Quebec</option>
			<option value="SK">Saskatchewan</option>
		</select></label></p>	
	<p><label>Furniture
		<select id="furniture" name="furniture">
			<option value="null">--Select Preferred Furnishing Option--</option>
			<option value="all">All</option>
			<option value="furnished">Furnished</option>
			<option value="semi-furnished">Semi-Furnished</option>
			<option value="non-furnished">Non-Furnished</option>
	</select></label></p>
	<p><label>Type
		<select id="homeType" name="homeType">
			<option value="null">--Select Preferred Housing Type--</option>
			<option value="all">All</option>
			<option value="studio">Studio</option>
			<option value="loft">Loft</option>
			<option value="apartment">Apartment</option>
			<option value="house">House</option>
			<option value="condo">Condo</option>		
	</select></label></p>
	<p><label>Bedrooms
	<select id="rooms" name="rooms">
			<option value="null">--Select Preferred Number of Rooms--</option>
			<option value="all">All</option>
			<option value="1">1 Bedroom</option>
			<option value="2">2 Bedrooms</option>
			<option value="3">3 Bedrooms</option>
			<option value="4+">4+ Bedrooms</option>	
	</select></label></p>
	
	<p><pre>Price	Minimum $<input type="text" id="minPrice" name="minPrice" size="10" />
		Maximum $<input type="text" id="maxPrice" name="maxPrice" size="10" /></pre>
	</p>
	<p><label>I prefer only available domiciles<input type ="checkbox" id="availability" name="availability" value = "yes"><br></label></p>  
	<p><label>Personal Message (Optional)<textarea rows="4" cols="50" maxlength="300" id="personalMsg" name="personalMsg"></textarea></label>
	</p>
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
	if(	isset($_POST['location']) && isset($_POST['furniture']) && isset($_POST['homeType']) && isset($_POST['rooms']) && isset($_POST['minPrice']) && isset($_POST['maxPrice']) && isset($_POST['availability'])){
	
	//Getting values from form for new user
	$location = $_POST['location'];
	$furniture = $_POST['furniture'];
	$homeType = $_POST['homeType'];
	$rooms = $_POST['rooms'];
	$minPrice = $_POST['minPrice'];
	$maxPrice = $_POST['maxPrice'];	
	$availability = $_POST['availability'];	
	$tenantPM = $_POST['personalMsg'];
	
	$email = $_SESSION['user_email'];
	$query = mysqli_query($conn,"SELECT user_id FROM users WHERE email = '$email'");

	$varID = 'user_id';
	$rows = mysqli_fetch_assoc($query);
	$userID = $rows[$varID];
		
	$newTPref = "INSERT INTO tenant_preferences (user_id,province_pref,furniture_pref,home_type_pref,bedrooms_pref,price_min,price_max,available_only,tenant_pm)
				VALUES('$userID','$location','$furniture','$homeType','$rooms',$minPrice,$maxPrice,'$availability','$tenantPM')";
				
		if (mysqli_query($conn, $newTPref)) {
			echo "<br>New record created successfully";
		} 
		else 
			echo "<br>Error. " . $newTPref . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);			
	?> 	
</body>

</html>