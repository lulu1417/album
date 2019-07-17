<html>
<head>
<title>All messages</title>
</head>
<body>
<a href="board.php">Write some messages</a><p>
<?php
include "db.php";
$sql = "select * from guestbook";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	echo "No.：" . $row['no'];
	echo "<br><br>Subject：" . $row['subject'];
	echo "<br><br>Visitor Name：" . $row['name'];
	echo "<br><br>E-mail：<a href='board.php'>" . $row['mail'] . "</a>";
	echo "<br><br>Content：" . nl2br($row['content']) . "<br><br>";
	echo "<br><br>Time：" . $row['time'];
	echo "<hr>";
}
echo "There are " . mysqli_num_rows($result) . " messages.";
?>
<br><a href="login.html">Log out</a><p>
</body>
</html>