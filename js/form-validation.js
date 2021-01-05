$(function() {

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
    	var btnClicked = $("input[name='paymenttype']:checked").val();
    	alert(btnClicked);
    	//Insert order details into DB
    	var formData = $("form[name='registration']").serializeArray();
    	formData.push({name: "order_type", value: btnClicked});
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
			    if(btnClicked=='COD' || btnClicked=='online'){
		    		if(btnClicked=='online'){
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
  
  alert('gggg');
  //Order Summary Filling
  $('#orderamount').html('MRP:'+mrp+'<br/>'+'SP:'+sp+'<br/>'+'CGST:'+cgstPrecent+'<br/>'+'SGST:');
  
  
});


