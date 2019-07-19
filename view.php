<html>
<head>
<title>All messages</title>
</head>
<body>
<a href="board.php">Write some messages</a><p>
<?php
session_start();
include "db.php";
$sql = "select * from guestbook";
$result = mysqli_query($db, $sql);
$name = $_SESSION['username'];
while ($row = mysqli_fetch_assoc($result)) {
	echo "No.：" . $row['no'];
	echo "<br><br>Visitor Name：" . $row['name'];
	echo "<br><br>Subject：" . $row['subject'];
	echo "<br><br>Content：" . nl2br($row['content']) . "<br>";
	if ($name == $row['name']) {
		echo '<a href="edit.php?no=' . $row['no'] . '">Edit message content</a>&nbsp|&nbsp<a href="delete.php?no=' . $row['no'] . '">Delete the message</a><br>';
	}
	echo "Time：" . $row['time'] . "<br><br>";
	echo "<hr>";

}
echo "There are " . mysqli_num_rows($result) . " messages.";
?>
<br><a href="login.html">Log out</a><p>
</body>
</html>