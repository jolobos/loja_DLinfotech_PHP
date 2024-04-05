<?php
if(!empty($_GET)){
	$msg = $_GET['mens'];
			header('location:login.php?mens='.$msg);

	}

?>