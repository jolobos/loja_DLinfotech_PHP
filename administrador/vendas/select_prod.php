<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_GET['id_usuario'])){
	$_SESSION['id_usuario_1'] = $_GET['id_usuario'];
}else if(empty($_SESSION['id_usuario_1'])){
	header("location:checkout.php?msg=Nenhum usuário escolhido.");
}
//inicio da programação que controla a lista de produtos.
if(isset($_SESSION['endereco'])){
	unset($_SESSION['endereco']);
}

if(!isset($_SESSION['produto_carrinho'])){
	$_SESSION['produto_carrinho'] = array();
	}

if(!empty($_POST['inserir_cod_prod'])){
	$cod = $_POST['inserir_cod_prod'];
	$sql = "SELECT * FROM produtos WHERE cod_produto='".$cod."'";
    $consulta = $conexao->query($sql);
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);
	if($dados['status'] == 1){
	$_POST['id_produto'] = $dados['id_produto'];
	}else{
		header("location:select_prod.php?mensagem=Lamento, produto não pode ser escolhido para venda, por que está em falta ou trancado.");
	}
}

if(!empty($_POST['id_produto'])){
if(isset($_POST['id_produto'])){
    $id = intval($_POST['id_produto']);
    if(!isset($_SESSION['produto_carrinho'][$id])){
		if(isset($_POST['qtd_cod_prod'])){
        $_SESSION['produto_carrinho'][$id] = $_POST['qtd_cod_prod'];}else{
		$_SESSION['produto_carrinho'][$id]=1;}
    }else{
		if(isset($_POST['qtd_cod_prod'])){
        $_SESSION['produto_carrinho'][$id] += $_POST['qtd_cod_prod'];}else{
				
		$_SESSION['produto_carrinho'][$id] +=1;}
       

                }
}
	   $sql = "SELECT * FROM produtos WHERE id_produto='".$id."'";
       $consulta = $conexao->query($sql);
       $dados = $consulta->fetch(PDO::FETCH_ASSOC);
       $quantidadea = $dados['quantidade'];
       if($_SESSION['produto_carrinho'][$id] > $quantidadea){
                     $_SESSION['produto_carrinho'][$id] = intval($quantidadea);

}
}



if(isset($_POST['zerar_lista'])){
    unset($_SESSION['produto_carrinho']);
    
}
if(!isset($_SESSION['modo_pesquisa'])){$_SESSION['modo_pesquisa'] = 1; }
if(isset($_POST['modo_pesquisa'])){
	$_SESSION['modo_pesquisa'] = $_POST['modo_pesquisa'] ;
	}
	
