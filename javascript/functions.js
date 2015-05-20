function validReg(){

var userFName = document.getElementById("firstName").value;
var userLName = document.getElementById("lastName").value;
var userType = document.getElementById("regType").value;
var userArea = document.getElementById("areaCode").value;
var userPhone = document.getElementById("phoneNumber").value;
var userEmail = document.getElementById("e-mail").value;
var userPass = document.getElementById("password").value;
var userConfPass = document.getElementById("repassword").value;

var alertString="You have entered invalid inputs for:";

var patternName=/^([A-Za-z]+(\-?[A-za-z])+)$/;
var patternAreaCode=/^(\d{3})$/;
var patternPhoneNumber=/^(\d{3}\-\d{4})$/;
var patternEmail=/^(\w+\@[a-z]+\.[a-z]+)$/;
var patternPass=/^([A-Za-z]+|\d+){6,}$/;

if (!patternName.test(userFName))
	alertString += "\n- First Name";

if (!patternName.test(userLName))
	alertString+="\n- Last Name";

if (!patternAreaCode.test(areaCode) && !patternPhoneNumber.test(userPhone))
	alertString+="\n- Phone Number";

if (!patternEmail.test(userEmail))
	alertString+="\n- E-mail Address";

if (!patternPass.test(userPass))
	alertString+="\n- Password";

if (userPass != userConfPass)
	alertString+="\n\nPasswords do not match";

if (alertString == "You have entered invalid inputs for:"){
	alert("Creating Account..");	
	return true;
}
else{
	alert(alertString);
	return false;
}
}
