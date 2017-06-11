<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

$con = mysqli_connect("[CLASSIFIED INFORMATION]");
if (!$con) die('Could not connect: ' . mysqli_connect_error());
$sql = "SELECT ID, name FROM 155376_hindaplaces WHERE ID='" . $_GET["index"] . "';";
$result = mysqli_query($con, $sql);
if (!$result) {
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
	exit();
}
$row = mysqli_fetch_array($result);
echo "<div id='currentplace'>Hinda kohta > " . $row["name"] . "</div>";
$_SESSION["current"] = $row["ID"];
mysqli_close($con);
?>