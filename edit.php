 <?php
session_start();
$db = mysqli_connect("localhost", "root", "0000", "board") or die(mysqli_error());
$query = "SELECT * FROM guestbook WHERE  no=" . $_GET['no'];
$result = mysqli_query($db, $query);
$_SESSION[no] = $_GET['no'];
while ($rs = mysqli_fetch_array($result)) {
	?>
	<form name="form1" method="post" action="alter.php">
     Subject：<input type="text" name="subject" value="<?=$rs[subject]?>"><br><br>
     Content：<textarea rows=7 name="content"><?=$rs[content]?></textarea><br>
     <INPUT TYPE="submit" name="submit" value="Send"/> <input type="reset" name="reset" value="rewrite">
 </form>
 <?php }?>