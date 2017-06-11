<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	if (isset($_SESSION["username"])) { header("Location: ../admin/");
	} else { header("Location: ../"); }
}

if (isset($_GET["index"])) {
	$con = mysqli_connect("[CLASSIFIED INFORMATION]");
	if (!$con) die('Could not connect: ' . mysqli_connect_error());
	$sql = "SELECT name, address, type FROM 155376_hindaplaces WHERE ID='" . $_GET["index"] . "';";
	$result = mysqli_query($con, $sql);
	if (!$result) { printf("Error: %s\n", mysqli_error($con)); exit(); }
	$row = mysqli_fetch_array($result);
	echo "<div id='add'>Administraarimine > Muuda asutust</div><div id='newplace'>";
	echo "<div id='left'><div id='container'>Nimi:</div><div id='container'>Aadress:</div><div id='container'>Tüüp:</div></div>";
	echo "<div id='right'><form method='post'>";
	echo "<input id='new' type='text' value='" . $row["name"] . "' name='name' placeholder='Nimi'><p>";
	echo "<input id='new' type='text' value='" . $row["address"] . "' name='address' placeholder='Aadress'><p>";
	echo "<select id='newsel' name='type'><option value='Söögikoht' selected>Söögikoht</option><option value='Mingi muu'>Mingi muu</option></select><p>";
	echo "<a href='../' id='back'>< Tagasi</a>";
	echo "<input type='submit' value='Salvesta' id='salv'></form></div></div>";
} else {
	echo "<div id='add'>Administraarimine > Lisa asutus</div><div id='newplace'>";
	echo "<div id='left'><div id='container'>Nimi:</div><div id='container'>Aadress:</div><div id='container'>Tüüp:</div></div>";
	echo "<div id='right'><form method='post'>";
	echo "<input id='new' type='text' name='name' placeholder='Nimi'><p>";
	echo "<input id='new' type='text' name='address' placeholder='Aadress'><p>";
	echo "<select id='newsel' name='type'><option value='Söögikoht' selected>Söögikoht</option><option value='Mingi muu'>Mingi muu</option></select><p>";
	echo "<a href='../' id='back'>< Tagasi</a>";
	echo "<input type='submit' value='Salvesta' id='salv'></form></div></div>";
}

function add() {
	$con = mysqli_connect("[CLASSIFIED INFORMATION]");
	if (!$con) die('Could not connect: ' . mysqli_connect_error());

	$name = strip_tags(mysqli_real_escape_string($con, $_POST["name"]));
	$address = strip_tags(mysqli_real_escape_string($con, $_POST["address"]));
	$type = strip_tags(mysqli_real_escape_string($con, $_POST["type"]));
	if (strlen($name) == 0) {
		echo "<script type='text/javascript'>alert('Palun sisestage toidukoha nimi!');</script>";
		return;
	}
	if (strlen($name) > 255) {
		echo "<script type='text/javascript'>alert('Nimi peab olema lühem kui 255 märki!');</script>";
		return;
	}
	if (strlen($address) == 0) {
		echo "<script type='text/javascript'>alert('Palun lisage aadress!');</script>";
		return;
	}
	if (strlen($address) > 255) {
		echo "<script type='text/javascript'>alert('Aadress peab olema lühem kui 255 märki!');</script>";
		return;
	}
	if (strlen($type) == 0) {
		echo "<script type='text/javascript'>alert('Palun lisage söögikoha tüüp!');</script>";
		return;
	}
	if (strlen($type) > 100) {
		echo "<script type='text/javascript'>alert('Söögikoha tüüp peab olema lühem kui 100 märki!');</script>";
		return;
	}
	if (!isset($_GET["index"])) {
		$sql = "INSERT INTO 155376_hindaplaces (name, address, type) VALUES ('" . $name . "', '" . $address . "', '" . $type . "');";
		if (!mysqli_query($con, $sql)) echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<p>";
	} else {
		$sql = "UPDATE 155376_hindaplaces SET name='$name', address='$address', type='$type' WHERE ID='" . $_GET["index"] . "';";
		if (!mysqli_query($con, $sql)) echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<p>";
	}
	mysqli_close($con);
	header("Location: ../");
}
?>