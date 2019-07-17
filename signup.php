<?php
header("Content-Type: text/html; charset=utf8");
if (!isset($_POST['submit'])) {
	exit("execution error!!");
}
include 'db.php';
$name = $_POST['name'];
$password = $_POST['password'];

if ($name && $password) {
	$sql = "select * from user where username = '$name'";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_num_rows($result);
	if (!$rows) {
		//帳號未被使用
		$sql = "insert user(id,username,password) values (null,'$name','$password')";
		mysqli_query($db, $sql);

		if (!$result) {
			die('Error: ' . mysql_error());
		} else {
			echo "Sign up Sucessefully!";

			header("refresh:0;url=login.html");
			//exit;
		}
	} else {
		//帳號已被使用
		echo "The username have already been used!!";
		echo "
			<script>
			setTimeout(function(){window.location.href='login.html';},3000);
			</script>
		";
	}
} else {

	echo "Incompleted form";
	echo "
		<script>
		setTimeout(function(){window.location.href='login.html';},3000);
		</script>
	";
}

mysqli_close($db);
?>
