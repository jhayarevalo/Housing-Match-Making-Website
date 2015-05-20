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
			<h1>LIST A PROPERTY</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id="content" class="content5" >
	<div class="form">
	<h4>PROPERTY DETAILS</h4>
	<form name="propertySearchForm" action="listProperties.php" method="post">
	<p><label>Title of ad <input type="text" id="titleAd" name="titleAd"/></label></p>
	<p><label>Street Address<input type="text" id="streetAddress" name="streetAddress"/></label>&nbsp;City<label><input type="text" id="city" name="city" /></label></p>
	<p><label>Postal Code<input type="text" id="postalCode" name="postalCode"size="8"/></label>&nbsp;<label>Province
		<select id="location" name="location">
			<option value="null">--Select a Location--</option>
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
		</select>
		</label></p>	
	<p><label>Furniture
		<select id="furniture" name="furniture">
			<option value="null">--Select Furnishing of Listing--</option>
			<option value="furnished">Furnished</option>
			<option value="semi-furnished">Semi-Furnished</option>
			<option value="non-furnished">Non-Furnished</option>
	</select></label></p>
	<p><label>Type
		<select id="homeType" name="homeType">
			<option value="null">--Select Housing Type--</option>
			<option value="studio">Studio</option>
			<option value="loft">Loft</option>
			<option value="apartment">Apartment</option>
			<option value="house">House</option>
			<option value="condo">Condo</option>		
	</select></label></p>
		<p><label>Bedrooms
		<select id="rooms" name="rooms">
			<option value="null">--Select Number of Rooms--</option>
			<option value="1">1 Bedroom</option>
			<option value="2">2 Bedrooms</option>
			<option value="3">3 Bedrooms</option>
			<option value="4+">4+ Bedrooms</option>	
	</select></label></p>
	
	<p><label>Price $<input type="text" id="price" size="10" /></label></p>
	<p>Availability for rental
	<input type ="radio" name="availability" value = "yes">Yes
	<input type ="radio" name="availability" value = "no">No<br /></p>	

	<p><label>Personal Message (Optional)<textarea rows="4" cols="50" maxlength="300" id="personalMsg" name="personalMsg"></textarea></label></p>
	
	<p><input type="submit" class="buttons" value="Submit"/>&nbsp;&nbsp;<input type="reset" class="buttons" value="Reset"/></p>
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
	if(	isset($_POST['titleAd']) && isset($_POST['streetAddress']) && isset($_POST['city']) && isset($_POST['postalCode']) && isset($_POST['location']) && isset($_POST['furniture']) && isset($_POST['homeType'])
		&& isset($_POST['rooms']) && isset($_POST['price']) && isset($_POST['availability'])){
	
	//Getting values from form for new user
	$titleAd = $_POST['titleAd'];
	$streetAddress = $_POST['streetAddress'];
	$city = $_POST['city'];
	$postalCode = $_POST['postalCode'];
	$location = $_POST['location'];
	$furniture = $_POST['furniture'];
	$homeType = $_POST['homeType'];
	$rooms = $_POST['rooms'];
	$price = $_POST['price'];
	$availability = $_POST['availability'];	
	$ownerPM = $_POST['personalMsg'];
	
	$email = $_SESSION['user_email'];
	$query = mysqli_query($conn,"SELECT user_id FROM users WHERE email = '$email'");

	$varID = 'user_id';
	$rows = mysqli_fetch_assoc($query);
	$userID = $rows[$varID];
		
	$newListing = "INSERT INTO listings (user_id,title,address,city,postal_code,province,furniture,home_type,bedrooms,price,available,owner_pm)
				VALUES('$titleAd','$streetAddress','$city','$postalCode','$location','$furniture','$homeType','$rooms','$price','$availability','$ownerPM')";
				
		if (mysqli_query($conn, $newListing)) {
			echo "<br>New record created successfully";
		} 
		else 
			echo "<br>Error. " . $newListing . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);			
	?> 	
</body>

</html>