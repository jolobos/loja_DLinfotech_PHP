<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['ver'])){
		$valor = 0;
		$id = $_GET['ver'];
		$sql = "SELECT * FROM notificacoes_entregas WHERE id_notificacao= '".$id."'";
		$consulta = $conexao->query($sql);
		$dados_ab = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$sql ='UPDATE notificacoes_entregas SET condicao=? WHERE id_notificacao=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($valor,$id));
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
		
}
//echo '<div style="margin-top: 105px;">'.$msg.'</div>';
?>

<!doctype html>
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
</head>
  <body style="background: #778899">
    <div class="container">
        <div class="bg-dark">
            <div class="row">
                <div class="col" >
                    <h1 class="text-success ms-3">
                        Sistema de entregas DL
                    </h1>
                </div>
                <div class="col" align="right">
                    <a class="btn btn-secondary border-info m-2" href="../home.php">INICIO</a>
                    <a href="../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
                </div>
            </div>
                
           <?php echo '<img src="../../img/foto_usuario/'.$foto.'" style="border-radius: 50%;width:50px;height:50px;align=left;margin-left:20px;margin-bottom:15px;">';
           echo '<strong class="text-success"> - '.$nome.' </strong>';
           ?>
	</div>
<div class="container" >
    <h3 class="text-info">Notificações</h3>
    <hr>
	<div class="row m-3">
	<div class="col">
	<h4>Mensagem: </h4>
	</div>
	<div class="col" align="right">
	<?php
	echo '<a href="notificacoes.php?excluir='.$dados_ab['id_notificacao'].'" class="btn btn-danger me-2">Excluir</a>
	<a href="notificacoes.php" class="btn btn-secondary">Voltar</a>';
	?>		
	</div>
	</div>
	<div class="card mb-5">
		<div class="card-header">
			<?php echo '<h3>'.$dados_ab['titulo'].'</h3>'; ?>
		</div>
		<div class="card-body overflow-auto" style="max-height: 400px">
			<?php echo '<P>'.$dados_ab['conteudo'].'</p>'; ?>

		</div>
		<div class="card-footer">
		<div class="row">
			<?php
				
				if(!empty($dados_ab['link_1'])){
					echo '<div class="col-sm-4"><p>Link 1: <a href="//'.$dados_ab['link_1'].'" target="_blank">'.$dados_ab['link_1'].'</a></p></div>';
					
				}
				if(!empty($dados_ab['link_2'])){
					echo '<div class="col-sm-4"><p>Link 2: <a href="//'.$dados_ab['link_2'].'" target="_blank">'.$dados_ab['link_2'].'</a></p></div>';
					
				}
				if(!empty($dados_ab['link_3'])){
					echo '<div class="col-sm-4"><p>Link 3: <a href="//'.$dados_ab['link_3'].'" target="_blank">'.$dados_ab['link_3'].'</a></p></div>';
					
				}
				if(!empty($dados_ab['link_4'])){
					echo '<div class="col-sm-4"><p>Link 4: <a href="//'.$dados_ab['link_4'].'" target="_blank">'.$dados_ab['link_4'].'</a></p></div>';
					
				}
				if(!empty($dados_ab['link_5'])){
					echo '<div class="col-sm-4"><p>Link 5: <a href="//'.$dados_ab['link_5'].'" target="_blank">'.$dados_ab['link_5'].'</a></p></div>';
					
				}
			?>
		</div>
		</div>
	</div>
</div>