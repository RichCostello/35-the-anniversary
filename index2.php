<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" language="javascript"></script>
<script>

$(document).ready(function() {
	$('#subscribeForm').submit(function() {
		checkForm();
	});
});

function checkForm() {
	
	var first = $('#first').val();
	var last = $('#last').val();
	var email = $('#email').val();
	var zip = $('#zip').val();
	
	if(first == "" || first == "FIRST NAME") {
		alert("Please enter your first name.");
		return false;
	}
	if(last == "" || last == "LAST NAME") {
		alert("Please enter your last name.");
		return false;
	}
	if(email == "" || email == "EMAIL ADDRESS") {
		alert("Please enter your email address.");
		return false;
	}
	if(zip == "" || zip == "ZIP CODE") {
		alert("Please enter your zip code.");
		return false;
	}
	
	if(!$("input[name='age']").is(":checked")) {
		alert("Please verify you are 21 or over.");
		return false;
	}
	
	doEntry();
	
}

function doEntry() {
	
	$.ajax({
		type: "POST",
		url: "ajax.php",
		dataType: "json",
		data: {'first': $('#first').val(), 'last': $('#last').val(), 'email': $('#email').val(), 'zip': $('#zip').val(), 'property': $('#hf').val(), 'age': $('#age').val()},
		success: function(data) {
			if(data.result == "success") {
				window.location = "thankyou.php";
			} else if(data.result == "failed") {
				showError(data.error);
			} else {
				alert("There was an error submitting your entry. Please try again later.");
			}
		},
		error: function(data, status) {
			alert("There was an issue submitting your entry. Please try again later.");
		}
	});
	
}

function showError(msg) {
	alert(msg);
}

</script>
</head>

<body>

<form id="subscribeForm" action=""  name="subscribeForm" method="post" onsubmit="return false;">
    <input type="text" class="field" value="FIRST NAME" onclick="if(this.value=='FIRST NAME') this.value='';" onblur="if(this.value=='') this.value='FIRST NAME';" name="First name" id="first" style="float:left;margin-right:10px;" />
    <input type="text" class="field" value="LAST NAME" onclick="if(this.value=='LAST NAME') this.value='';" onblur="if(this.value=='') this.value='LAST NAME';" name="Last name" id="last" />
    <br class="clear" />
    <input type="text" class="field" value="EMAIL ADDRESS" onclick="if(this.value=='EMAIL ADDRESS') this.value='';" onblur="if(this.value=='') this.value='EMAIL ADDRESS';" name="Email Address" id="email" style="float:left;margin-right:10px;" />
    <input type="text" class="field" value="ZIP CODE" onclick="if(this.value=='ZIP CODE') this.value='';" onblur="if(this.value=='') this.value='ZIP CODE';" name="Zip Code" id="zip" />
    <input type="hidden" name="Hidden Field" id="hf" value="Texas Station<?=$properties[$signed_request['page']['id']]['name']?>" />
    <br class="clear" />
    <p style="text-align:center;margin-bottom:10px;">ALL FIELDS ARE MANDATORY.</p>
    <p style="text-align:center;margin-bottom:10px;"><span style="font-size:9px;">By checking the box you confirm you are 21+ years of age.</span> <input type="checkbox" name="age" id="age" value="Yes I am 21" />
    &nbsp; &nbsp;<input type="image" src="images/button_enter.jpg" height="23" width="88" alt="Submit" style="margin-bottom:-4px;" /></p>
    <p style="text-align:center;margin-bottom:10px;"><a href="https://www.facebook.com/note.php?note_id=10150326667054175" target="_blank">Contest Rules</a></p>
</form>

</body>
</html>