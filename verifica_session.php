<?php
session_start();
if($_SESSION['usuario']==''){
	$msg = 'voce nao esta logado';
	session_destroy();
	header('location:index.php?mens='.$msg);
}

if($_SESSION['nivel']<$nivel){
	$msg= 'voce nao tem permicao!!!';
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