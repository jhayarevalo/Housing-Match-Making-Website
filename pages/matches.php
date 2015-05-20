<!DOCTYPE html>
<html>
<head>
<title> Home - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
	
		<div class="titlePage">
			<h1><a href="homepage.php" id="homepage">MATCHING RESULTS</a></h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
		
	</header>
<body>
<div class = "matching">
<?php

//Making the arrays from the databases
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbName = "rental_7344333";

//Connecting to database rental_7344333
$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbName);

//Displaying Values for a Tenant's ID and their ranking of all Owners
$queryT = mysqli_query($conn,"SELECT * FROM tenant_ranks_owners ORDER BY trank_id ASC");
$queryTname = mysqli_query($conn,"SELECT * FROM users WHERE user_type = 'tenant' ORDER BY user_id ASC");

$tenantIndex = 'trank_id';
$TuserID = 'user_id';
$tenantRanks = 'ranking_owners';
$rowsT = mysqli_fetch_assoc($queryT);

$rowsTname = mysqli_fetch_assoc($queryTname);
$fNameT = 'first_name';
$lNameT = 'last_name';
$userID = 'user_id';

echo "==============================" . "<br>" . "ALL TENANTS" . "<br>" . "==============================" . "<br>"; 
do{
	echo "User ID: " . $rowsTname[$userID] . "<br>" . 
	"Name: " . $rowsTname[$fNameT] . " " . $rowsTname[$lNameT] . "<br>" . "----------" . "<br>";
}while ($rowsTname = mysqli_fetch_assoc($queryTname));

do{
	echo "User ID: " . $rowsT[$TuserID] . "<br>" . 
	"Tenant ID: " . $rowsT[$tenantIndex] . "<br>" .
	"Given Ranking of Owners: " . $rowsT[$tenantRanks] . "<br>" . "----------" . "<br>";
}while($rowsT = mysqli_fetch_assoc($queryT));

//Displaying Values for an Owner's ID and their ranking of all Tenants
$queryO = mysqli_query($conn,"SELECT * FROM owner_ranks_tenants ORDER BY orank_id ASC");
$queryOname = mysqli_query($conn,"SELECT * FROM users WHERE user_type = 'owner' ORDER BY user_id ASC");

$ownerIndex = 'orank_id';
$OuserID = 'user_id';
$ownerRanks = 'ranking_tenants';
$rowsO = mysqli_fetch_assoc($queryO);

$rowsOname = mysqli_fetch_assoc($queryOname);
$fNameO = 'first_name';
$lNameO = 'last_name';
$userID = 'user_id';

echo "==============================" . "<br>" . "ALL OWNERS" . "<br>" . "==============================" . "<br>"; 
do{
	echo "User ID: " . $rowsOname[$userID] . "<br>" . 
	"Name: " . $rowsOname[$fNameO] . " " . $rowsOname[$lNameO] . "<br>" . "----------" . "<br>";
}while ($rowsOname = mysqli_fetch_assoc($queryOname));

do{
	echo "User ID: " . $rowsO[$TuserID] . "<br>" . 
	"Tenant ID: " . $rowsO[$ownerIndex] . "<br>" .
	"Given Ranking of Owners: " . $rowsO[$ownerRanks] . "<br>" . "----------" . "<br>";
}while($rowsO = mysqli_fetch_assoc($queryO));


echo "==============================" . "<br>" . "MATCHING" . "<br>" . "==============================" . "<br>"; 

