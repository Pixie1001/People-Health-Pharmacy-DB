"use strict";

//

//var array[];

// var o = {
  // 'a': 3, 'b': 4,
  // 'doStuff': function() {
    // alert(this.a + this.b);
  // }
// };
// o.doStuff(); // displays: 7

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
	
	//Read database entry into tuple
	tuple('Fungle Cream', 'FC', 'Creams', 30, 12);
	
	//Load tables
	var tblRow = document.createElement("tr");
	var tdName = document.createElement("td");
	var tdId = document.createElement("td");
	var tdCategory = document.createElement("td");
	var tdPrice = document.createElement("td");
	var tdStock = document.createElement("td");
	
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