<?php
include 'style.css';
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	if (!file_exists('upload')) {
		echo "file doesn't exist";
		mkdir('upload');
	}
	var_dump(basename($_FILES['file']['name']));
	$file = 'image/' . basename($_FILES['file']['name']);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
		echo $file, ' Upload successfully！';
		echo '<p><img src="', $file, '"></p>';
	} else {
		echo 'Upload failed！';
	}
} else {
	echo 'Please choose a file.';
}
