"use strict";

//Load in query table rows to js
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

//Load in cart rows, ready for exporting to MySQL database
function saleRecord (row) {
	var datums = Array.prototype.slice.call(row.querySelectorAll("*"));
	
	this.id = datums[1].innerHTML;
	this.price = datums[3].innerHTML;
	this.quantity = datums[4].innerHTML;
}

//Transfer items from query to cart
function AddItems() {
	//Assign variables
	var items = document.getElementsByClassName("tuple");
	var cartItems = document.getElementsByClassName("cartTuple");
	var tuples = [];
	var inCart = false;
	
	//Check if cart is filled
	if (items.length > 0) {
		//Find and read in queried items with a filled out quantity field
		for (var i = 0; i < items.length; i++) {
			var tempTuple = new tuple(items[i]);
			if (tempTuple.quantity == "" || tempTuple.quantity == 0) {
				//Do not add
			}
			else {
				//Iterate through current cart items to check for duplicate item IDs
				for (var x = 0; x < cartItems.length; x++) {
					var cartId = Array.prototype.slice.call(cartItems[x].querySelectorAll("*"))[1].innerHTML;
					if (tempTuple.id == cartId) {
						//Update duplicate item's quantity value
						var quantityField = Array.prototype.slice.call(cartItems[x].querySelectorAll("*"))[4];
						quantityField.innerHTML = parseInt(tempTuple.quantity) + parseInt(quantityField.innerHTML);
						inCart = true;
						
						//Remove any item with a new gross quantity below 1
						if (parseInt(quantityField.innerHTML) <= 0) {
							RemoveItem(x);
						}
						break;
					}
				}
				//Add item to cart, if unique
				if (inCart == false) {
					tuples.push(new tuple(items[i]));
				}
			}
		}
		
		//Draw cart items to screen
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
		
		//Display total cost
		CalculateTotal();
		
		//Sanitise input fields
		for (var i = 0; i < items.length; i++) {
			Array.prototype.slice.call(Array.prototype.slice.call(items[i].querySelectorAll("*"))[5].querySelectorAll("*"))[0].value = "";
		}
	}
}

//Process purchase button
function ConfirmPurchase() {
	var cartItems = document.getElementsByClassName('cartTuple');
	var tblStock = document.getElementById('cart');
	
	//Remove output divs from previous purchases
	var divOutput = document.getElementById('sellOutput');
	if (divOutput != null) {
		divOutput.remove();
	}
	
	//Create invisible output div to be read by PHP on POST
	divOutput = document.createElement('div');
	divOutput.setAttribute('id', 'sellOutput');
	divOutput.setAttribute('hidden', 'true');
	
	//Validate sale data
	var txtName = document.getElementById('customer_name');
	if (txtName.value == "") {
		alert("Please enter customer name");
		return false;
	}
	else if (cartItems.length == 0) {
		alert("Please add one or more items to this order");
		return false;
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
	
	//Create input box to tell PHP how many loops it needs to run
	var txtLength = document.createElement('input');
	txtLength.setAttribute('name', 'txtLength');
	txtLength.setAttribute('value', cartItems.length);
	divOutput.appendChild(txtLength);
	
	//Add input box to page
	tblStock.appendChild(divOutput);
	
	//Print sale confirmation
	var grossCost = document.getElementById("totalPriceValue").innerHTML.split(" ")[1];
	return confirm("Confirm final purchase of " + grossCost + " worth of goods, for " + txtName.value + "?");
}

//Remove item from cart by index
function RemoveItem(index) {
	//Read cart items into array
	var cartItems = document.getElementsByClassName('cartTuple');
	
	//Remove item
	cartItems[index].remove();
	
	//Read cart items into array after removal
	cartItems = document.getElementsByClassName('cartTuple');
	
	//Adjust indexes of remaining cart items
	for (var i = 0; i < cartItems.length; i++) {
		Array.prototype.slice.call(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[5].querySelectorAll("*"))[0].setAttribute('onClick', 'RemoveItem(' + i + ')');
	}
	
	//Recalculate new gross cost
	CalculateTotal();
}

//Display and calculate gross cost of cart items
function CalculateTotal() {
	//Declare variables
	var tblStock = document.getElementById('cart');
	var cartItems = document.getElementsByClassName('cartTuple');
	var trTotal = document.getElementById('totalPrice');
	
	//Remove old price element, so it can be readded at the bottom of the table
	trTotal.remove();
	
	//Create gross price element
	trTotal = document.createElement('tr');
	trTotal.setAttribute('id', 'totalPrice');
	var tdsTotal = [document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td'), document.createElement('td')];
	var totalPrice = 0;
	
	//Calculate gross price of cart items
	for (var i = 0; i < cartItems.length; i++) {
		totalPrice += parseFloat(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[3].innerHTML) *
		parseFloat(Array.prototype.slice.call(cartItems[i].querySelectorAll("*"))[4].innerHTML);
	}
	
	tdsTotal[3].innerHTML = '<strong>Total: $' + totalPrice.toFixed(2) + " </strong>";
	tdsTotal[3].setAttribute("id", "totalPriceValue");
	
	//Construct final gross price row
	for (var i = 0; i < tdsTotal.length; i++) {
		trTotal.appendChild(tdsTotal[i]);
	}
	
	//Add gross price element to table
	tblStock.appendChild(trTotal);
}

function init() {}

window.onload = init;