<?php
if(!empty($_GET)){
	$msg = $_GET['mens'];
			header('location:usuario/login.php?mens='.$msg);

	}

?>