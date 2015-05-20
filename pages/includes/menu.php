<?php
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbName = "rental_7344333";

//Connecting to database rental_7344333
$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbName);
$email = $_SESSION['user_email'];
$query = mysqli_query($conn,"SELECT user_type FROM users WHERE email = '$email'");

$userTYPE = 'user_type';
$rows = mysqli_fetch_assoc($query);
$accountTYPE = $rows[$userTYPE];

if($accountTYPE == 'tenant')
	include 'includes/tenantMenu.php';

else if ($accountTYPE == 'owner')
	include 'includes/ownerMenu.php';

else
	include 'includes/defaultMenu.php';

?>