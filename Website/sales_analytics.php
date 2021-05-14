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
  <a href="home.php">Manager Home Screen</a>
  <a href="inventory.php">Inventory Managemnet Screen</a>
  <a href="sales_management.php">Sales Management Screen</a>
  <a class="active" href="sales_analytics.php">Sales Analytics Screen</a>
  <a href="cash_register.php">CashRegister Screen</a>
  <a href="login.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">INVENTORY</h1></div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
<h2>STOCK</h2>
<h3 class="search" >SEARCH:</h3>
<input class="search" type="text" id="fname" name="fname">
<label class="search" for="cars">type:</label>
  <select name="cars" id="cars">
    <option value="item_name">Name</option>
    <option value="item_id">ID</option>
    <option value="item_category">Category</option>
  </select>
<button class="search" type="button" onclick="alert('you searched something!')"><img src="Rescources/search.png" width="15" height="15"></button>

<table>
  <tr>
    <th>Name</th>
    <th>ID</th>
    <th>CATEGORY</th>
	<th>PRICE</th>
    <th>REMAINING STOCK</th>
	<th><p style="float:right" >QUANTITY</p></th>
	<th></th>
  </tr>
  <tr>
    <td>Fungal Cream</td>
    <td>FC</td>
    <td>Creams</td>
	<td>$30</td>
	<td>12</td>
	<td> <input type="text" style="float:right" id="fname" name="fname"></td>
	<td><button class="search" type="button" onclick="alert('you searched something!')"><img src="Rescources/edit.png" width="30" height="30"></button></td>
  </tr>
  <tr>
    <td>Lip Cream</td>
    <td>LC</td>
    <td>Creams</td>
	<td>$80</td>
	<td>3</td>
	<td><input type="text"  style="float:right" id="fname" name="fname"></td>
	<td><button class="search" type="button" onclick="alert('you searched something!')"><img src="Rescources/edit.png" width="30" height="30"></button></td>
  </tr>
</table>
<p><button class="button button1" style="float:right" onclick="alert('Removed!')">REMOVE</button></p>
<p><button class="button button1" style="float:right" onclick="alert('Added!')">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
<h2>ADD/EDIT STOCK ITEM</h2>

 <p>ITEM: <input type="text" id="fname" name="fname" value="ID"></p> 
 <p>ID: <input type="text" id="fname" name="fname" value="###"></p> 
 <p>PRICE: <input type="text" id="fname" name="fname" value="ID"></p> 
 <p>CATEGORY: <input type="text" id="fname" name="fname" value="###"></p> 
<p><button class="button button1" onclick="alert('You Updated the Table!')">UPDATE</button></p>
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>