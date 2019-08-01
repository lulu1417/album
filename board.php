<title>Board</title>
<?php
include 'style.css';
$name = $_GET['name'];
?>

<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='view.php?name=<?=$name?>'>View</a>
                        <a href="index.php">Logout</a>
                        <a href="signup.php">Register</a>
                </div>
      <div class="content">
                <div class="m-b-md">
                      <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
                <input type="hidden" name="name" value="<?=$name?>"/>
                <p><strong><?="Hi, " . $name?></strong>  ʕ•ᴥ•ʔ</p>
                <p><label for="subject">SUBJECT*</label></p>
                <input type="text" id="subject" name="subject" value="<?php if (!empty($subject)) {
	// echo $subject;
}
?>" /><br />
                 <p><label for="content">CONTENT*</label></p>
                 <p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px;height:100px;" name="content"></textarea></p>
                 <p><label for="screenshot">IMAGE</label></p>
                <input type="file" id="screenshot" name="screenshot" />
                <hr />
                <input type="submit" value="SEND" name="submit" />
                    <style>
                        input {padding:5px 15px; background:#FFCCCC; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="RESET">
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

<?php
require_once 'appvars.php';

if (isset($_POST['submit'])) {
	// Grab the score data from the POST
	include "db.php";
	$name = $_POST['name'];
	$subject = $_POST["subject"];
	$content = $_POST["content"];
	$screenshot = $_FILES['screenshot']['name'];
	$screenshot_type = $_FILES['screenshot']['type'];
	$screenshot_size = $_FILES['screenshot']['size'];

	if ($subject && $content) {
		if ($screenshot) {
			if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
				&& ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
				if ($_FILES['screenshot']['error'] == 0) {
					// Move the file to the target upload folder
					$target = GW_UPLOADPATH . $screenshot;
				}
				if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target) || empty($screenshot)) {
					// Connect to the database
					// Write the data to the database
					$query = "INSERT INTO guestbook(name, subject, content, image ,time) VALUES ('$name', '$subject', '$content', '$screenshot', now())";
					if (!mysqli_query($db, $query)) {
						var_dump(mysqli_error());
					}
					echo "
                <script>
                setTimeout(function(){window.location.href='view.php?name=" . $name . "';},10);
                </script>";

					// Clear the score data to clear the form
					$content = "";
					$subject = "";
					$screenshot = "";

					mysqli_close($db);
				} else {
					echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
				}
			}
		} else {
			$query = "INSERT INTO guestbook(name, subject, content, time) VALUES ('$name', '$subject', '$content', now())";
			if (!mysqli_query($db, $query)) {
				var_dump(mysqli_error());
			}
			// Confirm success with the user
			echo "
                <script>
                setTimeout(function(){window.location.href='view.php?name=" . $name . "';},10);
                </script>";

			// Clear the score data to clear the form
			$content = "";
			$subject = "";
			$screenshot = "";

			mysqli_close($db);

		}

		// Try to delete the temporary screen shot image file
		@unlink($_FILES['screenshot']['tmp_name']);
	} else {
		echo '<p class="error">Please enter all of the information to add your message.</p>';
		echo "
                <script>
                setTimeout(function(){window.location.href='board.php?name=" . $name . "';},1500);
                </script>";
	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}
