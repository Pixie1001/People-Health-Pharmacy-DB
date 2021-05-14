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

function tuple (row) {
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

function saleRecord (row) {
	var datums = Array.prototype.slice.call(row.querySelectorAll("*"));
	
	this.id = datums[1].innerHTML;
	this.price = datums[3].innerHTML;
	this.quantity = datums[4].innerHTML;
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

function AddItems() {
	var items = document.getElementsByClassName("tuple");
	var cartItems = document.getElementsByClassName("cartTuple");
	var tuples = [];
	var inCart = false;
	if (items.length > 0) {
		for (var i = 0; i < items.length; i++) {
			var tempTuple = new tuple(items[i]);
			if (tempTuple.quantity == "" || tempTuple.quantity == 0) {
				//Do not add
			}
			else {
				for (var x = 0; x < cartItems.length; x++) {
					//var cartId = Array.prototype.slice.call(Array.prototype.slice.call(cartItems[x].querySelectorAll("*"))[5].querySelectorAll("*"))[0].value;
					var cartId = Array.prototype.slice.call(cartItems[x].querySelectorAll("*"))[1].innerHTML;
					if (tempTuple.id == cartId) {
						var quantityField = Array.prototype.slice.call(cartItems[x].querySelectorAll("*"))[4];
						quantityField.innerHTML = parseInt(tempTuple.quantity) + parseInt(quantityField.innerHTML);
						inCart = true;
						
						if (parseInt(quantityField.innerHTML) <= 0) {
							RemoveItem(x);
						}
						break;
					}
				}
				if (inCart == false) {
					tuples.push(new tuple(items[i]));
				}
			}
		}
		
		var tblStock = document.getElementById('cart');

		for (var i = 0; i < tuples.length; i++) {
			var trRow = document.createElement('tr');
			var tdName = document.createElement('td');
			var tdId = document.createElement('td');
			var tdCategory = document.createElement('td');
			var tdPrice = document.createElement('td');
			var tdQuantity = document.createElement('td');
			var tdRemove = document.createElement('td');
			var btnRemove = document.createElement('button');
			var imgRemove = document.createElement('img');
			
			//var rowNum = 'row_' + i;
			//trRow.setAttribute('id', rowNum);
			trRow.setAttribute('class', 'cartTuple');
			
			//Format remove button
			var numTuples = document.getElementsByClassName("cartTuple");
			btnRemove.setAttribute('class', 'search');
			btnRemove.setAttribute('type', 'button');
			btnRemove.setAttribute('onclick', 'RemoveItem(' + numTuples.length + ')');
			
			//Format remove icon
			imgRemove.setAttribute('src', 'Rescources/trash.jpg');
			imgRemove.setAttribute('width', '30');
			imgRemove.setAttribute('height', '30');
			
			tdName.innerHTML = tuples[i].name;
			tdId.innerHTML = tuples[i].id;
			tdCategory.innerHTML = tuples[i].category;
			tdPrice.innerHTML = tuples[i].price;
			tdQuantity.innerHTML = tuples[i].quantity;
			tdRemove.appendChild(btnRemove);
			
			tblStock.appendChild(trRow);
			
			trRow.appendChild(tdName);
			trRow.appendChild(tdId);
			trRow.appendChild(tdCategory);
			trRow.appendChild(tdPrice);
			trRow.appendChild(tdQuantity);
			trRow.appendChild(tdRemove);
			tdRemove.appendChild(btnRemove);
			btnRemove.appendChild(imgRemove);
		}
		CalculateTotal();
		for (var i = 0; i < items.length; i++) {
			Array.prototype.slice.call(Array.prototype.slice.call(items[i].querySelectorAll("*"))[5].querySelectorAll("*"))[0].value = "";
		}
	}
}

function ConfirmPurchase() {
	var cartItems = document.getElementsByClassName('cartTuple');
	var tblStock = document.getElementById('cart');
	
	//Remove output divs from previous purchases
	var divOutput = document.getElementById('sellOutput');
	if (divOutput != null) {
		divOutput.remove();
	}
	
	//Create output div
	divOutput = document.createElement('div');
	divOutput.setAttribute('id', 'sellOutput');
	divOutput.setAttribute('hidden', 'true');
	
	var txtName = document.getElementById('customer_name');
	if (txtName.value == "") {
		alert("Please enter customer name");
		return false;
	}
	else if (cartItems.length == 0) {
		alert("Please add one or more items to this order");
		return false;
	}
	else {
		var inpValid = document.createElement('input');
		inpValid.setAttribute('name', 'validSale');
		inpValid.setAttribute('value', 'true');
		divOutput.appendChild(inpValid);
	}
	
	//read in input boxes to export data to POST
	for (var i = 0; i < cartItems.length; i++) {
		var row = new saleRecord(cartItems[i]);
		var fields = [document.createElement('input'), document.createElement('input'), document.createElement('input')];
		
		fields[0].setAttribute("name", "id_" + i);
		fields[0].setAttribute("value", row.id);
		
		fields[1].setAttribute("name", "price_" + i);
		fields[1].setAttribute("value", row.price);
		
		fields[2].setAttribute("name", "quantity_" + i);
		fields[2].setAttribute("value", row.quantity);
		
		divOutput.appendChild(fields[0]);
		divOutput.appendChild(fields[1]);
		divOutput.appendChild(fields[2]);
	}
	
	var txtLength = document.createElement('input');
	txtLength.setAttribute('name', 'txtLength');
	txtLength.setAttribute('value', cartItems.length);
	divOutput.appendChild(txtLength);
	
	alert(txtLength.value + " / " + cartItems.length);
	
	tblStock.appendChild(divOutput);
	
	return true;
}

function RemoveItem(index) {
	var cartItems = document.getElementsByClassName('cartTuple');
	cartItems[index].remove();
	cartItems = document.getElementsByClassName('cartTuple');
	
	//Adjust indexes of remaining tuples
	for (var i = 0; i < cartItems.length; i++) {
		Array.prototype.slice.call(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[5].querySelectorAll("*"))[0].setAttribute('onClick', 'RemoveItem(' + i + ')');
	}
	CalculateTotal();
}

function CalculateTotal() {
	var tblStock = document.getElementById('cart');
	var cartItems = document.getElementsByClassName('cartTuple');
	var trTotal = document.getElementById('totalPrice');
	trTotal.remove();
	
	trTotal = document.createElement('tr');
	trTotal.setAttribute('id', 'totalPrice');
	var tdsTotal = [document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td')];
	var totalPrice = 0;
	
	for (var i = 0; i < cartItems.length; i++) {
		totalPrice += parseFloat(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[3].innerHTML) *
		parseFloat(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[4].innerHTML);
	}
	
	tdsTotal[3].innerHTML = '<strong>Total: $' + totalPrice.toFixed(2) + "</strong>";
	
	for (var i = 0; i < tdsTotal.length; i++) {
		trTotal.appendChild(tdsTotal[i]);
	}
	
	tblStock.appendChild(trTotal);
}

function init() {	
	//var btnSearch = document.getElementById("searchButton");
	//btnSearch.onclick = function() {QueryStock()};
}

window.onload = init;