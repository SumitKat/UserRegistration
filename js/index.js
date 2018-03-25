$(document).ready(function() {
    var errorEmail = [];
    var errorName = [];
    // check if email field is changed
    $("#loginEmail").change(function(){  
        $(".tickEmail").css("display", "none");
        var email = $("#loginEmail").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        $("#ema").text("");

        if (email.length ==0 || (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)) {
        $("#ema").text("Invalid Email ID. ");
        showCross($(".crossEmail"),$(".tickEmail"));
        errorEmail[0] = 0;
        } else {
        
        $.ajax({
        	//The URL for the request
        	url: "api/email_check.php",
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
                    showTick($(".crossEmail"),$(".tickEmail"));
                    if(errorEmail.length != 3)
                        errorEmail[0] = 1;
                }
                $("#ema").text(resp);
            }
        });
        }

	});
    // check id password field is changed
	$("#loginPassword").change(function(){
        $(".tickPass").css("display", "none");
		var password=$("#loginPassword").val();
        $("#ema").text("");
        if((password.length == 0)||((password.length<6||(password.search(/[0-9]/)==-1)||(password.search(/[a-z]/)==-1)||(password.search(/[A-Z]/)==-1)))) {
        $("#ema").text ("Passwords must have at least 6 characters and contain at least the following:upper case letters, lower case letters and numbers.");
        showCross($(".crossPass"),$(".tickPass"));
        errorEmail[1] = 0;
	    } else {
        showTick($(".crossPass"),$(".tickPass"));
        errorEmail[1] = 1;
        }
	});
    // check id Retype password field is changed
	$("#loginRePassword").change(function(){
        $(".tickRepass").css("display", "none");
		var password = $("#loginPassword").val();
		var re_password = $("#loginRePassword").val();
        $("#ema").text("");
		if(password !=re_password) {
	        $("#ema").text("Password mismatch"); 
            showCross($(".crossRepass"),$(".tickRepass"));
            errorEmail[2] = 0;
        } else {
        showTick($(".crossRepass"),$(".tickRepass"));
        errorEmail[2] = 1;
        }
	})
    // action to be performed if next button of email form is clicked
    $(".button1").click(function(){
        var flag=0, i;
        for(i=0 ; i<errorEmail.length; i++) {
            if(errorEmail[i] == 0)
            {
                flag=1;
            }
        }
        if(flag ==0 && errorEmail.length == 3) {
            $(".container1").hide();
            $(".container2").show();
        } else {
            $("#ema").text("Please Fill all the above fields correctly");
        }
    });
    // check if the name field is changed
    $("#name").change(function(){
        $("#form2_err").text("");
        if(isEmpty($("#name").val())) {
            showCross($(".crossName"),$(".tickName"));
            $("#form2_err").text("Name is a required field");
            errorName[0] = 0;
        } else {
            showTick($(".crossName"),$(".tickName"));
            errorName[0] = 1;
        }   
    });
    // check if the phone field is changed
    $("#phone").change(function(){
        $("#form2_err").text("");
        if($("#phone").val().length<10 || $("#phone").val().search(/[a-z]/)!=-1 ||$("#phone").val().search(/[A-Z]/)!=-1) {
            errorName[1] = 0;
            $("#form2_err").text("Invalid phone");
            showCross($(".crossPhone"),$(".tickPhone"));
        } else {
            showTick($(".crossPhone"),$(".tickPhone"));
            errorName[1] =1;
        }

    });
    // check if the gender field is changed
    $('input[name=gender]').change (function() {
    $("#form2_err").text("");
    $(".tickGender").css("display", "none");
    if($('input[name=gender]:checked').length<=0)
        {
            $("#form2_err").text("Please Select Gender");
            errorName[2] = 0;
        } else {
            errorName[2] = 1;
        }
    });
    // check if the dob field is changed
    $("#dob").change(function(){
        $(".tickDate").css("display", "none");
        $("#form2_err").text("");
        var odt = new Date("1947-01-01");
        var dt =new Date();
        var date = new Date($("#dob").val());
        if(date > dt || date < odt) {
            $("#form2_err").text("Invalid date");
            showCross($(".crossDate"),$(".tickDate"));
            errorName[3] = 0;
        } else {
            showTick($(".crossDate"),$(".tickDate"));
            errorName[3] = 1;
        }
    });
    // Action to be performed if the next button of basic details form is clicked
    $("#form2_next").click(function(){
        var flag =0 ,i;
        for(i=0 ; i < errorName.length; i++) {
            if(errorName[i] == 0) {
                flag = 1;
            }
            if(flag == 0 && errorName.length == 4) {
                $(".container2").hide();
                $(".container3").show();
            } else {
                $("#form2_err").text("Please Fill all the above fields correctly");
            }
        }
    });
    // Action to be performed if the back button of basic details form is clicked
    $("#form2_prev").click(function(){
        $(".container2").hide();
        $(".container1").show();
    });
    // check if the street field is changed
    $("#street").change(function(){
        $(".tickStreet").css("display", "none");
        $("#form3_err").text("");
        if(isEmpty($("#street").val())) {
            $("#form3_err").text("Street field is required");
            showCross($(".crossStreet"),$(".tickStreet"));
        } else {
            showTick($(".crossStreet"),$(".tickStreet"));
        }

    });
    // check if the state field is changed
    $("#state").change(function(){
         $(".tickState").css("display", "none");
        $("#form3_err").text("");
        if(isEmpty($("#state").val())) {
            $("#form3_err").text("State field is required");
            showCross($(".crossStreet"),$(".tickState"));
        } else {
            showTick($(".crossStreet"),$(".tickState"));
        }

    });
    //check if the city field is changed
    $("#city").change(function(){
        $(".tickCity").css("display", "none");
        $("#form3_err").text("");
        if(isEmpty($("#city").val())) {
            $("#form3_err").text("City field is required");
            showCross($(".crossCity"),$(".tickCity"));
        } else {
            showTick($(".crossCity"),$(".tickCity"));
        }

    });
    // check if the country field is changed
    $("#country").change(function(){
        $(".tickCountry").css("display", "none");
        $("#form3_err").text("");
        if(isEmpty($("#country").val())) {
            $("#form3_err").text("Country field is required");
            showCross($(".crossCountry"),$(".tickCountry"));
        } else {
            showTick($(".crossCountry"),$(".tickCountry"));
        }

    });
    // action to be performed when the user click back button of the address form
    $("#form3_prev").click(function(){
        $(".container3").hide();
        $(".container2").show();
    });
    // function to check if the field is empty
    function isEmpty(arg) {
        if(arg.length <2) {
            return true;
        }
    }

    function showTick(cross, tick) {
        cross.css("display", "none");
        tick.css("display", "inline");
    }

    function showCross(cross, tick) {
        tick.css("display", "none");
        cross.css("display", "inline");
    }
});