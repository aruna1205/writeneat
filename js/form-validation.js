var orderType;
var retHTML;
var state;
var total;


$(function() {
   
   $('input[type=radio][name=order_type]').change( function(){
	alert('radio change');
	$('#orderamount').html(getOrderAmountHTML());
   });
   $('#state').change( function(){
	alert('select change');
	$('#orderamount').html(getOrderAmountHTML());
   });
   
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      address: "required",
      city: "required",
      state: "required",
      pincode: {
         required:true,
         digits:true,
         minlength:6
         },
      phone: {
         required:true,
         digits:true,
         minlength:10
         },
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      name: "Please enter your firstname",
      address: "Please enter your address",
      city: "Please enter your city",
      state: "Please enter your state",
      pincode: {
	required: "Please provide valid pincode",
	minlength: "Please provide valid pincode"
      },
      phone: {
	required: "Please provide valid phone number",
	minlength: "Please provide valid phone number"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	//var btnClicked = $(document.activeElement).val();
    	orderType = $("input[name='order_type']:checked").val();
    	alert(orderType);
    	//Insert order details into DB
    	var formData = $("form[name='registration']").serializeArray();
    	formData.push({name: "order_type", value: orderType});
    	formData.push({name: "order_amount", value: total});
    	//console.log(formData);
    	//console.log('ppp');
    	
    	$.ajax({  
	    type: "POST",  
	    url: "includes/insertorderdetails.php",  
	    data: formData,  
	    success: function(value) {
	    	    console.log(value);
	    	    retArr = value.split(':');
		    if(retArr[0] == 'success'){
			    if(orderType=='COD' || orderType=='online'){
		    		if(orderType=='online'){
			    		//console.log('razorpay payment page redirect');
			    		window.location.href = 'razorpay-php-testapp-master/pay.php?checkout=automatic&orderid='+retArr[1];
		    		}
		    		else{
		    			console.log('COD success page redirect');
		    			window.location.href = 'ordersuccess.php';
		    	    	}
		    	    }
		    
		    }
		    else{
		    	console.log(retArr[1]);
		    	$("#message").html("There was an error placing your order. Please try again later.");
		    	//$("#message").html(value);
		    }
	    }
	});
    	
    	//var val = $("button[type=submit][clicked=true]");
    	//var btnClicked = $(document.activeElement).val();
    	
    	

    }
  });
  

  //Order Summary Filling
  orderType = $("input[name='paymenttype']:checked").val();
  //state = $('#state').find(":selected").val();
  $('#orderamount').html(getOrderAmountHTML());
  
  
});

function getOrderAmountHTML(){
	retHTML = '<div>Normal Price: '+mrp+'</div>';
	retHTML += '<div>Offer Price : '+sp+'</div>';
	total = sp;
	orderType = $("input[name='order_type']:checked").val();
	if(orderType == 'COD'){
		retHTML += '<div>Cash on delivery charges : '+codCharges+'</div>';
		total += codCharges;
	}
	state = $('#state').find(":selected").val();
	if(state == 'Karnataka'){
		retHTML += '<div>'+cgstPercent+'% CGST : '+cgstAmount+'</div>';
		retHTML += '<div>'+sgstPercent+'% SGST : '+sgstAmount+'</div>';
		total += cgstAmount+sgstAmount;
	}
	else{
		retHTML += '<div>'+igstPercent+'% IGST : '+igstAmount+'</div>';
		total += igstAmount;
	}
	
	retHTML += '<div>Total : '+total+'</div>';
	return retHTML;
	
	
}
