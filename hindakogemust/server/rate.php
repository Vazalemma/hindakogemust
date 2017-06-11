<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

function rate() {
	$con = mysqli_connect("[CLASSIFIED INFORMATION]");
	if (!$con) die('Could not connect: ' . mysqli_connect_error());

	$name = strip_tags(mysqli_real_escape_string($con, $_POST["name"]));
	$comment = strip_tags(mysqli_real_escape_string($con, $_POST["comment"]));
	$rating = strip_tags(mysqli_real_escape_string($con, $_POST["rating"]));
	$place = $_GET["index"];

	if (strlen($name) == 0) {
		echo "<script type='text/javascript'>alert('Palun sisestage oma nimi!');</script>";
		return;
	}
	if (strlen($name) > 50) {
		echo "<script type='text/javascript'>alert('Nimi peab olema lühem kui 50 märki!');</script>";
		return;
	}
	if (strlen($comment) == 0) {
		echo "<script type='text/javascript'>alert('Palun lisage ka kommentaar!');</script>";
		return;
	}
	if (strlen($comment) > 255) {
		echo "<script type='text/javascript'>alert('Kommentaar peab olema lühem kui 255 märki!');</script>";
		return;
	}
	$sql = "INSERT INTO 155376_hindarating (username, comment, rating, place) VALUES ('" . $name . "', '" . $comment . "', '" . $rating . "', '" . $place . "');";
	if (!mysqli_query($con, $sql)) echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<p>";
	$sql = "UPDATE 155376_hindaplaces SET average=(SELECT Avg(rating) FROM 155376_hindarating WHERE place=$place), rated=rated+1 WHERE ID = $place;";
	if (!mysqli_query($con, $sql)) echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<p>";
	mysqli_close($con);
	header("Location: ../");
}
?>