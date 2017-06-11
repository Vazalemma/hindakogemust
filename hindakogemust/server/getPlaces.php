<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

if (!isset($_SESSION["type"])) $_SESSION["type"] = "average";
if (!isset($_SESSION["order"])) $_SESSION["order"] = "DESC";
if (!isset($_SESSION["page"])) $_SESSION["page"] = 0;
if (!isset($_SESSION["search"])) $_SESSION["search"] = "";

$count = 10;
$type = $_SESSION["type"];

if (isset($_POST["name"])) {
	$type = "name";
	$_SESSION["page"] = 0;
}
if (isset($_POST["address"])) {
	$type = "address";
	$_SESSION["page"] = 0;
}
if (isset($_POST["average"])) {
	$type = "average";
	$_SESSION["page"] = 0;
}
if (isset($_POST["rated"])) {
	$type = "rated";
	$_SESSION["page"] = 0;
}
if (isset($_POST["search"])) {
	$_SESSION["search"] = $_POST["search"];
}

if (isset($_POST["prev"])) { if ($_SESSION["page"] != 0) $_SESSION["page"] -= 1; }
if (isset($_POST["next"])) $_SESSION["page"] += 1;

if (!isset($_POST["prev"]) && !isset($_POST["next"])) {
	if ($type != $_SESSION["type"]) {
		$_SESSION["type"] = $type;
		$_SESSION["order"] = "DESC";
	} else {
		if ($_SESSION["order"] == "DESC") { $_SESSION["order"] = "ASC";
		} else { $_SESSION["order"] = "DESC"; }
	}
}


$con = mysqli_connect("[CLASSIFIED INFORMATION]");
if (!$con) die('Could not connect: ' . mysqli_connect_error());
$sql = "SELECT ID, name, address, average, rated FROM 155376_hindaplaces " .
	"WHERE name LIKE '%" . $_SESSION["search"] . "%' ORDER BY " . $_SESSION["type"] . " " . $_SESSION["order"] . " LIMIT 11 OFFSET " .
	$count * $_SESSION['page'] . ";";
$result = mysqli_query($con, $sql);
if (!$result) {
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
	exit();
}

echo "<div id='choose'>Valige asutus mida hinnata</div>";
echo "<div id='table'><form method='post' id='search'><input type='text' name='search' value='" . $_SESSION["search"] . "' placeholder='Otsi'></form>";
echo "<table id='places'><tr>";
echo "<th></th>";
echo "<th><form method='post' id='colname'><input type='submit' value='Nimi' id='cellbutton' name='name'></form></th>";
echo "<th><form method='post' id='coladdress'><input type='submit' value='Asukoht' id='cellbutton' name='address'></form></th>";
echo "<th><form method='post' id='colaverage'><input type='submit' value='Keskmine hinne' id='cellbutton' name='average'></form></th>";
echo "<th><form method='post' id='colrated'><input type='submit' value='Hinnatud (korda)' id='cellbutton' name='rated'></form></th></tr>";

$x = 0;
while ($row = mysqli_fetch_array($result)) {
	if ($x == 10) { $x = 11; break; }
	echo "<tr><th><a href='add/?index=" . $row["ID"] . "' id='invis'>Edit</a></th>";
	echo "<td>" . $row["name"] . "</td>";
	echo "<td>" . $row["address"] . "</td>";
	echo "<td>" . round($row["average"], 1) . "</td>";
	echo "<td>" . $row["rated"] . "</td></tr>";
	$x += 1;
}
echo "</table>";
echo "<form method='post' id='prevnextform'>";
mysqli_close($con);

if ($_SESSION["page"] != 0) { echo "<input type='submit' value='< Eelmised' name='prev' id='prevnext'>";
} else { echo "<input type='submit' value='< Eelmised' id='prevnext' disabled>"; }
if ($x <= 10) { echo "<input type='submit' value='Järgmised >' id='prevnext' disabled>";
} else { echo "<input type='submit' value='Järgmised >' name='next' id='prevnext'>"; }
echo "</form></div>";
?>