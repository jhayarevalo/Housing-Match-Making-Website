<!DOCTYPE html>
<html>
<head>
	<title>Rules - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
	
		<div class="titlePage">
			<h1><a href="homepage.php" id="homepage">WELCOME TO RENTAL 287</a></h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
		
	</header>
<body>
	<div id="content" class="content2" >
		<div class = "login">
		<?php 
		if ($_SESSION == true){
			echo "<h4>WELCOME $_SESSION[user_email]</h4>";
		}
		else{
			include 'includes/loginWidget.php';
		}
		?>
		</div>
		<div class ="how">
			<h4>HOW TO USE RENTAL 287</h4>
			<p>All users must register an account to access this website's features.To create an account, click
			the registration page.</p>
		</div>&nbsp;
		<div class="about">
			<h4>OUR OBJECTIVE</h4>
			<p> Here at Rental 287, we believe that there exists a home for every single customer. We are a public service
			linking tenants to owners, insuring the best possible match. We ensure quality results for every owner or tenant
			using our services. </p>
		</div><br><br><br>
	<?php if (!empty($_SESSION))
	echo "<input type=\"submit\" value=\"LOG OUT\" onclick=\"session_destroy();\"class=\"buttons\" />";?>
	</div>
	<?php include 'includes/footer.php';?>
</body>
</html>