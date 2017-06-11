<?php
session_start();
include "../../server/validate.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<title>Hinda kogemust</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include "../../server/addPlaces.php";
	if (isset($_POST["name"]) and isset($_POST["address"]) and isset($_POST["type"])) add();
	?>
</body>
</html>