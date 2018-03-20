function validate(val) {
    var em=document.forms["loginForm"]["loginEmail"].value;
    var atpos = em.indexOf("@");
    var dotpos = em.lastIndexOf(".");
    var x=document.forms["loginForm"]["loginPassword"].value;
    var y=document.forms["loginForm"]["loginRePassword"].value;
    document.getElementById("ema").innerHTML = "";
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=em.length) {
        document.getElementById("ema").innerHTML ="Invalid Email ID. ";   
        flag=1;
    } else if((x.length!=0)&&((x.length<6||(x.search(/[0-9]/)==-1)||(x.search(/[a-z]/)==-1)||(x.search(/[A-Z]/)==-1)))) {
        document.getElementById("ema").innerHTML = "Passwords must have at least 6 characters and contain at least the following:upper case letters, lower case letters and numbers.";
        flag=1;
    } else if(x!=y) {
        document.getElementById("ema").innerHTML ="Password mismatch"; 
        flag=1;
    }
}