<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');



if(isset($_POST['forma_pagamento'])){
	echo $_POST['forma_pagamento'].'<br>';
	var_dump($_SESSION['produto_carrinho']);
	echo '<br>';
	var_dump($_SESSION['endereco']);
	echo '<br>';
	var_dump($_SESSION['id_usuario_1']);
	echo '<br>';
	
	
	
	
}


?>