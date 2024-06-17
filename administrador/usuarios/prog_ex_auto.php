<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['desativa_tempo'])){
	$tempo = $_GET['desativa_tempo'];
	$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;
		
		$sql = "SELECT * FROM usuarios WHERE data_entrada >=".$periodo." ORDER BY data_entrada DESC";
		$consulta = $conexao->query($sql);
		$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	
	foreach($dados as $d){
		$valor = 0;
		$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($valor,$d['id_usuario']));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
		
		
	}
	header('location:ex_auto.php');

}

if(isset($_GET['desativa_compra'])){
	$compras = $_GET['desativa_compra'];
    if($compras == 0 )
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	}else{
	$sql_b = "SELECT id_usuario,COUNT(id_usuario) AS id_us FROM compras GROUP BY id_usuario";
	$consulta_b = $conexao->query($sql_b);
	$dados_b = $consulta_b->fetchALL(PDO::FETCH_ASSOC);
	}
	
	if(!empty($dados)){		
		foreach($dados as $d){
			$valor = 0;
			$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
			try {
			$insercao = $conexao->prepare($sql);
			$ok = $insercao->execute(array($valor,$d['id_usuario']));
			}catch(PDOException $r){
				$msg= 'Problemas com o SGBD.'.$r->getMessage();
				$ok = False;
			}catch (Exception $r){//todos as exceções
			$ok= False; 
			
		}echo '<br>'.$d['nome'].' Desativado 1';
	}}else if(!empty($dados_b)){		
		foreach($dados_b as $d_b){ 
				if($d_b['id_us'] == $compras){
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				
				$valor = 0;
				$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
				try {
				$insercao = $conexao->prepare($sql);
				$ok = $insercao->execute(array($valor,$d['id_usuario']));
				}catch(PDOException $r){
					$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
			
		}echo '<br>'.$d['nome'].' Desativado 2';
		}}
		}
	header('location:ex_auto.php');	

}

if(isset($_GET['desativa_tempo_compra'])){
	$compras = $_GET['desativa_tempo_compra'];
        $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	$consulta = $conexao->query($sql);
	$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

        foreach($dados as $d_b){ 
				$tempo = $compras;
				$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;	
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']." AND data_entrada >= ".$periodo."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);	
                                if(!empty($d)){
                                $valor = 0;
				$sql ='UPDATE usuarios SET status=? WHERE id_usuario=?';
				try {
				$insercao = $conexao->prepare($sql);
				$ok = $insercao->execute(array($valor,$d['id_usuario']));
				}catch(PDOException $r){
					$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
			
                                }}
}	header('location:ex_auto.php');	
}

if(isset($_GET['exclui_tempo'])){
        $tempo = $_GET['exclui_tempo'];
	$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;
		
		$sql = "SELECT * FROM usuarios WHERE data_entrada >=".$periodo." ORDER BY data_entrada DESC";
		$consulta = $conexao->query($sql);
		$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	
	foreach($dados as $d){
		
		$sql ='DELETE FROM usuarios WHERE id_usuario=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($d['id_usuario']));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
		
		
	}
	header('location:ex_auto.php');	

}

if(isset($_GET['exclui_compra'])){
	$compras = $_GET['exclui_compra'];
    if($compras == 0 )
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	}else{
	$sql_b = "SELECT id_usuario,COUNT(id_usuario) AS id_us FROM compras GROUP BY id_usuario";
	$consulta_b = $conexao->query($sql_b);
	$dados_b = $consulta_b->fetchALL(PDO::FETCH_ASSOC);
	}
	
	if(!empty($dados)){		
		foreach($dados as $d){
			$sql ='DELETE FROM usuarios WHERE id_usuario=?';
			try {
			$insercao = $conexao->prepare($sql);
			$ok = $insercao->execute(array($d['id_usuario']));
			}catch(PDOException $r){
				$msg= 'Problemas com o SGBD.'.$r->getMessage();
				$ok = False;
			}catch (Exception $r){//todos as exceções
			$ok= False; 
			
		}
	}}else if(!empty($dados_b)){		
		foreach($dados_b as $d_b){ 
				if($d_b['id_us'] == $compras){
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				
				$valor = 0;
				$sql ='DELETE FROM usuarios WHERE id_usuario=?';
				try {
				$insercao = $conexao->prepare($sql);
				$ok = $insercao->execute(array($d['id_usuario']));
				}catch(PDOException $r){
					$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
			
		}
		}}
		}
	header('location:ex_auto.php');	

}

if(isset($_GET['exclui_tempo_compra'])){
	$compras = $_GET['exclui_tempo_compra'];
        $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	$consulta = $conexao->query($sql);
	$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

        foreach($dados as $d_b){ 
				$tempo = $compras;
				$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;	
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']." AND data_entrada >= ".$periodo."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);	
                                if(!empty($d)){
                                
				$sql ='DELETE FROM usuarios WHERE id_usuario=?';
				try {
				$insercao = $conexao->prepare($sql);
				$ok = $insercao->execute(array($d['id_usuario']));
				}catch(PDOException $r){
					$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
			
                                }}
}
	header('location:ex_auto.php');	

                                }

echo '<br><a class="btn btn-success" href="ex_auto.php">voltar</a>';

?>