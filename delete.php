<?php
session_start();
include "db.php";

$db = mysqli_connect("localhost", "root", "0000", "board") or die(mysqli_error());
$no = $_GET['no'];
$sql = "delete from guestbook where no='$no'";
$name = $_SESSION['name'];
mysqli_query($db, $sql);
if (!mysqli_query($db, $sql)) {
	die(mysqli_error());
} else {
	echo "
         <script>
            setTimeout(function(){window.location.href='view.php?name=" . $name . "&no=" . $no . "';},300);
        </script>";

}
