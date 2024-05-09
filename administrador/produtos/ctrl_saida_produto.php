<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

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
    <script type="text/javascript" src="func_pr.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para produtos
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="produtos.php">Produtos</a></br>
				<a class="btn btn-secondary border-danger m-2" href="add_produto.php">Inserir Produto</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_quantidade.php">Controle de quantidade</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_saida_produto.php">Controle de saida</a></br>
				
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>

      <div class="card mt-2">
          <div class="card-header">
              <h4>Escolha uma das opções abaixo:</h4>
              <div class="row"><div class="col">
                <a class="btn btn-info w-100" href="?quant_maior=5">Top 5 maiores saidas</a></div>
                <div class="col"><a class="btn btn-info w-100" href="?quant_maior=10">Top 10 maiores saidas</a></div>
                <div class="col"><a class="btn btn-info w-100" href="?quant_maior=20">Top 20 maiores saidas</a></div>
                <div class="col"><a class="btn btn-info w-100" href="?quant_maior=30">Top 30 maiores saidas</a></div></div>
                <div class="row mt-2"><div class="col">
                <a class="btn btn-danger w-100" href="?quant_menor=5">Top 5 menores saidas</a></div>
                <div class="col"><a class="btn btn-danger w-100" href="?quant_menor=10">Top 10 menores saidas</a></div>
                <div class="col"><a class="btn btn-danger w-100" href="?quant_menor=20">Top 20 menores saidas</a></div>
                <div class="col"><a class="btn btn-danger w-100" href="?quant_menor=30">Top 30 menores saidas</a></div>
           </div> 
                <div class="row mt-2"><div class="col-sm-3">
                <a class="btn btn-warning w-100" href="?quant_sem=20">Top 20 produtos sem saida</a></div>
                </div> </div>
              <div class="card-body mt-3">
                  <h5>Pesquisa personalizada:</h5>
                  <form>
                      <div class="form-control">
                      <label>Quantidade de produtos:</label>
                      <input type="number" class="form-control-sm" min="1" name="quant_person_1" value="1">
                      <label>Unidades de: </label>
                      <input type="number" class="form-control-sm" min="1" name="quant_person_2" value="1">
                      <label> Até:</label>
                      <input type="number" class="form-control-sm" min="1" name="quant_person_3" value="1">
                      <input type="submit" class="btn btn-info" value="Buscar">
                      </div>
                  </form>
                  <h5>Pesquisa por produto:</h5>
                  <form>
                      <div class="form-control">
                      <label>Codigo do produto:</label>
                      <input class="form-control-sm" min="1" name="cod_prod" autofocus>
                      <input type="submit" class="btn btn-info" value="Buscar">
                      </div>
                  </form>
              </div>
         
      </div>
  
    </div>
      