if(isset($_POST['remove_prod'])){
	unset($_SESSION['produto_carrinho'][$_POST['remove_prod']]);
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
	<link rel="stylesheet" href="../../css/modal.css">
    <script type="text/javascript" src="func_pr.js"></script>


</head>
<body style="background: #778899">
<div class="container">
	<div class="card mt-2" style="height:700px">
        <div class="card-header">
			<div class="row">
			<div class="col">
            <h3 class="text-info">Seleção dos produtos para vendas</h3>
			</div>
			<div class="col" align="right">
				
				<div class="row">
				<div class="col">
				<a class="btn btn-dark border-danger" href="checkout.php?troca_us=1">Voltar</a>
				</div>
				<div class="col-sm-3">
				<?php
				if(isset($_SESSION['modo_pesquisa'])){
				if($_SESSION['modo_pesquisa'] == 0){
					echo '<form method="POST">
							<input type="hidden" name="modo_pesquisa" value="1" />
							<input type="submit" class="btn btn-secondary border-info" value="Busca por código" />
							</form>';
				}else{
					echo '<form method="POST">
							<input type="hidden" name="modo_pesquisa" value="0" />
							<input type="submit" class="btn btn-secondary border-info" value="Busca por nome" />
							</form>';
				
				}
				}
				?>
				</div>
				<div class="col-sm-3">
				<a href="checkout.php" class="btn btn-secondary border-info">Trocar Usuário</a>
				</div>
				</div>
			</div>
			</div>
		</div>
        <div class="card-body">
			<div class="row">
				<div class="col-sm-8" id="por_nom_pr">
				<?php 
				if($_SESSION['modo_pesquisa'] == 0){
					echo '
						<div class="row">
						<div class="col" >
						<h5>Digite o nome do produto</h5>
						<input type="search" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)" autofocus/>
						</div>
						<div class="col">
						<br>
						<form method="post">
							<input type="hidden" name="pesquisa_avancada" value="ok">
							<input type="submit" class="btn btn-secondary border-info mt-2" value="Pesquisa Avançada" />
						</form>
						</div>
						</div>
					<div id="resultado" class="mt-3">
					
					</div>
				';
				}else{
					echo '<form method="post">
					<h5>Entre com o código do produto</h5><div class="row">
						<div class="col-sm-2" >
							<input type="number" class="form-control" name="qtd_cod_prod" min="1" value="1">
							</div>
							<div class="col" >
							<input type="search" class="form-control" name="inserir_cod_prod" autofocus>
							</div>
						<div class="col" >
							<input type="submit" class="btn btn-secondary border-info " value="Inserir Produto" />
							</div>
							</div>
							</form>';
				}
				
				?>
				</div>
				<div class="col">
					<div class="card" style="height:600px">
						<div class="card-header">
							<h4>Compra</h4>
						</div>
						<div class="card-body overflow-auto">
						<?php
						if(!empty($_SESSION['produto_carrinho'])){
							$cont = 0;
							foreach ($_SESSION['produto_carrinho'] as $id => $qtd) {
							$sql = "SELECT * FROM produtos WHERE id_produto = ?";
							$consulta = $conexao->prepare($sql);
							$consulta->execute(array($id));
							$dados = $consulta->fetch(PDO::FETCH_ASSOC);
							$cod_produto = $dados['cod_produto'];
							$nome = $dados['nome'];
							$valor= $dados['valor'];
							$quantidade= $dados['quantidade'];
							if($qtd > $quantidade){
								 $_SESSION['produto_carrinho'][$id] -=1;

							}
							$somado = $valor * $qtd;
							$foto_pr= $dados['foto'];
							echo '
							<div class="card mt-1">
							<div class="card-header">
							<div class="row">
							<div class="col">
							<small>'.$nome.'</small>
							</div>
							<div class="col-sm-2">
							<form method="POST">
							<input type="hidden" name="remove_prod" value="'.$id.'" />
							<input type="submit"  class="btn btn-dark" value="R" />
							</form>
							</div>
							
							</div>
							
							</div>
							<div class="card-body">
							<div class="row">
							<div class="col-sm-3">
							<small> Qtd: '.$qtd.'</small>
							</div>
							<div class="col">
							<small> Vlr: '.number_format($valor,2,',','.').'</small>
							</div>
							<div class="col">
							<small>Total: R$'.number_format($somado,2,',','.').'</small>
							</div>
							
							</div>
							
							</div>
							</div>
							
							';
							
							$cont += $somado;
							}
							
						}
						
						?>
						</div>
					<div class="card-footer">
						<div class="row">
						<div class="col">
						Total: R$ <?php if(!empty($_SESSION['produto_carrinho'])){
							echo number_format($cont,2,',','.');
							}else{
							echo '0,00';}
						;?>
						</div>
						<div class="col-sm-3" align="right">
							<form method="post">
							<input type="hidden" name="zerar_lista" value="ok">
							<input type="submit" class="btn btn-primary" value="Limpar">
							</form>
							</div>
							<div class="col-sm-3">
							<form method="post" action="conf_venda.php">
							<input type="hidden" name="lista" value="ok">
							<input type="submit" class="btn btn-success" value="Concluir">
							</form>
							
					
						</div>
						</div>
					</div>
							
				
					</div>
				</div>
			
			</div>
			
		</div>
	</div>
</div>
</body>

<?php
if(isset($_POST['pesquisa_avancada'])){
	echo  '<div class="modal fade modal" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada</h3>
						
					  </div>
					  <div class="modal-body bg-light">
					  <form method="post" action="">
					  <table align="center">
					  <thead>
					  </thead>
					  <tbody>
					  <tr>
					  <td>
					  <strong>
					  Código do produto
					  </strong>
					  </td>
					  <td>
					  <input type="search" class="form-control" name="cod_pr_avancado" placeholder="" />
					  </td>
					  </tr>
					  <tr>
					  <td>
					  <strong>
					  Nome
					  </strong>
					  </td>
					  <td>
					  <input type="search" class="form-control" name="nome_pr_avancado" placeholder="" />
					  </td>
					  </tr>
					  <tr>
					  <td>
					  <strong>
					  Categoria
					  </strong>
					  </td>
					  <td>
					  <input type="search" class="form-control" name="cat_pr_avancado" placeholder="" />
					  </td>
					  </tr>
					  </tbody>
					  </table>
					  
					  </div>
					  <div class="modal-footer bg-light">
					  	
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
						<input type="submit" class="btn btn-success" value="Pesquisar" />
					  </div></form>
					  </div>
					  </div>
					  </div>
					  ';
}

