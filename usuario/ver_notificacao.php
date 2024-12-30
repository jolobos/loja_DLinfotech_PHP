<?php
require_once 'cabecalho.php';

if(isset($_GET['ver'])){
		$valor = 0;
		$id = $_GET['ver'];
		$sql = "SELECT * FROM notificacoes WHERE id_notificacoes= '".$id."'";
		$consulta = $conexao->query($sql);
		$dados_ab = $consulta->fetch(PDO::FETCH_ASSOC);
		
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
		
}
//echo '<div style="margin-top: 105px;">'.$msg.'</div>';
?>
<div class="container" style="margin-top: 105px;">
    <h3 class="text-info">Notificações</h3>
    <hr>
	<div class="row m-3">
	<div class="col">
	<h4>Mensagem: </h4>
	</div>
	<div class="col" align="right">
	<?php
	echo '<a href="notificacoes.php?excluir='.$dados_ab['id_notificacoes'].'" class="btn btn-danger me-2">Excluir</a>
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