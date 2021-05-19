<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <img src="Rescources/PhrmLogo.PNG">
</div>

<div class="topnav">
  <a class="active" href="home.php">Manager Home Screen</a>
  <a href="inventory.php">Inventory Managemnet Screen</a>
  <a href="sales_management.php">Sales Management Screen</a>
  <a href="sales_analytics.php">Sales Analytics Screen</a>
  <a href="cash_register.php">CashRegister Screen</a>
  <a href="index.php" style="float:right">Logout</a>
</div>

<div class="row">
  <div class="centercolumn">
    <div class="card">
  <p>Username:</p> <input type="text" id="fname" name="fname" value="ID"><br>
  <p>Password:</p> <input type="text" id="fname" name="fname" value="###"><br>
  <br>
  <button type="button" onclick="alert('You have tried to log in')">Login</button>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>

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
		hidden bool NOT NULL DEFAULT false,
		PRIMARY KEY (itemID)
	);';
	
	mysqli_query($conn, $input);
	
	$input = 'CREATE TABLE receipts  ( 
		receiptID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		customerName Varchar(225) NOT NULL,
		orderDate DATE NOT NULL,
		PRIMARY KEY (receiptID)
	);';
	
	mysqli_query($conn, $input);
	
	$input = 'CREATE TABLE purchases ( 
		purchaseID INT UNSIGNED AUTO_INCREMENT NOT NULL,
		receiptID INT UNSIGNED NOT NULL,
		itemID INT UNSIGNED,
		quantity INT UNSIGNED NOT NULL,
		price DECIMAL(10, 2) NOT NULL,
		PRIMARY KEY (purchaseID),
		FOREIGN KEY (itemID) REFERENCES items (itemID),
		FOREIGN KEY (receiptID) REFERENCES receipts  (receiptID)
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
?>