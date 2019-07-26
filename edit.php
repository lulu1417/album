
<title>Edit Message</title>
<?php
include 'css.html';
$name = $_GET['name'];
$no = $_GET['no'];
?>

<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='view.php?name=" . $name . "&no=" . $no . "'>View</a>
                        <a href="index.php">Login</a>
                        <a href="signup.php">Register</a>
                </div>

<?php
$db = mysqli_connect("localhost", "root", "0000", "board") or die(mysqli_error());
$query = "SELECT * FROM guestbook WHERE  no=" . $_GET['no'];
$result = mysqli_query($db, $query);
$no = $_GET['no'];
// $setResult=setcookie("no", "$_COOKIE["no"]", time()+7200);
while ($rs = mysqli_fetch_array($result)) {
	?>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="edit.php" method="post">
                        <input type="hidden" name="no" value="<?=$rs[no]?>">
                        <input type="hidden" name="name" value="<?=$_GET['name']?>">
                        <p>SUBJECT</p>
                        <input type="text" name="subject" value="<?=$rs[subject]?>">
                        <p>CONTENT</p>
                        <textarea style="width:550px; height:100px;" name="content"><?=$rs[content]?></textarea>
                        <p><input type="submit" name="submit" value="Save">
                    <style>
                        input {padding:5px 15px; background:#ccc; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="Rewrite">
                    <style>
                        input {
                            padding:5px 15px;
                            background:#FFCCCC;
                            border:0 none;f
                            cursor:pointer;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            font-family: 'Nunito', sans-serif;
                            font-size: 19px;
                        }
                    </style>
                    </form>
                </div>

</body>
</html>
<?php }

if (isset($_POST[submit])) {

	$no = $_POST['no'];
	$name = $_POST[name];
	$subject = $_POST["subject"];
	$content = $_POST["content"];

	$sql = "update guestbook set subject='$subject',content='$content' where no='$no'";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error());
	} else {
		echo "
         <script>
            setTimeout(function(){window.location.href='view.php?name=" . $name . "&no=" . $no . "';},200);
        </script>";

	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}
?>