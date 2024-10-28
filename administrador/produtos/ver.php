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
				<a class="btn btn-secondary border-warning m-2" href="linkar_produto.php">Linkar cores de produtos</a></br>
				<a class="btn btn-secondary border-warning m-2" href="linkar_voltagem.php">Linkar voltagem de produtos</a></br>
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
            <h4 class="text-info">Visualização do produto</h4>
		</div>
		<div class="card-body">
		<?php
		if($_GET['id_produto']){
			$id = $_GET['id_produto'];
			$sql = "SELECT * FROM produtos WHERE id_produto = '".$id."'";
			$consulta = $conexao->query($sql);
			$dados = $consulta->fetch(PDO::FETCH_ASSOC);
			
			$sql1 = "SELECT * FROM ficha_tec_produto WHERE id_produto = '".$id."'";
			$consulta1 = $conexao->query($sql1);
			$dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);
			
			if($dados['status'] > 0){ $status = 'ativo';}else{ $status = 'desativado';}
			if(!empty($dados1)){
                        if($dados1['prova_agua'] > 0){ $p_agua= 'sim';}else{ $p_agua = 'nao';}
                        if($dados1['resistente_agua'] > 0){ $r_agua = 'sim';}else{ $r_agua= 'nao';}}
			echo '<h5>Produto</h5>
			<form action="prog_add_produto.php"  method="POST" enctype="multipart/form-data" >
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label class="form-label">Código do produto: '.$dados['cod_produto'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Nome do produto: '.$dados['nome'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Valor: R$ '.number_format($dados['valor'],2,',','.').'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Quantidade: '.$dados['quantidade'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Categoria: '.$dados['categoria'].'</label>
            </div>
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label class="form-label">Cor: '.$dados['cor'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Voltagem: '.$dados['voltagem'].'</label>
                      
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Opções de voltagem: '.$dados['voltagem_opcoes'].'</label>
            
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Descrição: '.$dados['descricao'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Status: '.$status.'</label>
            
            </div>
            </div>
            </div>';
			
			if($dados['azul'] > 0){ $check_azul = 'checked';}else{ $check_azul = '';}
			if($dados['vermelho'] > 0){ $check_vermelho = 'checked';}else{ $check_vermelho = '';}
			if($dados['preto'] > 0){ $check_preto = 'checked';}else{ $check_preto = '';}
			if($dados['branco'] > 0){ $check_branco = 'checked';}else{ $check_branco = '';}
			if($dados['amarelo'] > 0){ $check_amarelo = 'checked';}else{ $check_amarelo = '';}
			if($dados['verde'] > 0){ $check_verde = 'checked';}else{ $check_verde = '';}
			if($dados['laranja'] > 0){ $check_laranja = 'checked';}else{ $check_laranja = '';}
			if($dados['cinza'] > 0){ $check_cinza = 'checked';}else{ $check_cinza = '';}
			if($dados['rosa'] > 0){ $check_rosa = 'checked';}else{ $check_rosa = '';}
			if($dados['marrom'] > 0){ $check_marrom = 'checked';}else{ $check_marrom = '';}
			if($dados['roxo'] > 0){ $check_roxo = 'checked';}else{ $check_roxo = '';}
			if($dados['prata'] > 0){ $check_prata = 'checked';}else{ $check_prata = '';}
			if($dados['dourado'] > 0){ $check_dourado = 'checked';}else{ $check_dourado = '';}

            
            echo '<h5>Variações de cores</h5>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" '.$check_azul.' disabled>
              <label class="form-check-label">
                Azul
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_vermelho.' disabled>
              <label class="form-check-label">
                Vermelho
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_preto.' disabled>
              <label class="form-check-label">
                Preto
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_branco.' disabled>
              <label class="form-check-label">
                Branco
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" '.$check_amarelo.' disabled>
              <label class="form-check-label">
                Amarelo
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_verde.' disabled>
              <label class="form-check-label">
                Verde
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_laranja.' disabled>
              <label class="form-check-label">
                Laranja
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_cinza.' disabled>
              <label class="form-check-label">
                Cinza
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_rosa.' disabled>
              <label class="form-check-label">
                Rosa
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_marrom.' disabled>
              <label class="form-check-label">
                Marrom
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_roxo.' disabled>
              <label class="form-check-label">
                Roxo
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_prata.' disabled>
              <label class="form-check-label">
                Prata
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
               <input class="form-check-input" type="checkbox" '.$check_dourado.' disabled>
              <label class="form-check-label">
                Dourado
              </label>
            </div>
            </div>
            <div class="col" >            
            </div>
            <div class="col" >            
            </div>
            </div>
            ';
            if(!empty($dados1)){

		echo '<h5 class="mt-3">Ficha Técnica</h5>
		<form action="prog_add_produto.php"  method="POST" enctype="multipart/form-data" >
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label class="form-label">Tamanho: '.$dados1['tamanho'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Altura: '.$dados1['altura'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Largura: '.$dados1['largura'].'<label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Peso: '.$dados1['peso'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Potência: '.$dados1['potencia'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Fabricante: '.$dados1['fabricante'].'</label>
            </div>
			</div>
			<div class="col"> 
			<div class="mb-3 mt-3">
            <label class="form-label">Garantia: '.$dados1['garantia'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Voltagem: '.$dados1['voltagem'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Temperatura máxima: '.$dados1['temperatura_max'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Temperatura mínima: '.$dados1['temperatura_min'].'</label>
			</div>
            <div class="mb-3 mt-3">
            <label class="form-label">Capacidade: '.$dados1['capacidade_armazenamento'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Durabilidade: '.$dados1['durabilidade'].'</label>
            </div>
			</div>
			<div class="col"> 
			<div class="mb-3 mt-3">
            <label class="form-label">Tempo de recarga: '.$dados1['tempo_recarga'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Marca: '.$dados1['marca'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Modelo: '.$dados1['modelo'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Velocidade: '.$dados1['velocidade'].'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Prova d´agua: '.$p_agua.'</label>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Resistente à agua: '.$r_agua.'</label>
            </div>
            </div>
            </div>
		';
            }
			if($dados['foto'] != ''){ $foto_pr = '../../img/produtos/'.$dados['foto'] ;}else{ $foto_pr = '../../img/produtos/produto_null.png';}
			if($dados['foto_1'] != ''){ $foto_1 = '../../img/produtos/'.$dados['foto_1'] ;}else{ $foto_1 = '../../img/produtos/produto_null.png';}
			if($dados['foto_2'] != ''){ $foto_2 = '../../img/produtos/'.$dados['foto_2'] ;}else{ $foto_2 = '../../img/produtos/produto_null.png';}
			if($dados['foto_3'] != ''){ $foto_3 = '../../img/produtos/'.$dados['foto_3'] ;}else{ $foto_3 = '../../img/produtos/produto_null.png';}
			if($dados['foto_4'] != ''){ $foto_4 = '../../img/produtos/'.$dados['foto_4'] ;}else{ $foto_4 = '../../img/produtos/produto_null.png';}
			if($dados['foto_5'] != ''){ $foto_5 = '../../img/produtos/'.$dados['foto_5'] ;}else{ $foto_5 = '../../img/produtos/produto_null.png';}
			if($dados['foto_6'] != ''){ $foto_6 = '../../img/produtos/'.$dados['foto_6'] ;}else{ $foto_6 = '../../img/produtos/produto_null.png';}
			
			echo '<h5 class="mt-3">Fotos do produto</h5>
            <div class="row">
            <div class="col" >            
            <img src="'.$foto_pr.'"  width=200 height=200 border="1">
            </div>
			<div class="col" >            
			<img src="'.$foto_1.'"  width=200 height=200 border="1">
			</div>
            <div class="col" >            
			<img src="'.$foto_2.'"  width=200 height=200 border="1">
			</div>
            <div class="col" >            
			<img src="'.$foto_3.'"  width=200 height=200 border="1">
			</div></div>
			<div class="row mt-3">
            <div class="col" >            
			<img src="'.$foto_4.'"  width=200 height=200 border="1">
			</div>
			<div class="col" >            
			<img src="'.$foto_5.'"  width=200 height=200 border="1">
			</div>
			<div class="col" >            
			<img src="'.$foto_6.'"  width=200 height=200 border="1">
			</div>
			<div class="col" >            
			</div></div>
            ';
			if(!empty($dados1)){
			
			echo '<h5 class="mt-3">Descrição completa</h5>
			<div><textarea rows=8 class="form-control w-100">
			'.$dados1['descricao_longa'].'</textarea>
			</div>
			';
			
                }}
		?>
		</div>
</div>
			  
			  
			  
			  
</div>			 