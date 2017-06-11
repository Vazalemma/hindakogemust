<?php
session_start();
include "../../server/login.php";
if (isset($_REQUEST["username"]) and isset($_REQUEST["password"])) checkLogin();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="loginfull">
	<div id="msg">Logi sisse</div>
	<div id="labels"><div id="label">Kasutajanimi:</div><div id="label">Parool:</div></div>
	<div id="login">
		<form method="post" id="loginform">
			<input type="text" id="form" name="username" placeholder="User name">
			<input type="password" id="form" name="password" placeholder="Password">
			<input type="submit" id="formsubmit" value="Login">
		</form>
	</div>
</div>
</body>
</html>