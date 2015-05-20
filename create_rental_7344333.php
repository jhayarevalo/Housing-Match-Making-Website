<?php
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";

//Creating the connection to the server
$conn = new mysqli($dbserver, $dbuser, $dbpass);

//Displaying connection results
if ($conn->connect_error) {
	die("Connection unsuccessful: ".$conn->connect_error);
}
else
	echo "Connected successfully";

//----------Creating the database for Rental287 website
$dbName = "rental_7344333";
$createDB = "CREATE DATABASE $dbName";
if ($conn->query($createDB) === TRUE){
	echo "<br>Database '".$dbName."' was created successfully";
}
else
	echo "<br>Error: ".$conn->error;

//Connecting to database rental287
$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbName);
echo "<br>Checking new connection: ";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else
	echo "New connection is good.";

//----------Creating users table inside rental287 database
$createUsers = "CREATE TABLE users
(user_id INT(11) UNSIGNED AUTO_INCREMENT,
first_name VARCHAR(255) NOT NULL,
last_name VARCHAR(255) NOT NULL,
user_type ENUM ('tenant', 'owner') NOT NULL DEFAULT 'tenant',
phone VARCHAR (13) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
PRIMARY KEY(user_id))";

if (mysqli_query($conn, $createUsers)) {
    echo "<br>Table 'users' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating table of all home listings
$createListing = "CREATE TABLE listings
(listing_id INT (11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
title VARCHAR(255) NOT NULL,
address VARCHAR(255) NOT NULL,
city VARCHAR(255) NOT NULL,
postal_code VARCHAR(7) NOT NULL,
province ENUM ('AB','BC','MB','NB','NL','NS','ON','PE','QC','SK') NOT NULL,
furniture ENUM ('furnished','semi-furnished','non-furnished') NOT NULL,
home_type ENUM ('studio','loft','apartment','house','condo') NOT NULL,
bedrooms ENUM ('1','2','3','4+') NOT NULL,
price INT(11) NOT NULL,
available ENUM ('yes','no') NOT NULL,
owner_pm TEXT(300),
PRIMARY KEY(listing_id))";

if (mysqli_query($conn, $createListing)) {
    echo "<br>Table 'listings' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating table for tenant preferences
$createTPref = "CREATE TABLE tenant_preferences
(tpref_id INT(11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
province_pref ENUM ('all','AB','BC','MB','NB','NL','NS','ON','PE','QC','SK') NOT NULL DEFAULT 'all',
furniture_pref ENUM ('all','furnished','semi-furnished','non-furnished') NOT NULL DEFAULT 'all',
home_type_pref ENUM ('all','studio','loft','apartment','house','condo') NOT NULL DEFAULT 'all',
bedrooms_pref ENUM ('all','1','2','3','4+') NOT NULL DEFAULT 'all',
price_min INT(11) NOT NULL,
price_max INT(11) NOT NULL,
available_only VARCHAR(3),
tenant_pm TEXT(300),
PRIMARY KEY(tpref_id))";

if (mysqli_query($conn, $createTPref)) {
    echo "<br>Table 'tenant_preferences' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating table for tenant details 
$createTDetails = "CREATE TABLE tenant_details
(tdetails_id INT(11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
pets ENUM ('yes','no') NOT NULL,
smoking ENUM ('yes','no') NOT NULL,
vehicles ENUM ('0','1','2','3+') NOT NULL,
occupants ENUM ('1','2','3','4+') NOT NULL,
age INT(11) NOT NULL,
empl_status ENUM ('student','fulltime','parttime','unemployed','retired') NOT NULL,
lvl_income ENUM ('low','mid-low','mid','mid-high','high') NOT NULL,
PRIMARY KEY(tdetails_id))";

if (mysqli_query($conn, $createTDetails)) {
    echo "<br>Table 'tenant_details' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating table for owner preferences
$createOPref = "CREATE TABLE owner_preferences
(opref_id INT(11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
pets_allowed ENUM ('yes','no') NOT NULL,
smoking_allowed ENUM ('yes','no') NOT NULL,
max_vehicles ENUM ('0','1','2','3+') NOT NULL,
max_occupants ENUM ('1','2','3','4+') NOT NULL,
age_min INT(11) NOT NULL,
age_max INT(11) NOT NULL,
empl_status ENUM ('student','fulltime','parttime','unemployed','retired','any') NOT NULL,
lvl_income ENUM ('low','mid-low','mid','mid-high','high','any') NOT NULL,
PRIMARY KEY(opref_id))";

if (mysqli_query($conn, $createOPref)) {
    echo "<br>Table 'owner_preferences' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating the table of the ranking of all owners for the tenants (tenants' owner rank table)
$createTRanksO = "CREATE TABLE tenant_ranks_owners
(trank_id INT(11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
ranking_owners VARCHAR(255) NOT NULL,
PRIMARY KEY(trank_id))";

if (mysqli_query($conn, $createTRanksO)) {
    echo "<br>Table 'tenant_ranks_owners' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	

//----------Creating the table of the ranking of all tenants for the owners (owners' tenant rank table)
$createORanksT = "CREATE TABLE owner_ranks_tenants
(orank_id INT(11) UNSIGNED AUTO_INCREMENT,
user_id INT(11) NOT NULL,
ranking_tenants VARCHAR(255) NOT NULL,
PRIMARY KEY(orank_id))";

if (mysqli_query($conn, $createORanksT)) {
    echo "<br>Table 'owner_ranks_tenants' created successfully.";
}
else
    echo "<br>Error: " . mysqli_error($conn);	


//----------Creating 5 tenants to test matching algo
//==TENANT 1 REGISTRATION INFO
$tenant1 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Ali','Anderson','tenant','(111)111-1111','aa@gmail.com',md5('123456a'))";
//---Tenant1 Ranking of owners
$tenant1RANK = "INSERT INTO tenant_ranks_owners (user_id,ranking_owners)
VALUES(1,'3,2,5,1,4')";
if(mysqli_query($conn, $tenant1) && mysqli_query($conn, $tenant1RANK))
	echo "<br>Tenant 1 created successfully";
else 
	echo "<br>Error. " . $tenant1 . " and " . $tenant1RANK . "<br>" . mysqli_error($conn);

//==TENANT 2 REGISTRATION INFO
$tenant2 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Bob','Barkley','tenant','(222)222-2222','bb@gmail.com',md5('123456b'))";
//---Tenant2 Ranking of owners
$tenant2RANK = "INSERT INTO tenant_ranks_owners (user_id,ranking_owners)
VALUES(2,'1,2,5,3,4')";
if(mysqli_query($conn, $tenant2) && mysqli_query($conn, $tenant2RANK))
	echo "<br>Tenant 2 created successfully";
else 
	echo "<br>Error. " . $tenant2 . " and " . $tenant2RANK . "<br>" . mysqli_error($conn);

//==TENANT 3 REGISTRATION INFO
$tenant3 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Carl','Clooney','tenant','(333)333-3333','cc@gmail.com',md5('123456c'))";
//---Tenant3 Ranking of owners
$tenant3RANK = "INSERT INTO tenant_ranks_owners (user_id,ranking_owners)
VALUES(3,'4,3,2,1,5')";
if(mysqli_query($conn, $tenant3) && mysqli_query($conn, $tenant3RANK))
	echo "<br>Tenant 3 created successfully";
else 
	echo "<br>Error. " . $tenant3 . " and " . $tenant3RANK . "<br>" . mysqli_error($conn);

//==TENANT 4 REGISTRATION INFO
$tenant4 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Dom','Darling','tenant','(444)444-4444','dd@gmail.com',md5('123456d'))";
//---Tenant4 Ranking of owners
$tenant4RANK = "INSERT INTO tenant_ranks_owners (user_id,ranking_owners)
VALUES(4,'1,3,4,2,5')";
if(mysqli_query($conn, $tenant4) && mysqli_query($conn, $tenant4RANK))
	echo "<br>Tenant 4 created successfully";
else 
	echo "<br>Error. " . $tenant4 . " and " . $tenant4RANK . "<br>" . mysqli_error($conn);

//==TENANT 5 REGISTRATION INFO
$tenant5 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Eric','Eary','tenant','(555)555-5555','ee@gmail.com',md5('123456e'))";
//---Tenant5 Ranking of owners
$tenant5RANK = "INSERT INTO tenant_ranks_owners (user_id,ranking_owners)
VALUES(5,'1,2,4,5,3')";
if(mysqli_query($conn, $tenant5) && mysqli_query($conn, $tenant5RANK))
	echo "<br>Tenant 5 created successfully";
else 
	echo "<br>Error. " . $tenant5 . " and " . $tenant5RANK . "<br>" . mysqli_error($conn);

//----------Creating 5 owners to test matching algo
//==Owner 1 REGISTRATION INFO
$owner1 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Fred','Fiddle','owner','(666)666-6666','ff@gmail.com',md5('123456f'))";
//--Owner1 Ranking of tenants
$owner1RANK = "INSERT INTO owner_ranks_tenants (user_id,ranking_tenants)
VALUES(6,'3,5,2,1,4')";
if(mysqli_query($conn, $owner1) && mysqli_query($conn, $owner1RANK))
	echo "<br>Owner 1 created successfully";
else 
	echo "<br>Error. " . $owner1 . " and " . $owner1RANK . "<br>" . mysqli_error($conn);

//==Owner 2 REGISTRATION INFO
$owner2 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('George','Gillian','owner','(777)777-7777','gg@gmail.com',md5('123456g'))";
//--Owner2 Ranking of tenants
$owner2RANK = "INSERT INTO owner_ranks_tenants (user_id,ranking_tenants)
VALUES(7,'5,2,1,4,3')";
if(mysqli_query($conn, $owner2) && mysqli_query($conn, $owner2RANK))
	echo "<br>Owner 2 created successfully";
else 
	echo "<br>Error. " . $owner2 . " and " . $owner2RANK . "<br>" . mysqli_error($conn);

//==Owner 3 REGISTRATION INFO
$owner3 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Hyde','Hellner','owner','(888)888-8888','hh@gmail.com',md5('123456h'))";
//--Owner3 Ranking of tenants
$owner3RANK = "INSERT INTO owner_ranks_tenants (user_id,ranking_tenants)
VALUES(8,'4,3,5,1,2')";
if(mysqli_query($conn, $owner3) && mysqli_query($conn, $owner3RANK))
	echo "<br>Owner 3 created successfully";
else 
	echo "<br>Error. " . $owner3 . " and " . $owner3RANK . "<br>" . mysqli_error($conn);

//==Owner 4 REGISTRATION INFO
$owner4 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Ilana','Iancu','owner','(999)999-9999','ii@gmail.com',md5('123456i'))";
//--Owner4 Ranking of tenants
$owner4RANK = "INSERT INTO owner_ranks_tenants (user_id,ranking_tenants)
VALUES(9,'1,2,3,4,5')";
if(mysqli_query($conn, $owner4) && mysqli_query($conn, $owner4RANK))
	echo "<br>Owner 4 created successfully";
else 
	echo "<br>Error. " . $owner4 . " and " . $owner4RANK . "<br>" . mysqli_error($conn);

//==Owner 5 REGISTRATION INFO
$owner5 = "INSERT INTO users(first_name,last_name,user_type,phone,email,password)
VALUES('Jillian','Jonas','owner','(101)010-1010','jj@gmail.com',md5('123456j'))";
//--Owner5 Ranking of tenants
$owner5RANK = "INSERT INTO owner_ranks_tenants (user_id,ranking_tenants)
VALUES(10,'2,3,4,1,5')";
if(mysqli_query($conn, $owner5) && mysqli_query($conn, $owner5RANK))
	echo "<br>Owner 5 created successfully";
else 
	echo "<br>Error. " . $owner5 . " and " . $owner5RANK . "<br>" . mysqli_error($conn);

$conn->close();

?>	
