<?php
session_start();
include "db.php";
$name = $_SESSION['username'];
$subject = $_POST["subject"];
$content = $_POST["content"];
$sql = "update guestbook set subject='$subject',content='$content'
where no='$_SESSION[no]'";

if (!mysqli_query($db, $sql)) {
	die(mysqli_error());
} else {
	echo "Syntax";
	header("location:view.php");

}
