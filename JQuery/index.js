$(document).ready(function() {
    var error = [];
    $("#loginEmail").change(function(){  
        $(".tickEmail").css("display", "none");
        var email = $("#loginEmail").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        $("#ema").text("");
        if (email.length!=0 && (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)) {
        $("#ema").text("Invalid Email ID. ");

        } else {
        $.ajax({
        	//The URL for the request
        	url: "response/return.php",
        	//The data to send 
        	data: {
        		email: $("#loginEmail").val()
        	},
        	// Whether this is a POST or GET request
        	type: "POST",    
        	// The type of data we expect back
    		dataType : "json",
            success: function(response){
                var resp = response.email;
                if(resp === '') {
                    $(".tickEmail").css("display", "inline");
                    error[0] = "email";
                }
                $("#ema").text(resp);
            }
        });
        }

	});
	$("#loginPassword").change(function(){
        $(".tickPass").css("display", "none");
		var password=$("#loginPassword").val();
        $("#ema").text("");
        if((password.length!=0)&&((password.length<6||(password.search(/[0-9]/)==-1)||(password.search(/[a-z]/)==-1)||(password.search(/[A-Z]/)==-1)))) {
        $("#ema").text ("Passwords must have at least 6 characters and contain at least the following:upper case letters, lower case letters and numbers.");
	    } else {
        $(".tickPass").css("display", "inline");
        error[1] = "password";
        }
	});
	$("#loginRePassword").change(function(){
        $(".tickRepass").css("display", "none");
		var password=$("#loginPassword").val();
		var re_password=$("#loginRePassword").val();
        $("#ema").text("");
		if(password!=re_password) {
	        $("#ema").text("Password mismatch"); 
        } else {
        $(".tickRepass").css("display", "inline");
        error[2] = "repass";
        }
	})
    $(".button1").click(function(){
        if(error.length == 3 ) {
            $(".form1").hide();
            $(".form2").show();
        }
    });

    $("#name").change(function(){
        $("#form2_err").text("");
        if($("#name").val().length<2) {
            $("#form2_err").text("Name is a required field");
        } else
        {
            error[3] = "name";
        }   
    });

    $("#phone").change(function(){
        $("#form2_err").text("");
        if($("#phone").val().length<10) {
            $("#form2_err").text("Phone should have atleast 10 integers");
        } else if($("#phone").val().search(/[a-z]/)!=-1 ||$("#phone").val().search(/[A-Z]/)!=-1) {
            $("#form2_err").text("Invalid phone");
        } else {
            error[4] = "phone";
        }

    });

    $("#dob").change(function(){
        $("#form2_err").text("");
        var odt = new Date("1947-01-01");
        var dt =new Date();
        var date = new Date($("#dob").val());
        if($('input[name=gender]:checked').length<=0)
        {
            $("#form2_err").text("Please Select Gender");
        } else {
            error[5] = "gender";
        }
        if(date > dt || date < odt) {
            $("#form2_err").text("Invalid date");
        } else {
            error[6] = "date";
        }
    });

          
    $("#form2_next").click(function(){
        if(error.length == 7) {
            $(".form2").hide();
            $(".form1").show();
        }
    });

});