if(!empty($_POST['cod_pr_avancado']) || !empty($_POST['nome_pr_avancado']) || !empty($_POST['cat_pr_avancado'])){
	$confirmacao = false;
if(!empty($_POST['cod_pr_avancado'])){
	$cd_a = $_POST['cod_pr_avancado'];
	$sql_a = "SELECT * FROM produtos WHERE cod_produto LIKE '%".$cd_a."%'";
	$consulta_a = $conexao->query($sql_a);
	$dados_a = $consulta_a->fetchALL(PDO::FETCH_ASSOC);
	if(!empty($dados_a)){
		$confirmacao = true;
		echo  '<div class="modal fade modal-xl" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				   echo '<th width="200">codigo do produto</th><th width="380">Produto</th><th width="110">Valor</th><th width="150">quantidade</th><th width="262">Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_a as $d){
					  echo '<tr><td width="200">'.$d['cod_produto'].'</td><td width="380">'.$d['nome'].'</td><td width="110">$ '. number_format($d['valor'],2,',','.').'</td><td width="150">'.$d['quantidade'].'</td>
						 <td width="245"><form method="post">
						  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
						  <input type="submit" class="btn btn-dark border-success me-2  mt-1"  value="Adicionar" />
						  
						  <a class="btn btn-dark border-success me-2 mt-1" href = "?ver_produto='.$d['id_produto'].'">  Verificar </a></form>
										  </td</tr>';
								 }
				  
				  echo '</tbody>';
				   echo '</table>';	  
									 

				echo '</div>
  					  <div class="modal-footer bg-light">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					  </div>
					  </div>
					  </div>
					  </div>
					  ';
	}
}else if(!empty($_POST['nome_pr_avancado']) && $confirmacao == false){
	$cd_b = $_POST['nome_pr_avancado'];
	$sql_b = "SELECT * FROM produtos WHERE nome LIKE '%".$cd_b."%'";
	$consulta_b = $conexao->query($sql_b);
	$dados_b = $consulta_b->fetchALL(PDO::FETCH_ASSOC);
	if(!empty($dados_b)){
		$confirmacao = true;
		echo  '<div class="modal fade modal-xl" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				   echo '<th width="200">codigo do produto</th><th width="380">Produto</th><th width="110">Valor</th><th width="150">quantidade</th><th width="262">Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_b as $d){
					  echo '<tr><td width="200">'.$d['cod_produto'].'</td><td width="380">'.$d['nome'].'</td><td width="110">$ '. number_format($d['valor'],2,',','.').'</td><td width="150">'.$d['quantidade'].'</td>
						 <td width="245"><form method="post">
						  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
						  <input type="submit" class="btn btn-dark border-success me-2  mt-1"  value="Adicionar" />
						  
						  <a class="btn btn-dark border-success me-2 mt-1" href = "?ver_produto='.$d['id_produto'].'">  Verificar </a></form>
										  </td</tr>';
								 }
				  
				  echo '</tbody>';
				   echo '</table>';	  
									 

				echo '</div>
  					  <div class="modal-footer bg-light">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					  </div>
					  </div>
					  </div>
					  </div>
					  ';
	}
}else if(!empty($_POST['cat_pr_avancado']) && $confirmacao == false){	
	$cd_c = $_POST['cat_pr_avancado'];
	$sql_c = "SELECT * FROM produtos WHERE categoria LIKE '%".$cd_c."%' LIMIT 0,15";
	$consulta_c = $conexao->query($sql_c);
	$dados_c = $consulta_c->fetchALL(PDO::FETCH_ASSOC);
	if(!empty($dados_c)){
		$confirmacao = true;
		echo  '<div class="modal fade modal-xl" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				   echo '<th width="200">codigo do produto</th><th width="380">Produto</th><th width="110">Valor</th><th width="150">quantidade</th><th width="262">Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_c as $d){
					  echo '<tr><td width="200">'.$d['cod_produto'].'</td><td width="380">'.$d['nome'].'</td><td width="110">$ '. number_format($d['valor'],2,',','.').'</td><td width="150">'.$d['quantidade'].'</td>
						 <td width="245"><form method="post">
						  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
						  <input type="submit" class="btn btn-dark border-success me-2  mt-1"  value="Adicionar" />
						  
						  <a class="btn btn-dark border-success me-2 mt-1" href = "?ver_produto='.$d['id_produto'].'">  Verificar </a></form>
										  </td</tr>';
								 }
				  
				  echo '</tbody>';
				   echo '</table>';	  
									 

				echo '</div>
  					  <div class="modal-footer bg-light">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					  </div>
					  </div>
					  </div>
					  </div>
					  ';
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


				
