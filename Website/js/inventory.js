"use strict";

//Load in query table rows to js
function Tuple (row) {
	var datums = Array.prototype.slice.call(row.querySelectorAll("*"));
	
	//var footer = document.getElementsByClassName("footer")[0];
	//footer.innerHTML = datums[0].innerHTML;
	
	this.name = datums[0].innerHTML;
	this.id = datums[1].innerHTML;
	this.category = datums[2].innerHTML;
	this.price = datums[3].innerHTML;
	this.stock = datums[4].innerHTML;
	
	var txtQuantity = Array.prototype.slice.call(datums[5].querySelectorAll("*"));
	
	this.quantity = txtQuantity[0].value;
}

//Load in cart rows, ready for exporting to MySQL database
function saleRecord (row) {
	var datums = Array.prototype.slice.call(row.querySelectorAll("*"));
	
	this.id = datums[1].innerHTML;
	this.price = datums[3].innerHTML;
	this.quantity = datums[4].innerHTML;
}

//Update stock
function AddStock() {
	//Do nothing? PHP Only?
}

//Update stock
function SubtractStock() {
	//Invert values and return true
}

//Remove an item from the database
function RemoveItem(itemID) {
	//Remove output divs from previous purchases
	var txtOutput = document.getElementById('sellOutput');
	if (txtOutput != null) {
		divOutput.remove();
	}
	
	//Create invisible output field to be read by PHP on POST
	txtOutput = document.createElement('input');
	txtOutput.setAttribute('name', 'deleteItem');
	txtOutput.setAttribute('value', itemID);
	txtOutput.setAttribute('hidden', 'true');
	
	//Find form and append txtOutput
	var items = document.getElementsByClassName('tuple');
	for (var i = 0; i < items.length; i++) {
		var id = parseInt(Array.prototype.slice.call(items[i].querySelectorAll("*"))[1].innerHTML);
		if (id == itemID) {
			var frmDelete = Array.prototype.slice.call(Array.prototype.slice.call(items[i].querySelectorAll("*"))[7].querySelectorAll("*"))[0];
			break;
		}
	}
	
	frmDelete.appendChild(txtOutput);
	
	return alert("Are you sure you want to permanantly delete item ID " + itemID + " from the database?");
}

function EditItem(itemID) {
	//Create hidden input field with stock ID. Insert STOCK ID into this element in PHP echo.
	
	//Find selected row
	var items = document.getElementsByClassName('tuple');
	for (var i = 0; i < items.length; i++) {
		var id = parseInt(Array.prototype.slice.call(items[i].querySelectorAll("*"))[1].innerHTML);
		if (id == itemID) {
			var item = new Tuple(items[i]);
			break;
		}
	}
	
	//Get input IDs
	var inpName = document.getElementById('inpName');
	var inpID = document.getElementById('inpID');
	var inpCategory = document.getElementById('inpCategory');
	var inpPrice = document.getElementById('inpPrice');
	
	inpName.setAttribute('value', item.name);
	inpID.setAttribute('value', item.id);
	inpCategory.setAttribute('value', item.category);
	inpPrice.setAttribute('value', item.price);
}

function NewItem() {
	//Probably handled almost entirely by PHP without use of js.
}

function init() {}

window.onload = init;