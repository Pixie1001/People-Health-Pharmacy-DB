<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="style.css">
 <script src="https://cdn.jsdelivr.net/npm/chart.js">
 </script>
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
  <a href="login.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">INVENTORY</h1></div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
<h2>SALES</h2>
  <h3>SEARCH:</h3>
<label for="item">Category:</label>
  <select name="item" id="item">
    <option value="item_name">All</option>
    <option value="item_id">Creams</option>
    <option value="item_category">Wipes</option>
	 <option value="item_category">Lotions</option>
  </select>
    <br></br>
	<label for="start">Start date:</label>

		<input type="date" id="start" name="start"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31">
	   
	  <br></br>
	   <label for="start">End date:</label>

		<input type="date" id="start" name="end"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31">
	   
	     <p>(If Blank Will Search All Items)</p>
	<input type="text" id="fname" name="fname">
	<button type="button" onclick="alert('you searched something!')"><img src="Rescources/search.png" width="15" height="15"></button>
	
	</div>
  </div>
  
  <div class="rightcolumn">
    <div class="card">
			<div>
			<canvas id="myChart"></canvas>
			</div>
	
	<canvas id="myChart" width="400" height="0"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }PPOGO
        }
    }
});
</script>
			
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
</div>

</body>
</html>