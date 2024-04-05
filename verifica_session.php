<?php
session_start();
if(empty($_SESSION['id_usuario'])){
	$logado = 0;
	session_destroy();
	}else{
	$logado = 1;
        $id_usuario = $_SESSION['id_usuario'];
        $email = $_SESSION['email'];
        $nome = $_SESSION['nome'];
        $foto = $_SESSION['foto'];
        $apelido = $_SESSION['apelido'];
	}

if (!empty($_SESSION['decorrido'])) {
	$tempo = time() - $_SESSION['decorrido'];
	if ($tempo>$_SESSION['vida']){
		$msg = 'Sua sessão expirou!';
		session_destroy();
		header('location:session_exp.php?mens='.$msg);
	} else {
		$_SESSION['decorrido'] = time();
	}
}

?>