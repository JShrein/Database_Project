<?php
	$folder = './profile/images/';
	$upload = $folder . basename($_FILES['imfile']['name']);

	if(move_uploaded_file($_FILES['imfile']['tmp_name'], $upload)) {
		$_SESSION['uploadmsg'] = "Image uploaded successfully";
	} else {
		$_SESSION['uploadmsg'] = "Possible attack detected!";
	}

	

	echo $upload;
	//echo "<img src='$img' />"
?>