<?php
require_once('../../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../../database.php");

if(isset($_GET['cancelar_compra'])){
		$id_compra = $_GET['cancelar_compra'];
		$id_usuario = $_GET['id_usuario'];
		$sql ='DELETE FROM compras WHERE id_compra = ?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($id_compra));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$sql ='DELETE FROM itens_da_compra WHERE id_compra = ?';
				try {
				$insercao1 = $conexao->prepare($sql);
				$ok = $insercao1->execute(array ($id_compra));
				}catch(PDOException $r){
					//$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
					
				}
				$msg= 'Compra deletada com sucesso.';
				
				}else{
					$msg='Compra não deletada. Erro.'.$r->getMessage();
			}
			header('location:compras_us.php?mensagem='.$msg.'&id_usuario='.$id_usuario);//redireciona para local especificado
			}
?>