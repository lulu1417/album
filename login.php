<?php
header("Content-Type: text/html; charset=utf8");
if (!isset($_POST["submit"])) {
	exit("excution error");
}
include 'db.php';
$name = $_POST['name'];
$password = $_POST['password'];

if ($name && $password) {
	$sql = "select * from user where username = '$name' and password='$password'";
	$resultl = mysqli_query($db, $sql);
	$rows = mysqli_num_rows($resultl);
	if ($rows) {
		header("refresh:0;url=welcome.html");
		exit;
	} else {
		echo "Wrong username or password";
		echo "
	<script>
	setTimeout(function(){window.location.href='login.html';},2000);
	</script>
";
	}
} else {

	echo "Incompleted form";
	echo "
<script>
setTimeout(function(){window.location.href='login.html';},2000);
</script>";
}
mysqli_close();
?>
<br><br><a href="signup.html">Sign up now</a><p>