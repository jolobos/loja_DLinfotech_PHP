<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_GET['id_usuario'])){
	$_SESSION['id_usuario'] = $_GET['id_usuario'];
}else if(!empty($_SESSION['id_usuario'])){
	header("location:checkout.php?msg=Nenhum usuário escolhido.");
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
				<a class="btn btn-dark border-danger" href="checkout.php">Voltar</a>
				<a href="checkout.php" class="btn btn-secondary border-info">Trocar Usuário</a>
			</div>
			</div>
			</div>
        <div class="card-body">
		<div class="row">
		<div class="col-sm-8">
		<div class="row">
		<div class="col">
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
		</div>
		<div class="col">
		<div class="card" style="height:600px">
        <div class="card-header">
		<h4>Compra</h4>
		</div>
		<div class="card-body">
		
		</div>
		<div class="card-footer">
		<div class="row">
		<div class="col-sm-4">
		Total: R$ <?php  echo '100,00';?>
		</div>
		<div class="col" align="right">
			<div class="row">
			<div class="colsm-6">
			<form method="post">
			<input type="hidden" name="zerar_lista" value="ok">
			<input type="submit" class="btn btn-primary" value="Limpar Compra">
			</form>
			</div>
			<div class="col-sm-4">
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
		echo  '<div class="modal fade modal-lg" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_a as $d){
					  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
					  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
					  <td>'.$status.'</td><td><form method="post">
					  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
					  <input type="submit" class="btn btn-dark border-success me-2"  value="Adicionar" />
					  
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
		echo  '<div class="modal fade modal-lg" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_b as $d){
					  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
					  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
					  <td>'.$status.'</td><td><form method="post">
					  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
					  <input type="submit" class="btn btn-dark border-success me-2"  value="Adicionar" />
					  
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
		echo  '<div class="modal fade modal-lg" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Pesquisa Avançada - Resultado</h3>
					  </div>
					  <div class="modal-body bg-light">';
				  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
				  echo '<thead style="display: block;position: relative;" class="border">';
				  echo '<tr>';
				  
				  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
				  
				  echo '</tr>';
				  echo '</thead>';
				  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
				  foreach($dados_c as $d){
					  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
					  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
					  <td>'.$status.'</td><td><form method="post">
					  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
					  <input type="submit" class="btn btn-dark border-success me-2"  value="Adicionar" />
					  
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