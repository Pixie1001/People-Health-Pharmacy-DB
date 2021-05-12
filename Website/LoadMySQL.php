 

<?php
	require_once("settings.php");
	$conn = @mysqli_connect($host, $user, $pwd);

	if (!$conn) {
		echo "<p>ERROR: Database connection failure. Please try again later.</p>";
	}
	else {
		echo "<p>Connection successful :D</p>";
	}
	
	mysqli_query($conn, 'DROP DATABASE PeoplesHealthPharmacy;');
	$input = 'CREATE DATABASE PeoplesHealthPharmacy;';
	$output = mysqli_query($conn, $input);
	
	echo "<p>", $output, "</p>";
	
	mysqli_query($conn, 'USE PeoplesHealthPharmacy;');
	mysqli_query($conn, 'SET autocommit=0;');
	
	
	$input = 'CREATE TABLE items (
		itemID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		itemName Varchar(225) NOT NULL,
		itemCategory Varchar(50) NOT NULL,
		itemPrice DECIMAL(10, 2) NOT NULL,
		stock INT NOT NULL,
		PRIMARY KEY (itemID)
	);';
	
	mysqli_query($conn, $input);
	
	$input = 'CREATE TABLE purchases ( 
		purchaseID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		receptieNumber INT UNSIGNED NOT NULL,
		customerName Varchar(225) NOT NULL,
		itemID INT UNSIGNED,
		quantity INT UNSIGNED NOT NULL,
		price DECIMAL(10, 2) NOT NULL,
		orderdate DATE NOT NULL,
		totalprice DECIMAL(10, 2) NOT NULL,
		PRIMARY KEY (purchaseID),
		FOREIGN KEY (itemID) REFERENCES item (itemID)
	);';
	
	mysqli_query($conn, $input);
	
	$input = "INSERT INTO items (itemName, itemCategory, itemPrice, stock)
	VALUES ('Soap', 'Hygiene', 5, 100), ('Fungal Cream', 'Cream', 30, 30), ('Cough Medicine', 'Medicine', 50, 85);";
	
	mysqli_query($conn, $input);
	
	$output = mysqli_query($conn, "SELECT itemName FROM items;");
	
	if (mysqli_num_rows($output) == 0) {
		echo "<p>No rows returned :(</p>";
	}
	
	while ($row = mysqli_fetch_assoc($output)) {
		echo "<p>", $row['itemName'], "</p>";
	}
	
	mysqli_query($conn, "COMMIT;");
	
	
	//$output = mysqli_query($conn, "SHOW TABLES LIKE 'item';");
	
	//echo "<p>Output: ", $output, "</p>";
	//$row = mysqli_fetch_array($output);
	//echo "<p>Output: ", $row[0], "</p>";
	
	/*
	USE PeoplesHealthPharmacy;
	SET autocommit=0;

	CREATE TABLE customer (
		customerID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		firstName VARCHAR(255) NOT NULL,
		lastName VARCHAR(255) NOT NULL,
		DOB DATE NOT NULL,
		PRIMARY KEY (customerID)
	);

	CREATE TABLE item (
		itemID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		itemName Varchar(225) NOT NULL,
		itemPrice DECIMAL(10, 2) NOT NULL,
		stock INT NOT NULL,
		PRIMARY KEY (itemID)
	);

	CREATE TABLE purchase ( 
		purchaseID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		customerID INT UNSIGNED,
		itemID INT UNSIGNED,
		quantity INT UNSIGNED NOT NULL,
		price DECIMAL(10, 2) NOT NULL,
		orderdate DATE NOT NULL,
		totalprice DECIMAL(10, 2) NOT NULL,
		PRIMARY KEY (purchaseID),
		FOREIGN KEY (customerID) REFERENCES customer (customerID),
		FOREIGN KEY (itemID) REFERENCES item (itemID)
	);

	CREATE TABLE user (
		username varchar(255) NOT NULL,
		displayname varchar(255) NOT NULL,
		userpasscode varchar(255) NOT NULL,
		PRIMARY KEY (username)
	);
	*/
?>