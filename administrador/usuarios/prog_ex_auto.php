<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos do sistema - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func_us.js"></script>

</head>
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

}

if(isset($_GET['desativa_tempo_compra'])){
	echo 'desativa por tempo e compra ok';

}

if(isset($_GET['exclui_tempo'])){
	echo 'exclui por tempo ok';

}

if(isset($_GET['exclui_compra'])){
	echo 'exclui por compra ok';

}

if(isset($_GET['exclui_tempo_compra'])){
	echo 'exclui por tempo e compra ok';

}
echo '<br><a class="btn btn-success" href="ex_auto.php">voltar</a>';

?>