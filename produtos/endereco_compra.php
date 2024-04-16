<?php
require_once 'cabecalho.php';
if(!empty($_POST['id_produto_POST'])){
$_SESSION['ultimo_visto'] = $_POST['id_produto_POST'];
$ultimo_visto = $_SESSION['ultimo_visto'];
}

?>
<div class="container" style="margin-top:105px">
	<h4 class="alert alert-info" align="center">Escolha o endereço de entrega dos produtos</h4>
<div class="card mb-3">
  <div class="row" >
    <div class="col-md-4">
      <img src="../img/entrega.jpg" class="img-fluid rounded m-3" alt="...">
    </div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title">Endereço de entrega atual</h5>
				<?php
				$sql2 = "SELECT * FROM endereco_usuario WHERE id_usuario = '".$id_usuario."'";
				$consulta2 = $conexao->query($sql2);
				$dados_a = $consulta2->fetch(PDO::FETCH_ASSOC);
				
				if(empty($dados_a)){
					echo '<h5>O usuario não possue endereço cadastrado. Deseja cadastrar?</h5>
					<a class="btn btn-primary" href="cadastro_endereco.php">SIM</a>
					<a class="btn btn-danger" href="endereco_compra.php?zera_lista=">NÃO</a>
					';
					
				}else{
					
					$CEP = $dados['CEP'];
					$rua = $dados['logradouro'];
					$bairro = $dados['bairro'];
					$cidade = $dados['cidade'];
					$UF = $dados['UF'];
					$numero = $dados['numero'];
					$complemento = $dados['complemento'];
					$ponto_referencia = $dados['ponto_referencia'];
					$retirada_com = $dados['retirada_com'];
					$telefone_entrega = $dados['telefone_entrega'];
				
				
			
		echo '<div class="form-check">
		  <input class="form-check-input" type="radio" name="endereco" id="flexRadioDefault1" checked>
		  <label class="form-check-label" for="flexRadioDefault1">
	
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="endereco" id="flexRadioDefault2">
		  <label class="form-check-label" for="flexRadioDefault2">
			Default checked radio
		  </label>
		</div>';
		
		} ?>
		<p class="card-text"></p>
      </div>
    </div>
  </div>
</div>
</div>