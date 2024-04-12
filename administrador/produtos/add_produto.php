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
				<a class="btn btn-secondary border-danger m-2" href="produtos.php">Voltar</a>
				<a class="btn btn-secondary border-info m-2" href="../adminintracao.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			 <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="add_produto.php">Inserir Produto</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_quantidade.php">Controle de quantidade</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_saida_produto.php">Controle de saida</a></br>
				<a class="btn btn-secondary border-success m-2" href="produtos_promocao.php">Produtos em promoção</a></br>
				<a class="btn btn-secondary border-success m-2" href="produtos_destaque.php">Produtos em destaque</a></br>
				<a class="btn btn-secondary border-success m-2" href="produtos_banner.php">Produtos do banner</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
<div style="width: 50%;margin:auto;">
<form action="" method="post">
<h4>Leitor de código de barras:</h4>
<div class="row mt-3">
    <div class="col" >            
        <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras" autofocus>
    </div>
	    <div class="col" >            
		<input type="submit" class="btn btn-dark " value="Adicionar">
    </div>
    </div>
</form>
</div>
<?php

if(!empty($_POST['cod_barras'])){ $cod_barras = $_POST['cod_barras'];}else{ $cod_barras = '';}

echo '<div style="width: 50%;margin:auto;">
    
        <form action="add_produto.php"  method="post" >
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label class="form-label">Código do produto:</label>
            <input class="form-control " placeholder="Código do produto" name="cod_produto" value="'.$cod_barras.'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Nome:</label>
            <input class="form-control" placeholder="Digite o nome do produto" name="nome" >
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Valor:</label>
            <input class="form-control" placeholder="Digite o valor" name="valor" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Quantidade:</label>
            <input class="form-control" placeholder="Digite a quantidade " name="quantidade" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Categoria:</label>
            <input class="form-control" placeholder="Digite a categoria " name="categoria" >
            </div>
			
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label class="form-label">Cor:</label>
            <input class="form-control" placeholder="Digite a cor " name="cor" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Voltagem:</label>
            <input class="form-control" placeholder="Digite a voltagem " name="voltagem" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Opções de voltagem:</label>
            <input class="form-control" placeholder="Digite a voltagem " name="voltagem_opcoes" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Descrição:</label>
            <input class="form-control" placeholder="Digite a descrição " name="descricao" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Status:</label>
            <input class="form-control" placeholder="Digite o status" name="status" >
            </div>
			</div>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Opções de cores:</label>
            <input class="form-control" placeholder="fazer com radio" name="" >
            </div>
			<div class="mb-3 mt-3" align="center">
            <button type="submit" class="btn btn-primary ">Salvar as configurações</button>
            </div>
        </form>
    
    
</div>';
?>

</body>