window.addEventListener("load", cart);

function cart()
	{
		//selector and loop for the function that will handle all input type = number tags.
		var quantity = document.querySelectorAll("input[value][type='number']");
		for (var i = 0; i<quantity.length; i++)
		{
			quantity[i].addEventListener("change", function(){
				var val = this.value;
				var key = this.name;
				var ser = this.parentNode.parentNode.id;
				var subTotal = $(sub1).html();
				var shipTotal = $(shipCost).html();
				var shipValue = "";
				if ( $(r1).prop("checked") ==true)
				{
					var shipValue = "standard";
				}else {var shipValue = "express";}
				$.post("././CartUpdate.php", {"quantity": val, "serial": ser, "sub": subTotal, "shipSub": shipTotal, "shipping": shipValue}).done(function(data) { console.log(data); Money(data); });
			});
		}
		
		//adding an event to the remove button.
		//var remove = document.querySelectorAll("remove");
		var remove = $(".glyphicon-remove");
		for (var i = 0; i<remove.length; i++)
		{
			remove[i].addEventListener("click", removeItem);
		}
		//selector and loop for the function that will handle all selector tags.
		temp = document.querySelectorAll("select");
		for (var i = 0; i<temp.length; i++)
		{
			temp[i].addEventListener("change", cartData);
		}
		
		//creates an event for the shipping "radio" buttons.
			var shipp1 = document.getElementById("r1");
			var shipp2 = document.getElementById("r2");
			
			shipp1.addEventListener("change", shippingData);
			shipp2.addEventListener("change", shippingData);
	}

//function that handles the change event for all selector tags.
	function cartData(e)
	{
		var val = this.value;
		var key = this.name;
		var ser = this.parentNode.parentNode.id;
		var subTotal = $(sub1).html();
		var shipTotal = $(shipCost).html();
		var shipValue = "";
		if ( $(r1).prop("checked") ==true)
		{
			var shipValue = "standard";
		}else {var shipValue = "express";}
		
		
		if(key=="size"){
			$.post("././CartUpdate.php", {"size": val, "serial": ser , "sub": subTotal, "shipSub": shipTotal, "shipping": shipValue}).done(function(data) { console.log(data); Money(data);  });
		}else if(key=="paper")
		{
			$.post("././CartUpdate.php", {"paper": val, "serial": ser , "sub": subTotal, "shipSub": shipTotal, "shipping": shipValue}).done(function(data) { console.log(data); Money(data);  });
		}else if(key=="frame")
		{
			$.post("././CartUpdate.php", {"frame": val, "serial": ser , "sub": subTotal, "shipSub": shipTotal, "shipping": shipValue}).done(function(data) { console.log(data); Money(data);  });
		}
	}

//function grabs data from cartupdate via JSON and runs through the input and makes necessary changes.
	function Money(data)
	{
		for (var key in data)
		{
			if( data.hasOwnProperty( key ) )
			{
				$("#" + key + 1).html("$" + data[key]);
				if(key=="sub")
				{
					$(key + 1).html("$" + data[key]);
				}
				if(key=="shipping")
				{
					if(data[key]=="standard")
					{
						$(r1).attr("checked");
					}else{
						$(r2).attr("checked");
					}
				}
			}
			if(key=="shipCost")
			{
				$(shipCost).html("$" + data[key]);
			}
			if(key == "total")
			{
				$(total).html("$" + data[key]);
			}
		}
	}

//the function that updates the shipping session via $.post and updates the shipping cost from the JSON data returned.
	function shippingData(e)
	{
		var subTotal = $(sub1).html();
		var shipTotal = $(shipCost).html();
		var  val = this.value;
		$.post("././CartUpdate.php", {"shipping": val, "sub": subTotal, "shipSub": shipTotal}).done(function(data) { console.log(data); Money(data); });
	}
	
	//function for removing a single item from the cart.
	function removeItem(e)
	{
		var ser = this.parentNode.parentNode.id;
		$.post("././CartUpdate.php", {"serial": ser, "remove" : "yes"}).done(function(data) { console.log(data); removeTr(data);});
	}
	
	//removes the table row when the JSON data is returned.
	function removeTr(data)
	{
		for (var key in data)
		{
			if( data.hasOwnProperty( key ) )
			{
				if(key==data[key])
				{
					$(this).closest('tr').remove();
				}
			}
		}
	}