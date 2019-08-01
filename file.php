<?php
include 'style.css';
if (is_uploaded_file($_FILES['file']['tmp_name'])) {

	if (isset($_POST['submit'])) {
		echo "isset";
		$name = $_POST['name'];
	}
	if (!file_exists('image')) {
		echo "file doesn't exist";
		mkdir('image');
	}
	var_dump(basename($_FILES['file']['name']));
	$file = 'image/' . basename($_FILES['file']['name']);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
		echo $file, ' Upload successfully！';
		echo '<p>name = ', $name, '</p>';
		echo '<p><img src="', $file, '"></p>';
	} else {
		echo 'Upload failed！';
	}
} else {
	echo 'Please choose a file.';
}
?>
<?php
include 'css.html';
?>
<p>Please choose the file you want to upload.</p>
                        <form action="file.php" method="post" enctype="multipart/form-data">
                            <p><input type="text" name="subject"></p>
                            <p><input type="file" name="file" value="choose"></p>
                            <p><input type="submit" value="START LOADING"></p>
                        </form>

