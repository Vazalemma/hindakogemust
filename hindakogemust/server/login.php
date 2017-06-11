<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

function checkLogin() {
	$con = mysqli_connect("[CLASSIFIED INFORMATION]");
	if (!$con) die('Could not connect: ' . mysqli_connect_error());
	$user = strip_tags(mysqli_real_escape_string($con, $_REQUEST["username"]));
	$pass = strip_tags(mysqli_real_escape_string($con, $_REQUEST["password"]));
	$sql = "SELECT username, password FROM 155376_hindausers WHERE username='$user' and password='$pass'";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($result)) {
		if ($row["username"] != null) {
			$_SESSION["username"] = $_REQUEST["username"];
			header("Location: ../");
		}
	}
}
?>