<?php
session_start();
include "db.php";

$db = mysqli_connect("localhost", "root", "0000", "board") or die(mysqli_error());
$no = $_GET['no'];
$sql = "delete from guestbook where no='$no'";
mysqli_query($db, $sql);
if (!mysqli_query($db, $sql)) {
	die(mysqli_error());
} else {
	echo "Syntax";
	header("location:view.php");

}
