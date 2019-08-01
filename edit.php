
<title>Edit Message</title>
<?php
include 'style.css';
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
                     <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="no" value="<?=$rs[no]?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
                <input type="hidden" name="name" value="<?=$_GET['name']?>">
                <p><label for="subject">SUBJECT*</label></p>
                <input type="text" name="subject" value="<?=$rs[subject]?>">
                <p><label for="content">CONTENT*</label></p>
                <p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px; height:100px;" name="content"><?=$rs[content]?></textarea></p>
                <p><label for="screenshot">IMAGE</label></p>
                <?php
if ($rs[image]) {?>
                        <p><img src='images/<?=$rs[image]?>' height="100" ></p><br>
                    <?php }?>
                <input type="file" id="screenshot" name="screenshot" />
                <hr />
                <input type="submit" value="SEND" name="submit" />
                    <style>
                        input {padding:5px 15px; background:#FFCCCC; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="REWRITE">
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
	$screenshot = $_FILES['screenshot']['name'];
	if ($screenshot) {
		$sql = "update guestbook set name='$name',subject='$subject',content='$content',image='$screenshot' where no='$no'";
	} else {
		$sql = "update guestbook set name='$name',subject='$subject',content='$content' where no='$no'";
	}
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