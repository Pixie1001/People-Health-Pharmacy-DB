<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="style.css">
 <script src="js/chart.js">
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
  <a class="active" href="sales_analytics.php">Sales Analytics Screen</a>
  <a href="cash_register.php">CashRegister Screen</a>
  <a href="index.php" style="float:right">Logout</a>
</div>

<div><h1 style="text-align: center">ANALYTICS</h1></div>

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
            }
        }
    }
});
</script>
			
    </div>
  </div>
</div>

<div class="footer">
  <p>omicron turtle™</p>
  
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
					echo "<p>", $row['itemName'], "</p>";
					echo "<p>", $row['itemID'], "</p>";
					echo "<p>", $row['itemCategory'], "</p>";
					echo "<p>", $row['itemPrice'], "</p>";
					echo "<p>", $row['stock'], "</p>";
					echo "<p><input type='number' min='-99' max='99' style='float:right'></p>";
					echo "</tr>";
				}
			}
		}
	  ?>
  
</div>

</body>
</html>