<?php
session_start();
if($_SESSION['email']==''){
	$msg = 'voce nao esta logado';
	session_destroy();
	header('location:index.php?mens='.$msg);
}

if (!empty($_SESSION['decorrido'])) {
	$tempo = time() - $_SESSION['decorrido'];
	if ($tempo>$_SESSION['vida']){
		$msg = 'Sua sessão expirou!';
		session_destroy();
		header('location:../index.php?mens='.$msg);
	} else {
		$_SESSION['decorrido'] = time();
	}
}

?>