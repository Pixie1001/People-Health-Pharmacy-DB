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
  <a class="active" href="sales_management.php">Sales Management Screen</a>
  <a href="sales_analytics.php">Sales Analytics Screen</a>
  <a href="cash_register.php">CashRegister Screen</a>
  <a href="index.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">SALES RECORDS</h1></div>

<div class="row">
  <table>
  <tr>
    <th>CUSTOMER NAME</th>
    <th>ITEM</th>
    <th>QUANTITY</th>
	<th>RECEIPT ID#</th>
    <th>DATE</th>
	<th>TIME</th>
	<th></th>
  </tr>
  <tr>
    <td>Rayner</td>
    <td>Fungal Cream</td>
    <td>2</td>
	<td>#120123</td>
	<td>12/07/1995</td>
	<td>12/:15pm</td>
	<td><button class="search" type="button" onclick="alert('you searched something!')"><img src="Rescources/edit.png" width="30" height="30"></button></td>
  </tr>
  
  </table>
</div>

<div><h1 style="text-align: center">MANUAL SALE</h1></div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
<h2>STOCK</h2>
<h3 class="search" >SEARCH:</h3>
<input class="search" type="text" id="fname" name="fname">
<label class="items" for="items">type:</label>
  <select name="items" id="items">
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
  </tr>
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
</table>
<p><button class="button button1" style="float:right" onclick="alert('Hello world!')">ADD</button></p>
    </div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
<h2>SALE</h2>
<h3 >EDITING RECEIPT# 120123</h3>
<h3 class="search" >CUSTOMER NAME:</h3>
<input class="search" type="text" id="fname" name="fname">

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
<p><button class="button button1" style="float:right" onclick="alert('You saved!')">SAVE</button></p>
<p><button class="button button1" style="float:right" onclick="alert('You Cleared!')">CLEAR</button></p>
<p><button class="button button1" style="float:right" onclick="alert('You Removed sales record!')">REMOVE SALES RECORD</button></p>
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>