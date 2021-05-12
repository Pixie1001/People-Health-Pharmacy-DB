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
<h3 class="search" >SEARCH:</h3>
<input class="search" type="text" id="fname" name="fname">
<label class="search" for="items">type:</label>
  <select name="items" id="items">
    <option value="item_name">Name</option>
    <option value="item_id">ID</option>
    <option value="item_category">Category</option>
  </select>
<button class="search" type="button" onclick="QueryStock()"><img src="Rescources/search.png" width="15" height="15"></button>



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
	  	//$query = mysql_query("SELECT Name, MATCHFIELD FROM `employes` WHERE `Name` LIKE '%$keyword%' || `Prenom` LIKE '%$keyword%' || `Telephone` LIKE '%$keyword%' || `Telephone2` LIKE '%$keyword%'");
		require_once("settings.php");
		$conn = @mysqli_connect($host, $user, $pwd, $dbname);
		$input = "SELECT * FROM items WHERE itemName LIKE", $words;
		$output = mysqli_query($conn, "SELECT * FROM items;");
		$i = 0;
		while ($row = mysqli_fetch_assoc($output)) {
			echo "<tr id='tuple_#", $i, "'>";
			echo "<td>", $row['itemName'], "</td>";
			echo "<td>", $row['itemID'], "</td>";
			echo "<td>", $row['itemCategory'], "</td>";
			echo "<td>", $row['itemPrice'], "</td>";
			echo "<td>", $row['stock'], "</td>";
			echo "<td><input type='text' style='float:right' id='fname' name='fname'></td>";
			echo "</tr>";
			$i++;
		}
	  ?>
  </tr>
  <!--
  <tr>
    <td>Fungal Cream</td>
    <td>FC</td>
    <td>Creams</td>
	<td>$30</td>
	<td>12</td>
	<td> <input type="text" style="float:right" id="fname" name="fname"></td>
  </tr>
  <tr>
    <td>Lip Cream</td>
    <td>LC</td>
    <td>Creams</td>
	<td>$80</td>
	<td>3</td>
	<td><input type="text"  style="float:right" id="fname" name="fname"></td>
  </tr>
  -->
</table>
<p><button class="button button1" style="float:right" onclick="alert('Hello world!')">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
		<h2>SALE</h2>

		<h3 class="search" >CUSTOMER NAME:</h3>
		<input id="customer_name" class="search" type="text" id="fname" name="fname">

		<table>
		  <tr>
			<th>Name</th>
			<th>ID</th>
			<th>CATEGORY</th>
			<th>PRICE</th>
			<th>QUANTITY</th>
			<th></th>
		  </tr>
		  <tr>
			<td>Fungle Cream</td>
			<td>FC</td>
			<td>Creams</td>
			<td>$30</td>
			<td>12</td>
			<td><button class="search" type="button" onclick="alert('you searched something!')"><img src="Rescources/trash.jpg" width="30" height="30"></button></td>
		  </tr>
			<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Total: $360</td>
			<td></td>
			<td></td>
		  </tr>
		</table>
		<p><button class="button button1" style="float:right" onclick="alert('Hello world!')">SELL</button></p>
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>