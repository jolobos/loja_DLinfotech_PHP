<?php
if(!empty($_GET)){
	$msg = $_GET['mens'];
			header('location:sair.php?mens='.$msg);

	}

?>