<?php
if (strpos($_SERVER['PHP_SELF'], '/server/') !== false) {
	header("Location: ../");
}

if (!isset($_SESSION["username"])) {
	header("Location: http://dijkstra.cs.ttu.ee/~heouna/hindakogemust/admin/login/index.php");
}
?>