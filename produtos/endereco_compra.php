
<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");

if(!empty($_GET['zera_lista'])){
    unset($_SESSION['produto_carrinho']);
}

require_once 'cabecalho.php';
if(!empty($_GET['mensagem'])){
        echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tudo certo...</h3>
      </div>
      <div class="modal-body bg-light">
        <h5>Seu endereço foi adicionado corretamente ao banco de dados.</h5>
      </div>
      <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
}

if($_GET['fechar_carrinho']){
        $_SESSION['lista_produto'] = array();
        $_SESSION['lista_produto'] = $_SESSION['produto_carrinho'];
}else{
if(!empty($_POST['id_produto_POST'])){
$_SESSION['ultimo_visto'] = $_POST['id_produto_POST'];
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
            echo '<p class=""><strong>Produto:</strong> '.$nome.' <strong>Valor:</strong>R$ '.$valor.' <strong>Quantidade:</strong> '.$qtd.'</p>';
             
         }
      
      echo '</div></div><div class="text-white" align="center">
            <h4>Escolha umas das opções a seguir para sua compra atual:</h4>
            </div>
      <div class="modal-footer bg-light">
        <a class="btn btn-dark" href="ver_carrinho.php?zera_lista_entrega=ok">Esvaziar carrinho</a>
        <a class="btn btn-dark" href="ver_carrinho.php" target="_blank">Ver carrinho</a>
        <a class="btn btn-dark" href="ver_carrinho.php?id_produto='.$_SESSION['ultimo_visto'].'">Adicionar ao carrinho</a>
      </div>
    </div>
  </div>
</div>';
}
}
}

?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>
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
                if(isset($_SESSION['id_usuario'])){
				$sql2 = "SELECT * FROM endereco_usuario WHERE id_usuario = '".$id_usuario."'";
				$consulta2 = $conexao->query($sql2);
				$dados_a = $consulta2->fetchALL(PDO::FETCH_ASSOC);
				if(empty($dados_a)){
					echo '<h5>O usuario não possue endereço cadastrado. Deseja cadastrar?</h5>
					<a class="btn btn-primary" href="cadastro_endereco.php">SIM</a>
					<a class="btn btn-danger" href="pagina_produto.php?id_produto='.$_SESSION['ultimo_visto'].'">NÃO</a>
					';
					
				}else{
                                    echo '<form action="../conclui_venda/modo_pagamento.php" method="POST">';
                                    $checked = 1;
                                    foreach($dados_a as $d){
					$CEP = $d['CEP'];
					$rua = $d['logradouro'];
					$bairro = $d['bairro'];
					$cidade = $d['cidade'];
					$UF = $d['UF'];
					$numero = $d['numero'];
					$complemento = $d['complemento'];
					$ponto_referencia = $d['ponto_referencia'];
					$retirada_com = $d['retirada_com'];
					$telefone_entrega = $d['telefone_entrega'];
                                        if($checked == 1){ 
                                            $checked_show = 'checked';
                                        }else{
                                            $checked_show = '';
                                        }
                                        $checked +=1;
							
		echo '<div class="form-check">
		  <input class="form-check-input" type="radio" name="id_endereco" value="'.$d['id_endereco'].'" '.$checked_show.'>
		  <label class="form-check-label" for="flexRadioDefault1">
                  <strong>CEP:</strong> '.$d['CEP'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Rua:</strong> '.$d['logradouro'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Bairro:</strong> '.$d['bairro'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Cidade:</strong> '.$d['cidade'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> UF:</strong> '.$d['UF'].' 
		  </label></br>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> n°:</strong> '.$d['numero'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Complemento:</strong> '.$d['complemento'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
		  </label></br>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
		  </label>
                  <label class="form-check-label" for="flexRadioDefault1">
                  <strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
		  </label>
		</div><hr/>
                ';
                }
                echo '<div style="position:absolute;bottom:10px;right:10px">
                <a class="btn btn-secondary" href="cadastro_endereco.php">Novo endereço</a>
                <input type="submit" class="btn btn-info" value="Continuar" >
                </div>
                </form>';
		}
                }else{
                echo '<h5>Você precisa estar logado, ou se cadastrar para efetuar suas compras. Escolha uma das opções abaixo:</h5>
		<a class="btn btn-secondary" href="../usuario/cadastro.php">Cadastro</a>
		<a class="btn btn-info" href="../index.php?">INICIO</a>
		'; 
                }
                ?>
		<p class="card-text"></p>
      </div>
    </div>
  </div>
</div>
</div>
