//mailing list helper javascript

function checkform(form) {
	for (i=0;i<fieldstocheck.length;i++) {
    if (eval("form.elements['"+fieldstocheck[i]+"'].type") == "checkbox") {
      if (form.elements[fieldstocheck[i]].checked) {
      } else {
        alert("Please enter your "+fieldnames[i]);
        eval("form.elements['"+fieldstocheck[i]+"'].focus()");
        return false;
      }
    }
    else {
      if (eval("form.elements['"+fieldstocheck[i]+"'].value") == "") {
        alert("Please enter your "+fieldnames[i]);
        eval("form.elements['"+fieldstocheck[i]+"'].focus()");
        return false;
      }
    }
  }
  for (i=0;i<groupstocheck.length;i++) {
    if (!checkGroup(groupstocheck[i],groupnames[i])) {
      return false;
    }
  }
  return true;
}

var fieldstocheck = new Array();
var fieldnames = new Array();
function addFieldToCheck(value,name) {
  fieldstocheck[fieldstocheck.length] = value;
  fieldnames[fieldnames.length] = name;
}
var groupstocheck = new Array();
var groupnames = new Array();
function addGroupToCheck(value,name) {
  groupstocheck[groupstocheck.length] = value;
  groupnames[groupnames.length] = name;
}

function compareEmail()
{
  return (form.elements["email"].value == document.subscribeform.elements["emailconfirm"].value);
}
function checkGroup(name,value) {
  option = -1;
  for (i=0;i<form.elements[name].length;i++) {
    if (form.elements[name][i].checked) {
      option = i;
    }
  }
  if (option == -1) {
    alert ("Please enter your "+value);
    return false;
  }
  return true;
}

addFieldToCheck("email","Email");
addFieldToCheck("zip","Zipcode");
