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
	<div class="card mt-2">
        <div class="card-header">
			<div class="row">
			<div class="col">
            <h3 class="text-info">Seleção dos produtos para vendas</h3>
			</div>
			<div class="col" align="right">
				<a href="checkout.php" class="btn btn-secondary border-info">Trocar Usuário</a>
			</div>
			</div>
			</div>
        <div class="card-body">
		<div class="row">
		<div class="col-sm-8">
		<input type="search" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)" autofocus/>
		<div id="resultado" class="mt-3">
		
		</div>
		</div>
		<div class="col">
		<div class="card">
        <div class="card-header">
		<h4>Compra</h4>
		</div>
		<div class="card-body">
		</div>
		</div>
			
	
		</div>
		</div>
		
		</div>
		</div>
		</div>
</body>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>