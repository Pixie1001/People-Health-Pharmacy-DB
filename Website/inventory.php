<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="style.css">
 <script src="js/inventory.js"></script>
</head>
<body>

<div class="header">
  <img src="Rescources/PhrmLogo.PNG">
</div>

<div class="topnav">
  <a href="home.php">Manager Home Screen</a>
  <a class="active" href="inventory.php">Inventory Managemnet Screen</a>
  <a href="sales_management.php">Sales Management Screen</a>
  <a href="sales_analytics.php">Sales Analytics Screen</a>
  <a href="cash_register.php">CashRegister Screen</a>
  <a href="login.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">INVENTORY</h1></div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
		<form method="post">
			<h2>STOCK</h2>
			<h3 class="search" >SEARCH:</h3>
			<input class="search" type="text" name="txtSearch">
			<label class="search" for="drpType">type:</label>
			<select name="drpType">
				<option value="item_name">Name</option>
				<option value="item_id">ID</option>
				<option value="item_category">Category</option>
			</select>
			<button class="search" type="submit" name="btnSearch" value="search"><img src="Rescources/search.png" width="15" height="15"></button>
		</form>
		
		<table>
		  <tr>
			<th>Name</th>
			<th>ID</th>
			<th>CATEGORY</th>
			<th>PRICE</th>
			<th>REMAINING STOCK</th>
			<th><p style="float:right" >QUANTITY</p></th>
			<th></th>
			<th></th>
		  </tr>
			  <?php
				if(isset($_POST['btnSearch']) && isset($_POST['txtSearch']) && isset($_POST['drpType'])) {
					//echo "<p>Check working</p>";
					Query($_POST['txtSearch'], $_POST['drpType']);
				}
				
				if(isset($_POST['deleteItem'])) {
					//echo "<p>Call Delete</p>";
					DeleteItem($_POST['deleteItem']);
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
					while ($row = mysqli_fetch_assoc($output)) {
						if ($row['hidden'] == false) {
							echo "<tr class='tuple'>";
							echo "<td>", $row['itemName'], "</td>";
							echo "<td>", $row['itemID'], "</td>";
							echo "<td>", $row['itemCategory'], "</td>";
							echo "<td>", $row['itemPrice'], "</td>";
							echo "<td>", $row['stock'], "</td>";
							echo "<td><input type='number' min='-99' max='99' style='float:right'></td>";
							echo "<td><form onSubmit='return RemoveItem(", $row['itemID'], ")' method='post'><button class='search' type='submit'><img src='Rescources/trash.jpg' width='30' height='30'></form></td>";
							echo "<td><button class='search' type='button' onClick='EditItem(", $row['itemID'], ")'><img src='Rescources/edit.png' width='30' height='30'></td>";
							echo "</tr>";
						}
					}
				}
				
				function DeleteItem($itemID) {
					require_once("settings.php");
					$conn = @mysqli_connect($host, $user, $pwd, $dbname);
					$query = "UPDATE items SET hidden=true WHERE itemID=$itemID;";
					mysqli_query($conn, $query);
					//echo "<p>Finish delete for $itemID</p>";
				}
			  ?>
		</table>
		<p><button class="button button1" style="float:right" onclick="alert('Hello world!')">REMOVE</button></p>
		<p><button class="button button1" style="float:right" onclick="alert('Hello world!')">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
<h2>ADD/EDIT STOCK ITEM</h2>

 <p>ITEM: <input type="text" id="inpName" name="fname" value="ID"></p> 
 <p>ID: <input type="text" id="inpID" name="fname" value="###"></p> 
 <p>PRICE: <input type="text" id="inpPrice" name="fname" value="ID"></p> 
 <p>CATEGORY: <input type="text" id="inpCategory" name="fname" value="###"></p> 
<p><button class="button button1" onclick="alert('Hello world!')">UPDATE</button></p>
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>