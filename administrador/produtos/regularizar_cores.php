<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!isset($_SESSION['produto_escolhido'])){
        header('location:linkar_produto.php');
}else{
     header('location:linkar_produto.php?feito');
}