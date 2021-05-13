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
  <a href="home.html">Manager Home Screen</a>
  <a href="inventory.html">Inventory Managemnet Screen</a>
  <a href="sales_management.html">Sales Management Screen</a>
  <a href="sales_analytics.html">Sales Analytics Screen</a>
  <a class="active" href="cash_register.html">CashRegister Screen</a>
  <a href="login.html" style="float:right">Logout</a>
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
	  ?>
  </tr>
</table>
<p><button class="button button1" style="float:right" onclick="AddItems()">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
		<form method="post">
			<h2>SALE</h2>
			<h3 class="search" >CUSTOMER NAME:</h3>
			<input id="customer_name" class="search" type="text" id="fname" name="fname">
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
					<td><strong>Total: $0.00</strong></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<p><button class="button button1" name="btnSell" type="submit" value="sell" style="float:right" onclick="ConfirmPurchase()">SELL</button></p>
		</form>
    </div>
  </div>
</div>

<?php
	//Add second field that confirms that input is valid
	if(isset($_POST['btnSell']) && isset($_POST['validSale'])) {
		echo "<p>Post detected</p>";
		Sell();
	}
	
	function Sell() {
		// $doc = new DOMDocument();
		// $doc->loadHTMLFile("cash_register.php");
		// $name = 
		// $div = $dochtml->getElementById('div2')->nodeValue;
		if (isset($_POST['test'])) {
			$name = $_POST['test'];
			echo "<p>", $name, "<p/>";
		}
		else {
			echo "<p>Test failed :(<p/>";
		}
		
		//Process sell
	}
?>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>