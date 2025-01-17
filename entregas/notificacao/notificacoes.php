<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['excluir'])){
    $_POST['excluir'] = $_GET['excluir'];
}
if(isset($_POST['excluir'])){
	$id = $_POST['excluir'];
	$sql ='DELETE FROM notificacoes_entregas WHERE id_notificacao=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($id));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Notificacao deletada!';
				}else{
					$msg='Não foi dessa vez!'.$r->getMessage().'';
			}
		header('location:?mensagem='.$msg); 
}

if(isset($_POST['ler_todas'])){
		$valor = 0;
		$sql = "SELECT * FROM notificacoes_entregas WHERE id_entregador= '".$id_entregador."' AND condicao = 1";
		$consulta = $conexao->query($sql);
		$dados_ab = $consulta->fetchALL(PDO::FETCH_ASSOC);
		foreach($dados_ab as $da){
		$id = $da['id_notificacao'];
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
		}header('location:?mensagem='.$msg); 
}
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
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary">Notificações</h3>
        </div>
        <div class="card-body">
            <hr><div class="row"><div class="col">
    <h4>Notificações não lidas</h4></div><div class="col" align="right">
        <form method="POST">
            <input type="hidden" name="ler_todas" value="ok">
            <input type="submit" class="btn btn-info me-3" value="Marcar como lidas">
        </form>
        </div></div>
    <hr>
<?php
    $sql = "SELECT * FROM notificacoes_entregas WHERE id_entregador = '".$id_entregador."'";
    $consulta = $conexao->query($sql);
    $dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);
   echo '<div style="max-height:400px" class="overflow-auto">';
    $cont = 0;
	foreach ($dados_a as $d){
        if($d['condicao'] == 1){ 
			$cont += 1;
            $titulo = $d['titulo'];
            $conteudo = $d['conteudo'];
            $link_1 = $d['link_1'];
            $link_2 = $d['link_2'];
            $link_3 = $d['link_3'];
            $link_4 = $d['link_4'];
            $link_5 = $d['link_5'];
            $data_envio = $d['data_envio'];
        
    
            echo '<div class="card m-4">
			<div class="card-header text-white" style="background: #4f4f4f">
			<div class="row">
			<div class="col">
			<p class="ms-2"><strong>'.$titulo.'</strong> Recebida em: '. date_format(new DateTime($data_envio),"d/m/Y H:i:s").'</p></div>
			<div  class="col" align="right">
			<a href="?excluir='.$d['id_notificacao'].'" class="btn btn-danger">Excluir</a>
			<a href="ver_notificacao.php?ver='.$d['id_notificacao'].'" class="btn btn-success">Visualizar</a>
			</div>
			</div>
			</div>';
            echo '
			<div class="card-body">
			<span class="d-inline-block text-truncate" style="max-width: 650px;max-height: 80px">'.$conteudo.'</span>';
            if(!empty($link_1) || !empty($link_2) || !empty($link_3) || !empty($link_4) || !empty($link_5)){
				echo '<br><div class="card-footer text-muted">Existe algum link na mensagem....</div></div></div>';

			}else{
				echo '<br><div class="card-footer text-muted">Mensagem sem link....</div></div></div>';
			}
        }
    }
	if($cont == 0){echo '<h3 class="alert alert-secondary text-center">Nenhuma mensagem não lida</h3>';}
	echo '</div>';
?>
    <h4 class="mt-4">Mensagens recebidas</h4>
    <hr>
	<div style="max-height:400px" class="overflow-auto">

<?php
	$contt=0;
    foreach ($dados_a as $d){
        if($d['condicao'] == 0){ 
			$contt += 1;
            $titulo = $d['titulo'];
            $conteudo = $d['conteudo'];
            $link_1 = $d['link_1'];
            $link_2 = $d['link_2'];
            $link_3 = $d['link_3'];
            $link_4 = $d['link_4'];
            $link_5 = $d['link_5'];
            $data_envio = $d['data_envio'];
        
    
            echo '<div class="card m-4">
			<div class="card-header text-white" style="background: #4f4f4f">
			<div class="row">
			<div class="col">
			<p class="ms-2"><strong>'.$titulo.'</strong> Recebida em: '. date_format(new DateTime($data_envio),"d/m/Y H:i:s").'</p></div>
			<div  class="col" align="right">
                        <form method="POST">
                            <input type="hidden" name="excluir" value="'.$d['id_notificacao'].'">
                            <input type="submit" class="btn btn-danger" value="Excluir">
			<a href="ver_notificacao.php?ver='.$d['id_notificacao'].'" class="btn btn-success">Visualizar</a>
                        </form>
			</div>
			</div>
			</div>';
            echo '
			<div class="card-body">
			<span class="d-inline-block text-truncate" style="max-width: 650px;max-height: 80px">'.$conteudo.'</span>';
            if(!empty($link_1) || !empty($link_2) || !empty($link_3) || !empty($link_4) || !empty($link_5)){
				echo '<br><div class="card-footer text-muted">Existe algum link na mensagem....</div></div></div>';

			}else{
				echo '<br><div class="card-footer text-muted">Mensagem sem link....</div></div></div>';
			}
        }
    }	if($contt == 0){echo '<h3 class="alert alert-secondary text-center">Nenhuma mensagem lida</h3>';}
    ?>
</div>
        <div class="card-footer"></div>
    </div>
    </div>
  </body>
