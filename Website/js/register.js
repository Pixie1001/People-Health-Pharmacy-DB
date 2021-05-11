"use strict";

//

//var array[];

function tuple (name, id, category, price, stock) {
	this.name = name;
	this.id = id;
	this.category = category;
	this.price = price;
	this.stock = stock;
}

function QueryStock() {
	/*
	var query = document.getElementsByTagName("input")[0].value;
	if (query != "") {
		var footer = document.getElementsByClassName("footer");
		footer[0].innerHTML = query;
	}
	*/
	
	var query = document.getElementsByTagName("input")[0].value;
	
	//Read database entry in as tuples
	if (query == 't') {
		var tuples = [
			new tuple('Jazz Cream', 'FC', 'Creams', 30, 12),
			new tuple('The miracle of childbirth', 'CB', 'Miracle', 40, 9)
		];
	}
	else {
	var tuples = [
		new tuple('Fungle Cream', 'FC', 'Creams', 30, 12),
		new tuple('Hand Cream', 'HC', 'Creams', 40, 9)
	];
	}
	
	//Load tuples into HTML
	var tblStock = document.getElementById('stock_list');
	var StockRowList = document.getElementsByClassName('StockRow');
	
	for (var i = StockRowList.length - 1; i >= 0 ; i--) {
		StockRowList[i].remove();
	}
	
	for (var i = 0; i < tuples.length; i++) {
		var trRow = document.createElement('tr');
		var tdName = document.createElement('td');
		var tdId = document.createElement('td');
		var tdCategory = document.createElement('td');
		var tdPrice = document.createElement('td');
		var tdStock = document.createElement('td');
		var tdQuantity = document.createElement('td');
		var inpQuantity = document.createElement('input');
		
		var rowNum = 'row_' + i;
		trRow.setAttribute('id', rowNum);
		trRow.setAttribute('class', 'StockRow');
		
		tdName.innerHTML = tuples[i].name;
		tdId.innerHTML = tuples[i].id;
		tdCategory.innerHTML = tuples[i].category;
		tdPrice.innerHTML = tuples[i].price;
		tdStock.innerHTML = tuples[i].stock;
		
		inpQuantity.setAttribute('type', 'text');
		inpQuantity.setAttribute('style', 'float:right');
		
		tblStock.appendChild(trRow);
		
		trRow.appendChild(tdName);
		trRow.appendChild(tdId);
		trRow.appendChild(tdCategory);
		trRow.appendChild(tdPrice);
		trRow.appendChild(tdStock);
		trRow.appendChild(tdQuantity);
		tdQuantity.appendChild(inpQuantity);
	}
	
	/*
	  <tr>
    <td>Fungal Cream</td>
    <td>FC</td>
    <td>Creams</td>
	<td>$30</td>
	<td>12</td>
	<td> <input type="text" style="float:right" id="fname" name="fname"></td>
  </tr>
	*/
}

function ConfirmPurchase() {
	
}

function RemoveItem() {
	
}

function AddItems() {
	
}

function init() {
	//Handles events on the apply.html and jobs.html pages.
	
	// if (document.getElementById("apply_page") != null) {
		// //element variables
		// var applyForm = document.getElementById("applyForm");
		// var drpPosition = document.getElementById("position");
		
		// //Update the form with previously stored data
		// fillForm();
		
		// //update job info when the job is changed via the position element
		// drpPosition.onchange = updatePosition;
		// //Validate the inputted data when the submit button is clicked
		// applyForm.onsubmit = validate;
	// }
	// else if (document.getElementById("jobs_page") != null) {
		// //element variables
		// var btnJavaDeveloper = document.getElementById("appJavaDeveloper");
		// var btnLeadProgrammer = document.getElementById("appLeadProgrammer");
		
		// //Handles job application when either of the 2 apply buttons are clicked
		// btnJavaDeveloper.onclick = function() {applyForJob(btnJavaDeveloper)};
		// btnLeadProgrammer.onclick = function() {applyForJob(btnLeadProgrammer)};
	// }
	
	
	
	//var btnSearch = document.getElementById("searchButton");
	//btnSearch.onclick = function() {QueryStock()};
}

window.onload = init;