<?php
if(!empty($_GET)){
	$msg = $_GET['mens'];
			header('location:index.php?mens='.$msg);

	}

?>