<?php
require_once("../database.php");
require_once('../verifica_session.php');


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
		header('location:?mensagem='.$msg); 
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
		}header('location:?mensagem='.$msg); 
}
require_once 'cabecalho.php';
?>
<div class="container" style="margin-top: 105px;">
    <h3 class="text-info">Notificações</h3>
    <hr><div class="row"><div class="col">
    <h4>Notificações não lidas</h4></div><div class="col" align="right"><a href="?ler_todas=ok" class="btn btn-info me-3">Marcar como lidas</a></div></div>
    <hr>
<?php
    $sql = "SELECT * FROM notificacoes WHERE id_usuario = '".$id_usuario."' ORDER BY data_envio DESC";
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
			<a href="?excluir='.$d['id_notificacoes'].'" class="btn btn-danger">Excluir</a>
			<a href="ver_notificacao.php?ver='.$d['id_notificacoes'].'" class="btn btn-success">Visualizar</a>
			</div>
			</div>
			</div>';
            echo '
			<div class="card-body">
			<span class="d-inline-block text-truncate" style="max-width: 650px;max-height: 80px;">'.$conteudo.'</span>';
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
			<a href="?excluir='.$d['id_notificacoes'].'"class="btn btn-danger">Excluir</a>
			<a href="ver_notificacao.php?ver='.$d['id_notificacoes'].'" class="btn btn-success">Visualizar</a>
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
</div>

