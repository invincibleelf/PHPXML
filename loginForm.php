<?php
session_start ();
$captchaError = "";
$userNameError = "";
$PasswordError = "";
$username = $_POST ['username'];
$password = $_POST ['password'];
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	include_once 'securimage/securimage.php';
	$secureImage = new Securimage ();
	$userNameError = validateInputRequired ( $_POST ['username'] );
	$PasswordError = validateInputRequired ( $_POST ['password'] );
	$captchaError = validateCaptcha ( $_POST ['captcha_code'], $secureImage );
	
	if ($captchaError != "" || $userNameError != "" || $PasswordError != "") {
		$location = "index.php?";
		if ($userNameError != "") {
			$location .= "userNameError=" . $userNameError . "&";
		}
		if ($PasswordError != "") {
			$location .= "passwordError=" . $PasswordError . "&";
		}
		if ($captchaError != "") {
			$location .= "captchaError=" . $captchaError . "&";
			header ( "Location:" . $location );
		}
	} else {
		
		/* Set oracle user login and password info */
		$dbuser = "sshara"; /* your deakin login */
		$dbpass = "root"; /* your oracle access password */
		$db = "SSID";
		$connect = OCILogon ( $dbuser, $dbpass, $db );
		if (! $connect) {
			echo "An error occurred connecting to the database";
			exit ();
		}
		
		/* build sql statement using form data */
		$query = "SELECT * FROM login where username='" . $username . "' and password='" . $password . "'";
		/* check the sql statement for errors and if errors report them */
		$stmt = OCIParse ( $connect, $query );
		// echo "SQL: $query<br>";
		if (! $stmt) {
			echo "An error occurred in parsing the sql string.\n";
			exit ();
		}
		OCIExecute ( $stmt );
		$valid = false;
		while ( OCIFetch ( $stmt ) ) {
			$valid = true;
		}
		
		if ($valid) {
			setcookie ( 'user', $username, 3600 );
			echo "welcome";
		} else
			echo "invalid username/password";
	}
}
function validateInputRequired($input) {
	if ($input == "") {
		return "Required";
	} else {
		// Check for other validations
	}
}
function validateCaptcha($captchaCode, $secureImage) {
	if ($secureImage->check ( $captchaCode ) == false) {
		return "Wrong Captcha";
	}
}
?>