//Will be hardcoded due to bad time management/lack of knowledge on making arrays with database 
		$tenant = array(
		array(0, 3, 2, 5, 1, 4), 
		array(0, 1, 2, 5, 3, 4), 
		array(0, 4, 3, 2, 1, 5), 
		array(0, 1, 3, 4, 2, 5), 
		array(0, 1, 2, 4, 5, 3)
		);
		
		$owner = array(
		array(0, 3, 5, 2, 1, 4), 
		array(0, 5, 2, 1, 4, 3), 
		array(0, 4, 3, 5, 1, 2),
		array(0, 1, 2, 3, 4, 5), 
		array(0, 2, 3, 4, 1, 5)
		);

		global $someoneWasRejected;
		
		$rank = 1;
		do{

			$someoneWasRejected = false;
			for ($i = 0; $i < 5; $i++){

				while($tenant[$i][$rank] < 0)
					$rank++;

				$currentOwnerIndex = $tenant[$i][$rank]-1;		
				$currentOwner = $tenant[$i][$rank];
				$currentOwnerMatch = $owner[$currentOwnerIndex][0];


				echo "<br>---Currently looking at Tenant" . ($i+1) . " & Owner" . $currentOwner . "<br>Tenant: ";
				for($inside = 0; $inside < 6; $inside++)
					echo $tenant[$i][$inside] . ", ";
				echo "and <br>Owner: ";
				for($inside = 0; $inside <6; $inside++)
					echo $owner[$currentOwnerIndex][$inside] . ", ";
				echo "<br>";

				if($tenant[$i][0] != 0 ){
					echo "<br>Tenant" . ($i+1) . " is matched with Owner" . $tenant[$i][0] . "<br>";
				}

				else if ($currentOwnerMatch == 0){
					echo "<br>Owner" . $currentOwner . " has no current match: ";
					$owner[$currentOwnerIndex][0] = ($i+1);
					$tenant[$i][0] = $currentOwner;
					echo "Owner" . $currentOwner . " is now matched to Tenant" . $owner[$currentOwnerIndex][0] . "<br>";
				}

				else if (getRank($i+1,$owner[$currentOwnerIndex]) < getRank($currentOwnerMatch, $owner[$currentOwnerIndex])){
					echo "<br>Owner" . $currentOwner . " is currently matched to Tenant" . $currentOwnerMatch .
					"<br>Tenant" . ($i+1) . "'s rank index is smaller than Tenant" . $currentOwnerMatch . "'s in Owner" . $currentOwner . "<br>";
					
					$tenant[$currentOwnerMatch-1][0] = 0;

					echo "<br>Tenant" . $currentOwnerMatch . " match is reset to " . $tenant[$currentOwnerMatch-1][0]
							. "<br>Tenant" . $currentOwnerMatch . " crosses off Owner" . $currentOwner;
					
					$tenant[$currentOwnerMatch-1][ getRank($currentOwner, $tenant[$currentOwnerMatch-1])] = -1;
					
					echo "<br>Contents of Tenant" . $currentOwnerMatch . ":";
					
					for($inside = 0; $inside < 6; $inside++)
						echo $tenant[$currentOwnerMatch-1][$inside] . ", ";
					$owner[$currentOwnerIndex][0] = $i+1;
					
					echo "<br>Owner" . $currentOwnerMatch . " new match is Tenant" . ($i+1);
					
					$tenant[$i][0] = $currentOwner;
					
					echo "<br>Tenant" . ($i+1) . " new match is Owner" . $tenant[$i][0] . "<br>";

					$someoneWasRejected = true;
				}

				else{
					echo "<br>Tenant" . ($i+1) . " was not matched to anyone.";
					$tenant[$i][ getRank($currentOwner, $tenant[$i])] = -1;
					echo "<br>Contents of Tenant" . ($i+1) . ": <br>" ;
					
					for($inside = 0; $inside < 6; $inside++)
						echo $tenant[$i][$inside] . ", ";
					echo "<br>";
					$someoneWasRejected = true;
				}

			}

		}while($someoneWasRejected === true);?>
		<section>
		<?php echo "<br>Processing..." . "<br>==============================" . "<br>" . "RESULTS" . "<br>" . "==============================" . "<br>";
		for($i = 0; $i < 5; $i++){ 
			echo "Match for Owner " . ($i+1) . ": Tenant " . $owner[$i][0] . "<br>";
		}
		echo "----------------------------------------<br>";
		for($i = 0; $i < 5; $i++){ 
			echo "Match for Tenant " . ($i+1) . ": Owner " . $tenant[$i][0] . "<br>";
		}
		
	
	function getRank($value, $rankPosition){
		$rank = 0;
		for($i = 1; $i < 6; $i++){
			if($value == $rankPosition[$i])
				$rank = $i;
		}
		return $rank;
	}
	?></section>
	</div>
	<?php include 'includes/footer.php';?>
</body>
</html>