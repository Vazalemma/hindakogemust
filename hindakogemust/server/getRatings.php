<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

$con = mysqli_connect("[CLASSIFIED INFORMATION]");
if (!$con) die('Could not connect: ' . mysqli_connect_error());
if (isset($_POST["del"])) {
	$sql = "DELETE FROM 155376_hindarating WHERE ID='" . $_POST["del"] . "';";
	$result = mysqli_query($con, $sql);
	if (!$result) {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		exit();
	}
	$sql = "UPDATE 155376_hindaplaces SET average=(SELECT Avg(rating) FROM 155376_hindarating WHERE place='" . $_SESSION["current"] . "'), rated=rated-1 WHERE ID='" . $_SESSION["current"] . "';";
	if (!mysqli_query($con, $sql)) echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<p>";
}
$sql = "SELECT ID, username, comment, rating FROM 155376_hindarating WHERE place='" . $_GET["index"] . "';";
$result = mysqli_query($con, $sql);
if (!$result) {
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
	exit();
}

while ($row = mysqli_fetch_array($result)) {
	echo "<div id='rating'><b id='bold'>" . $row["username"] . " (" . $row["rating"] . " / 10)</b>";
	if (isset($_SESSION["username"])) echo "<form method='post' id='delcom'><input type='submit' value='Kustuta' id='delbut'><input style='display: none' name='del' value='".$row["ID"]."'></form>";
	echo "<br>" . $row["comment"] . "</div>";
}
mysqli_close($con);
?>