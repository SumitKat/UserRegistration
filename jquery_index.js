$(document).ready(function() {
    $("#loginEmail").change(function(){  
        var email = $("#loginEmail").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        $("#ema").text("");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=em.length) {
        $("#ema").text("Invalid Email ID. ");
        } else {
        $.post("demo_test_post.asp",
        {
          email : $("#loginEmail").val()
        },
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
        }

	});
	$("#loginPassword").change(function(){
		var password=$("#loginPassword").val();
        $("#ema").text("");
        if((password.length!=0)&&((password.length<6||(password.search(/[0-9]/)==-1)||(password.search(/[a-z]/)==-1)||(password.search(/[A-Z]/)==-1)))) {
        $("#ema").text ("Passwords must have at least 6 characters and contain at least the following:upper case letters, lower case letters and numbers.");
	    }
	});
	$("#loginRePassword").change(function(){
		var password=$("#loginPassword").val();
		var re_password=$("#loginRePassword").val();
		if(password!=re_password) {
	        $("#ema").text("Password mismatch"); 
    }
	})
});