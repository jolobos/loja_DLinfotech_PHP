<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_GET['id_usuario'])){	
	$id_usuario = $_GET['id_usuario'];
	$sql = "SELECT * FROM compras WHERE id_usuario = '".$id_usuario."'";
	$consulta = $conexao->query($sql);
$dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);}

if(isset($_GET['excluir'])){
	$id = $_GET['excluir'];
	$sql ='DELETE FROM notificacoes WHERE id_notificacoes=?';
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
		header('location:?mensagem='.$msg.'&id_usuario='.$id_usuario); 
}

if(isset($_GET['ler_todas'])){
		$valor = 0;
		$sql = "SELECT * FROM notificacoes WHERE id_usuario = '".$id_usuario."' AND condicao = 1";
		$consulta = $conexao->query($sql);
		$dados_ab = $consulta->fetchALL(PDO::FETCH_ASSOC);
		foreach($dados_ab as $da){
		$id = $da['id_notificacoes'];
        $sql ='UPDATE notificacoes SET condicao=? WHERE id_notificacoes=?';
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
		}header('location:?mensagem='.$msg.'&id_usuario='.$id_usuario); 
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
    <script type="text/javascript" src="func_us.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para Usuários
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<?php echo '<a class="btn btn-secondary border-danger m-2" href="us_opcoes.php?id_usuario='.$id_usuario.'">Voltar</a>'; ?>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="usuarios.php">Usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="novos_usuarios.php">Novos usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="des_usuarios.php">Usuários desativados</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_mais_cp.php">Usuários que mais compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_menos_cp.php">Usuários que menos compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_nunca_cp.php">Usuários que nunca compraram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ex_auto.php">Exclusão automática</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
	<div class="card-header">
	</div>
	<div class="card-body">
	<h3 class="text-info">Notificações</h3>
    <hr><div class="row"><div class="col">
    <h4>Notificações não lidas</h4></div><div class="col" align="right"><a href="?ler_todas=ok" class="btn btn-info me-3">Marcar como lidas</a></div></div>
    <hr>
<?php
    $sql = "SELECT * FROM notificacoes WHERE id_usuario = '".$id_usuario."' ORDER BY id_notificacoes DESC";
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
			<a href="?excluir='.$d['id_notificacoes'].'&id_usuario='.$id_usuario.'" class="btn btn-danger">Excluir</a>
			<a href="ver_notificacao.php?ver='.$d['id_notificacoes'].'&id_usuario='.$id_usuario.'" class="btn btn-success">Visualizar</a>
			</div>
			</div>
			</div>';
            echo '
			<div class="card-body">
			<span class="d-inline-block text-truncate" style="max-width: 650px;">'.$conteudo.'</span>';
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
			<a href="?excluir='.$d['id_notificacoes'].'&id_usuario='.$id_usuario.'"class="btn btn-danger">Excluir</a>
			<a href="ver_notificacao.php?ver='.$d['id_notificacoes'].'&id_usuario='.$id_usuario.'" class="btn btn-success">Visualizar</a>
			</div>
			</div>
			</div>';
            echo '
			<div class="card-body">
			<span class="d-inline-block text-truncate" style="max-width: 650px;">'.$conteudo.'</span>';
            if(!empty($link_1) || !empty($link_2) || !empty($link_3) || !empty($link_4) || !empty($link_5)){
				echo '<br><div class="card-footer text-muted">Existe algum link na mensagem....</div></div></div>';

			}else{
				echo '<br><div class="card-footer text-muted">Mensagem sem link....</div></div></div>';
			}
        }
    }	if($contt == 0){echo '<h3 class="alert alert-secondary text-center">Nenhuma mensagem lida</h3>';}

?>
</div>
	</div>
	</div>
</div>