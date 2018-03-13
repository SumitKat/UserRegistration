function validate() {

    var em = document.forms["myForm"]["email"].value;
    var atpos = em.indexOf("@");
    var dotpos = em.lastIndexOf(".");
    var etxt;
    document.getElementById("ema").innerHTML = "";

    var x = document.forms["myForm"]["Password"].value;
    var y = document.forms["myForm"]["RePassword"].value;
    document.getElementById("pass").innerHTML = "";
    document.getElementById("repass").innerHTML = "";

    var ph = document.forms["myForm"]["Phone"].value;
    document.getElementById("ph").innerHTML = "";

    var fName = document.forms["myForm"]["First_name"].value;
    document.getElementById("fname").innerHTML = "";

    var lName = document.forms["myForm"]["Last_name"].value;
    document.getElementById("lname").innerHTML = "";

    var cstr = document.forms["myForm"]["Cstreet"].value;
    document.getElementById("cstr").innerHTML = "";

    var ccty = document.forms["myForm"]["Ccity"].value;
    document.getElementById("ccty").innerHTML = "";

    var cstt = document.forms["myForm"]["Cstate"].value;
    document.getElementById("cstt").innerHTML = "";

    var ccnt = document.forms["myForm"]["Ccountry"].value;
    document.getElementById("ccnt").innerHTML = "";

    var pstr = document.forms["myForm"]["Pstreet"].value;
    document.getElementById("pstr").innerHTML = "";

    var pcty = document.forms["myForm"]["Pcity"].value;
    document.getElementById("pcty").innerHTML = "";

    var pstt = document.forms["myForm"]["Pstate"].value;
    document.getElementById("pstt").innerHTML = "";

    var pcnt = document.forms["myForm"]["Pcountry"].value;
    document.getElementById("pcnt").innerHTML = "";

    var dob = document.forms["myForm"]["DOB"].value;
    document.getElementById("dob").innerHTML = "";

    var select = document.forms["myForm"]["Interests"].selectedIndex;
    document.getElementById("select").innerHTML = "";

    var flag = 0;

    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= em.length) {
        document.getElementById("ema").innerHTML = "Invalid Email ID";
        flag = 1;
    }
    if (x.length < 6 || (x.search(/[0-9]/) == -1) || (x.search(/[a-z]/) == -1) || (x.search(/[A-Z]/) == -1)) {
        document.getElementById("pass").innerHTML = "Passwords must have at least 6 characters" + "<br>" +
            " and contain at least the following:upper" + "<br>" +
            "case letters, lower case letters and numbers.";
        flag = 1;
    }
    if (x != y) {
        document.getElementById("repass").innerHTML = "Password mismatch";
        flag = 1;
    }
    if (ph.length != 10 || ph.search(/[a-z]/) != -1 || ph.search(/A-Z/) != -1) {
        document.getElementById("ph").innerHTML = "Invalid Phone";
        flag = 1;
    }
    if (fName.length < 3) {
        document.getElementById("fname").innerHTML = "Please Enter valid First Name";
        flag = 1;
    }
    if (lName.length < 1) {
        document.getElementById("lname").innerHTML = "Please Enter valid Last Name";
        flag = 1;
    }
    if (cstr.length < 1) {
        document.getElementById("cstr").innerHTML = "Please fill in the street address";
        flag = 1;
    }
    if (ccty.length < 1) {
        document.getElementById("ccty").innerHTML = "Please fill in the city name";
        flag = 1;
    }
    if (cstt.length < 1) {
        document.getElementById("cstt").innerHTML = "Please fill in the state name";
        flag = 1;
    }
    if (ccnt.length < 1) {
        document.getElementById("ccnt").innerHTML = "Please fill in the country name";
        flag = 1;
    }
    if (pstr.length < 1) {
        document.getElementById("pstr").innerHTML = "Please fill in the street address";
        flag = 1;
    }

    if (pcty.length < 1) {
        document.getElementById("pcty").innerHTML = "Please fill in the city name";
        flag = 1;
    }
    if (pstt.length < 1) {
        document.getElementById("pstt").innerHTML = "Please fill in the state name";
        flag = 1;
    }
    if (pcnt.length < 1) {
        document.getElementById("pcnt").innerHTML = "Please fill in the country name";
        flag = 1;
    }
    if (flag == 1) {
        return false;
    }
    // else if((new Date().getFullYear() - dob.getFullYear()) < 3)
    // {
    // 	document.getElementById("dob").innerHTML="Age below 3 years is not valid";
    // 	return false;
    // }
    // else if(select=="")
    // {
    // 	document.getElementById("select").innerHTML="Please Select Atleast one point of interest";
    // 	return false;
    // }

}
