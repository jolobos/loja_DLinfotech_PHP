<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>
<?php
if($_GET['zera_lista']){
    unset($_SESSION['produto_carrinho']);
}

require_once 'cabecalho.php';
if(!empty($_POST['id_produto_POST'])){
$_SESSION['ultimo_visto'] = $_POST['id_produto_POST'];


$ultimo_visto = $_SESSION['ultimo_visto'];
if(!isset($_SESSION['produto_carrinho'])){
    $_SESSION['lista_produto'] = array();
    if(isset($_POST['id_produto_POST'])){
    $id = intval($_POST['id_produto_POST']);
    $quantidade_produto = $_POST['quantidade_produto'];
    $_SESSION['lista_produto'] [$id] = $quantidade_produto;
    }
}else{
   echo  '<div class="modal fade modal-lg" data-bs-backdrop="static"  id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Seu carrinho não está vazio!</h3>
      </div>
      <div class="modal-body bg-light">
        <h5>Você possui os seguintes produtos no seu carrinho:</h5>
     
      <div class="bg-light">';
         foreach($_SESSION['produto_carrinho'] as $id => $qtd){
            $sql = "SELECT * FROM produtos WHERE id_produto = ?";
            $consulta = $conexao->prepare($sql);
            $consulta->execute(array($id));
            $dados = $consulta->fetch(PDO::FETCH_ASSOC);
            $cod_produto = $dados['cod_produto'];
            $nome = $dados['nome'];
            $valor= $dados['valor'];
            echo '<p class=""><strong>Produto:</strong> '.$nome.' <strong>Valor:</strong> '.$valor.' <strong>Quantidade:</strong> '.$qtd.'</p>';
             
         }
      
      echo '</div></div><div class="text-white" align="center">
            <h4>Escolha umas das opções a seguir para sua compra atual:</h4>
            </div>
      <div class="modal-footer bg-light">
        <a class="btn btn-dark" href="endereco_compra.php?zera_lista=ok">Esvaziar carrinho</a>
        <a class="btn btn-dark" href="ver_carrinho.php?compra_atual='.$ultimo_visto.'>Ver carrinho</a>
        <a class="btn btn-dark" href="endereco_compra.php?zera_lista=ok">Adicionar ao carrinho</a>
      </div>
    </div>
  </div>
</div>';
}
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
				var_dump($_SESSION['produto_carrinho']);
                                echo $ultimo_visto;
				if(empty($dados_a)){
					echo '<h5>O usuario não possue endereço cadastrado. Deseja cadastrar?</h5>
					<a class="btn btn-primary" href="cadastro_endereco.php">SIM</a>
					<a class="btn btn-danger" href="endereco_compra.php?zera_lista=ok">NÃO</a>
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
