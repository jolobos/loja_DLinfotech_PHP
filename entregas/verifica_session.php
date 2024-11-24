<?php
session_start();
if(empty($_SESSION['id_entregador'])){
	session_destroy();
	}else{
	$id_entregador = $_SESSION['id_entregador'];
        $nivel = $_SESSION['nivel'];
        $CPF = $_SESSION['CPF'];
        $nome = $_SESSION['nome'];
        $foto = $_SESSION['foto'];
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