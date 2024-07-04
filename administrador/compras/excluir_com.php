<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_GET['excluir_compra'])){
	$exc = $_GET['excluir_compra'];
	$sql ='DELETE FROM itens_da_compra WHERE id_compra = ?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($exc));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	
	if($ok){
		$sql1 ='DELETE FROM compras WHERE id_compra = ?';
		try {
			$insercao1 = $conexao->prepare($sql1);
		$ok1 = $insercao1->execute(array ($exc));
		}catch(PDOException $r){
	//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok1 = False;
		}catch (Exception $r){//todos as exceções
		$ok1= False; 
		}
		
	}
	
	if($ok1){
		$msg = 'Compra excluida com sucesso.';
		header("location:compras.php?msg=".$msg);
	}
}
?>