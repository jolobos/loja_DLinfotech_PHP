<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_GET['id_usuario'])){	
	$id_usuario = $_GET['id_usuario'];
	$sql = "SELECT * FROM usuarios WHERE id_usuario='".$id_usuario."'";
	$consulta = $conexao->query($sql);
	$dados = $consulta->fetch(PDO::FETCH_ASSOC);
}
if(!empty($_GET['ativa'])){	
	$valor = 1;
	$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($valor,$id_usuario));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Tudo certo!';
				}else{
					$msg='Não foi dessa vez!'.$r->getMessage().'';
			}
			header('location:us_opcoes.php?mensagem='.$msg.'&id_usuario='.$id_usuario); 

}
if(!empty($_GET['desativa'])){	
	$valor = 0;
	$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($valor,$id_usuario));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Tudo certo!';
				}else{
					$msg='Não foi dessa vez!'.$r->getMessage().'';
			}
			header('location:us_opcoes.php?mensagem='.$msg.'&id_usuario='.$id_usuario); 

}