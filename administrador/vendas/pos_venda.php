<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');



if(!empty($_POST['forma_pagamento'])){
	if(empty($_SESSION['produto_carrinho'])){
		header("location:select_prod.php?mensagem=Lista de produtos está vazia.");
	}
	if(empty($_SESSION['endereco'])){
		header("location:conf_venda.php?mensagem=Nenhum endereço para a entrega foi adicionado à compra.");
	}
	if(empty($_SESSION['id_usuario_1'])){
		header("location:checkout.php?mensagem=A venda não esta vinculada a nenhum cliente.");
	}
	
	
	
	
	
	
}


?>