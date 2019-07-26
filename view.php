<title>All messages</title>
<?php
include 'css.html';
$name = $_GET['name'];
?>
<body>
	<div class="home top-right">
<?php
echo "<a href='board.php?name=" . $name . "'>Write some messages</a>"
?>
<a href="index.php">Log out</a>
</div>
<div class="note full-height">
<?php
session_start();
include "db.php";
$sql = "select * from guestbook";
$result = mysqli_query($db, $sql);
$_SESSION['name'] = $name = $_GET['name'];

while ($row = mysqli_fetch_assoc($result)) {
	echo "<br>Visitor Name：" . $row['name'];
	echo "<br>Subject：" . $row['subject'];
	echo "<br>Content：" . nl2br($row['content']) . "<br>";
	if ($name == $row['name']) {
		echo '
		<a href=" edit.php?no=' . $row['no'] . '&name=' . $name . '">
		Edit message content</a>&nbsp|&nbsp<a href="delete.php?no=' . $row['no'] . '">Delete the message</a><br>';
	}
	echo "Time：" . $row['time'] . "<br>";
	echo "<hr>";

}
echo "<br>";
echo '<div class="bottom left position-abs content">';
echo "There are " . mysqli_num_rows($result) . " messages.";
?>
</div>
</body>
</html>