<?

/*<!--require("../dbconnect.php");-->*/

$db = mysql_select_db("scadmin_FB_rooms");

//make sure all data exists
$fields = array("first", "last", "email", "zip", "property", "age");

foreach($fields as $field) {
	if($_POST[$field] == "") { //if field is empty
		$data['result'] = "failed";
		$data['error'] = "Required field missing. (" . $field . ")";
		echo json_encode($data);
		exit;
	}
	$$field = mysql_real_escape_string($_POST[$field]);
}

if (!preg_match('|^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$|i', $_POST['email'])) {
	// email is valid
	$data['result'] = "failed";
	$data['error'] = "Invalid email address.";
	echo json_encode($data);
	exit;
}

//make sure email hasnt entered from this property yet
$query1 = "SELECT id FROM anniversary2 WHERE email = '$email' AND property = '$property' LIMIT 1";
$result1 = mysql_query($query1);

if(@mysql_num_rows($result1) > 0) { 
	//user already entered for this property
	$data['result'] = "failed";
	$data['error'] = "You have already entered the contest for this property.";
	echo json_encode($data);
	exit;
}

//user doesnt exist for this property, add information
$query2 = "INSERT INTO anniversary2 (date, first_name, last_name, email, zip, property, age) VALUES ('" . date("Y-m-d H:i:s", strtotime("-2 hours")) . "', '$first', '$last', '$email', '$zip', '$property', '$age')";
$result2 = mysql_query($query2);

if(!$result2) {
	//something happened with database entry
	$data['result'] = "failed";
	$data['error'] = "There was a problem with your database entry. Please try again later.";
	echo json_encode($data);
	exit;
} else {
	$data['result'] = "success";
	echo json_encode($data);
	exit;
}

?>