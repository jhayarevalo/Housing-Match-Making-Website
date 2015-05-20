<!DOCTYPE html>
<html>
<head>
	<title>Search Properties - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
		<div class="titlePage">
			<h1>SEARCH FOR PROPERTIES</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id="content" class="content4">
	<div class="form">
	<h4>HOME SEARCH CRITERIA</h4>
	<form name="propertySearchForm" action="searchProperties.php" method="post">
	<p><label>Location
		<select id="location" name="location">
			<option value="null">--Select a Location--</option>
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
			<option value="null">--Select Furnishing Option--</option>
			<option value="all">All</option>
			<option value="furnished">Furnished</option>
			<option value="semi-furnished">Semi-Furnished</option>
			<option value="non-furnished">Non-Furnished</option>
	</select></label></p>
	<p><label>Type
		<select id="homeType" name="homeType">
			<option value="null">--Select Housing Type--</option>
			<option value="all">All</option>
			<option value="studio">Studio</option>
			<option value="loft">Loft</option>
			<option value="apartment">Apartment</option>
			<option value="house">House</option>
			<option value="condo">Condo</option>		
	</select></label></p>
		<p><label>Bedrooms
		<select id="rooms" name="rooms">
			<option value="null">--Select Number of Rooms--</option>
			<option value="all">All</option>
			<option value="1">1 Bedroom</option>
			<option value="2">2 Bedrooms</option>
			<option value="3">3 Bedrooms</option>
			<option value="4+">4+ Bedrooms</option>	
	</select></label></p>
	
	<p><pre>Price	Minimum $<input type="text" id="minPrice" size="10" />
		Maximum $<input type="text" id="maxPrice" size="10" /></pre>
	</p>
	<p><label>Only show available domiciles<input type ="checkbox" id="availability" value = "yes"><br /></label></p>	
	<p><input type="submit" class="buttons" value="Search" onclick="verifySearch()"/>&nbsp;&nbsp;<input type="reset" class="buttons" value="Reset"/></p>
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
	
	$query = mysqli_query($conn,"SELECT * FROM listings WHERE province = '$location' AND furniture = '$furniture' AND 
	home_type = '$homeType' AND WHERE bedrooms = '$rooms' AND WHERE price <= '$maxPrice' AND price >= '$minPrice' AND WHERE available = '$availability'" );
	
	$varID = 'user_id';
	$rows = mysqli_fetch_assoc($query);
	$userID = $rows[$varID];
	
	echo $userID;

	}
	
	mysqli_close($conn);			
	?> 	
</body>

</html>