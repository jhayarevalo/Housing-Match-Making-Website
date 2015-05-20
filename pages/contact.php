<!DOCTYPE html>
<html>
<head>
	<title>About Us - Rental 287</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="Author" content="Jhayzle Arevalo" />
	<meta name="Keywords" content="Rental Matching Market, Assignment 3"/>
</head>
	<header>
		<div class="titlePage">
			<h1>CONTACT US</h1>
		</div>
		<?php 
		include 'includes/login.php';
		if($_SESSION == true)
		include 'includes/menu.php';
		?>
	</header>
<body>
	<div id="content" class="content8" >
	<div class="form2">
		<h4 class="sendEmail">SEND US AN E-MAIL</h4>
		<form name="contact" action="#">
			<p><label>Your name <input type="text" id="name" name="name"/></label></p> 
			<p><label>Your email <input type="text" id="email" name="email"></label></p>
			<p><label>Your message <textarea id="message" name="message" rows="7" cols="30"></textarea></label></p>
	<p><input type="submit" class="buttons" value="Send"/>&nbsp;&nbsp;<input type="reset" class="buttons" value="Reset"/></p>
		</form>				
	</div>
	</div>
	<?php include 'includes/footer.php';?>
</body>

</html>