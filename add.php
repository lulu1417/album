<?php
include "db.php";
$name = $_POST["name"];
$mail = $_POST["mail"];
$subject = $_POST["subject"];
$content = $_POST["content"];
$now = date('Y-m-d H:i:s');

$sql = "INSERT guestbook(name, mail, subject, content, time) VALUES ('$name', '$mail', '$subject', '$content', '$now')";

if (!mysqli_query($db, $sql)) {
	echo "Error";
	// die(mysqli_error());
} else {
	echo "Syntax";
	header("location:view.php");

}
?>
<a href="login.html">Log out</a><p>
