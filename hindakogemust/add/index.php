<?php
session_start();
include "../server/rate.php";
if (!isset($_GET["index"])) header("Location: ../");
if (!is_numeric($_GET["index"])) header("Location: ../");
if (isset($_POST["name"]) and isset($_POST["comment"]) and isset($_POST["rating"])) rate();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<title>Stuff</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include "../server/getCurrentPlace.php"; ?>
<div id="fulladd">
	<div id="labels"><div id="label1">Nimi:</div><div id="label2">Kommentaar:</div><div id="label3">Hinnang:</div></div>
	<form method="post" id="rate">
		<input type="text" name="name" placeholder="nimi" id="namefield">
		<textarea name="comment" placeholder="kommentaar" id="textfield"></textarea>
		<span class="rating">
  			<input id="rating10" type="radio" name="rating" value="10">
  			<label for="rating10">10</label>
  			<input id="rating9" type="radio" name="rating" value="9">
  			<label for="rating9">9</label>
  			<input id="rating8" type="radio" name="rating" value="8">
  			<label for="rating8">8</label>
  			<input id="rating7" type="radio" name="rating" value="7">
  			<label for="rating7">7</label>
  			<input id="rating6" type="radio" name="rating" value="6">
  			<label for="rating6">6</label>
  			<input id="rating5" type="radio" name="rating" value="5" checked>
  			<label for="rating5">5</label>
  			<input id="rating4" type="radio" name="rating" value="4">
  			<label for="rating4">4</label>
  			<input id="rating3" type="radio" name="rating" value="3">
  			<label for="rating3">3</label>
  			<input id="rating2" type="radio" name="rating" value="2">
  			<label for="rating2">2</label>
  			<input id="rating1" type="radio" name="rating" value="1">
  			<label for="rating1">1</label>
		</span>
		<a href="../" id='back'>< Tagasi</a>
		<input type="submit" value="Saada" id="submitrating">
	</form>
</div>
<div id="others">Teiste hinnangud:</div>
<?php include "../server/getRatings.php"; ?>
</body>
</html>