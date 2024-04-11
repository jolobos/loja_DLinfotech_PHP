<?php
require_once '../../database.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func_pr.js"></script>
</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para produtos
				</h1>
				<button type="button" class="btn btn-primary btn-floating btn-lg m-2" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#myModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				
				
				</div>
			

<div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> </br></br>

<a href="../../sair.php" class="btn btn-danger">Sair</a>
</div>
<h4>Pesquisar produto: </h4><div class="col-sm-5"><input type="text" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)" />
</div>
<h4>Código do produto: </h4>
<form action="produtos.php" method="POST"><div class="row">
<div class="col-sm-5">
<input type="text"  class="form-control" style="width:500px" name="cod_produto"  placeholder="Digite o código do produto..." />
</div>
<div class="col"><input type="submit"  class="btn btn-secondary" value="Buscar" onKeyUp="buscarprodutos(this.value)" />
</div></div>

</br>
  <div id="resultado">      
<?php
 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3</div>';
    ?>
  </div>
<div>
  <?php
 if(!empty($_POST['cod_produto'])){
	$cod_produto = $_POST['cod_produto'];
 
  $sql = "SELECT * FROM produtos WHERE cod_produto ='".$cod_produto."'";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
		if(empty($dados)){
 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-danger">Lamento! Não há nenhum produto com esse código...</h3</div>';
		}
 }?>
</div>

  </body>