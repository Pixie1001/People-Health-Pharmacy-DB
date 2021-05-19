<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="style.css">
 <script src="js/register.js"></script>
</head>
<body>

<div class="header">
  <img src="Rescources/PhrmLogo.PNG">
</div>

<div class="topnav">
  <a href="home.php">Manager Home Screen</a>
  <a href="inventory.php">Inventory Managemnet Screen</a>
  <a href="sales_management.php">Sales Management Screen</a>
  <a href="sales_analytics.php">Sales Analytics Screen</a>
  <a class="active" href="cash_register.php">CashRegister Screen</a>
  <a href="index.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">REGISTER</h1></div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
<h2>STOCK</h2>
<form method="post">
	<h3 class="search" >SEARCH:</h3>
	<input class="search" type="text" name="txtSearch">
	<label class="search" for="drpType">type:</label>
	<select name="drpType" id="items">
		<option value="item_name">Name</option>
		<option value="item_id">ID</option>
		<option value="item_category">Category</option>
	</select>
	<button name="btnSearch" class="search" type="submit" value="true"><img src="Rescources/search.png" width="15" height="15"></button>
</form>

<table id="stock_list">
  <tr>
    <th>Name</th>
    <th>ID</th>
    <th>CATEGORY</th>
	<th>PRICE</th>
    <th>REMAINING STOCK</th>
	<th><p style="float:right" >QUANTITY</p></th>
  </tr>
	  <?php
		if(isset($_POST['btnSearch']) && isset($_POST['txtSearch']) && isset($_POST['drpType'])) {
            Query($_POST['txtSearch'], $_POST['drpType']);
        }
		
		function Query($search, $type) {
			require_once("settings.php");
			$conn = @mysqli_connect($host, $user, $pwd, $dbname);
			switch ($type) {
				case 'item_name':
					$input = "SELECT * FROM items WHERE itemName RLIKE '$search'";
					break;
				case 'item_id':
					$input = "SELECT * FROM items WHERE itemID RLIKE '$search'";
					break;
				case 'item_category':
					$input = "SELECT * FROM items WHERE itemCategory RLIKE '$search'";
					break;
			}
			$output = mysqli_query($conn, $input);
			$i = 0;
			while ($row = mysqli_fetch_assoc($output)) {
				if ($row['hidden'] == false) {
					echo "<tr class='tuple'>";
					echo "<td>", $row['itemName'], "</td>";
					echo "<td>", $row['itemID'], "</td>";
					echo "<td>", $row['itemCategory'], "</td>";
					echo "<td>", $row['itemPrice'], "</td>";
					echo "<td>", $row['stock'], "</td>";
					echo "<td><input type='number' min='-99' max='99' style='float:right'></td>";
					echo "</tr>";
				}
			}
		}
	  ?>
  </tr>
</table>
<p><button class="button button1" style="float:right" onclick="AddItems()">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
		<form method="post" onsubmit="return ConfirmPurchase()">
			<h2>SALE</h2>
			<h3 class="search" >CUSTOMER NAME:</h3>
			<input id="customer_name" class="search" type="text" name="custName">
			<table id="cart">
				<tr>
					<th>Name</th>
					<th>ID</th>
					<th>CATEGORY</th>
					<th>PRICE</th>
					<th>QUANTITY</th>
					<th></th>
				</tr>
				<tr id="totalPrice">
					<td></td>
					<td></td>
					<td></td>
					<td id="totalPriceValue"><strong>Total: $0.00 </strong></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<p><button class="button button1" name="btnSell" type="submit" value="sell" style="float:right">SELL</button></p>
		</form>
    </div>
  </div>
</div>

<?php
	//Check for sale submissions
	if(isset($_POST['btnSell'])) {
		//echo "<p>Trigger sell function</p>";
		Sell();
	}
	
	function Sell() {
		//Read in post results as a MySQL add record query for every row.
		//Send cusName, ID, single price, quantity and current date
		//Generate a recipte number
		date_default_timezone_set('Australia/Melbourne');
		$date = date('y/m/d', time());
		$customerName = $_POST['custName'];
		
		require_once("settings.php");
		$conn = @mysqli_connect($host, $user, $pwd, $dbname);
		
		$query = "INSERT INTO receipts (customerName, orderDate) VALUES
		('$customerName', '$date');";
		
		mysqli_query($conn, $query);
		//echo "<p>", $query, "</p>";
		
		$query = "SELECT receiptID FROM receipts
		ORDER BY receiptID DESC LIMIT 1;";
		
		$output = mysqli_query($conn, $query);
		$receiptID = mysqli_fetch_assoc($output)['receiptID'];
		//echo "<p>", $query, "</p>";
		
		for ($i = 0; $i < $_POST['txtLength'] + 0; $i++) {
			//echo "<p>", $i, "</p>";
			$id = $_POST["id_" . $i];
			$quantity = $_POST['quantity_' . $i];
			$price = $_POST['price_' . $i];
			
			$query = "INSERT INTO purchases (receiptID, itemID, quantity, price) VALUES
			($receiptID, $id, $quantity, $price);";
			
			mysqli_query($conn, $query);
			
			//echo "<p>", $query, "</p>";
		}
		//Commit changes
		mysqli_query($conn, 'COMMIT;');
		
		//echo "<p>Finish commit</p>";
	}
?>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>