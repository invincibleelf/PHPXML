<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIT780 assignment 2 homepage</title>
<link rel="stylesheet" type="text/css" href="styles/style.css">

</head>

<body>
	
	<div class="container">
	<h1>SIT780 Assignemt 2 PHPXML</h1>
		<form name="loginForm" method="post" action="loginForm.php">
			
   	 			<?php require_once 'securimage/securimage.php';?>
   	 			<div class = "formElement">
   	 				Username
   	 				<input type="text" name="username"/><br/>
   	 				<span class="error"><?php echo $_GET['userNameError']; ?></span>
   	 			</div>
   	 			<div class = "formElement">
   	 				Password
   	 				<input type="password" name="password"/><br/>
   	 				<span class="error"><?php echo $_GET['passwordError']; ?></span>
   	 			</div>
				<div class = "formElement">
					<img id="captcha" src="securimage/securimage_show.php"
						alt="CAPTCHA Image" /><br/>
					Captcha
					<input type="text" name="captcha_code" size="10" maxlength="6" />
					
					<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">
						New Captcha?</a><br/>
						<span class="error"><?php echo  $_GET['captchaError'];; ?></span>
				</div> 
				<div class = "formElement">

				<input type="submit" />
				</div>
			

		</form>

</body>
</html>
