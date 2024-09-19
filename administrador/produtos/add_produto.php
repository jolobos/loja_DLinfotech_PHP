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
				<a class="btn btn-secondary border-info m-2" href="../adminintracao.php">Administração</a>
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
<?php
if(!empty($_GET)){
    echo '<h3 class="alert alert-info mt-2">'.$_GET['mensagem'].'</h3>';
}

?>
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
    
        <form action="prog_add_produto.php"  method="POST" enctype="multipart/form-data" >
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label class="form-label">Código do produto:</label>
            <input class="form-control " placeholder="Código do produto" name="cod_produto" value="'.$cod_barras.'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Nome do produto:</label>
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
            
            <select class="form-control" name="categoria" >
            <option>Categorias</option>
            <option value="eletronicos">Eletrônicos</option>
            <option value="acessorios">Acessórios</option>
            <option value="capinhas">Capinhas</option>
            <option value="carregadores">Carregadores</option>
            <option value="peliculas">Peliculas</option>
            <option value="CPU">Computadores</option>
            <option value="celular">Celulares</option>
            <option value="CTV">CTV</option>
            <option value="display">Display/Touch</option>
            <option value="conectores">Conectores</option>
            <option value="cabos">Cabos</option>
            <option value="ferramenta_cel">Ferramentas p/ celular</option>
            <option value="ferramenta_CPU">Ferramentas p/ PC´s</option>
            <option value="placa_cel">Placas celular</option>
            <option value="baterias">Baterias</option>
            <option value="audio">Audio/Som</option>
            </select>
            </div>
			
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label class="form-label">Cor:</label>
            <select class="form-control" name="cor" >
            <option value="branco">Branco</option>
            <option value="preto">Preto</option>
            <option value="azul">Azul</option>
            <option value="vermelho">Vermelho</option>
            <option value="amarelo">Amarelo</option>
            <option value="verde">Verde</option>
            <option value="laranja">Laranja</option>
            <option value="cinza">Cinza</option>
            <option value="rosa">Rosa/Touch</option>
            <option value="marrom">Marrom</option>
            <option value="roxo">Roxo</option>
            <option value="prata">Prata</option>
            <option value="dourado">Dourado</option>
            </select>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Voltagem:</label>
            <select class="form-control" name="voltagem" >
            <option value="110">110 V</option>
            <option value="220">220 V</option>
            <option value="bivolt">Bi-volt</option>
            </select>            
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Opções de voltagem:</label>
            <select class="form-control" name="voltagem_opcoes" >
            <option value="110">110 V</option>
            <option value="220">220 V</option>
            <option value="bivolt">Bi-volt</option>
            </select>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Descrição:</label>
            <input class="form-control" placeholder="Digite a descrição " name="descricao" >
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Status:</label>
            <select class="form-control" name="status" >
            <option value="1">Ativo</option>
            <option value="0">Desativado</option>
            </select>
            </div>
            </div>
            </div>
            
            <h5>Variações de cores</h5>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="azul">
              <label class="form-check-label" for="defaultCheck1">
                Azul
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck2" name="vermelho">
              <label class="form-check-label" for="defaultCheck2">
                Vermelho
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck3" name="preto">
              <label class="form-check-label" for="defaultCheck3">
                Preto
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck4" name="branco">
              <label class="form-check-label" for="defaultCheck4">
                Branco
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck5" name="amarelo">
              <label class="form-check-label" for="defaultCheck5">
                Amarelo
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck6" name="verde">
              <label class="form-check-label" for="defaultCheck6">
                Verde
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck7" name="laranja">
              <label class="form-check-label" for="defaultCheck7">
                Laranja
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck8" name="cinza">
              <label class="form-check-label" for="defaultCheck8">
                Cinza
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck9" name="rosa">
              <label class="form-check-label" for="defaultCheck9">
                Rosa
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck10" name="marrom">
              <label class="form-check-label" for="defaultCheck10">
                Marrom
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck11" name="roxo">
              <label class="form-check-label" for="defaultCheck11">
                Roxo
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck12" name="prata">
              <label class="form-check-label" for="defaultCheck12">
                Prata
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck13" name="dourado">
              <label class="form-check-label" for="defaultCheck13">
                Dourado
              </label>
            </div>
            </div>
            <div class="col" >            
            </div>
            <div class="col" >            
            </div>
            </div>
            
            <div class="mb-3 mt-3" align="center">
            
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmação para adicionar novo produto</h5>
                </div>
                <div class="modal-body">
                  <p class="text-white text-start">Para adicionar o seu novo produto, clique em salvar produto.</p>
                  <p class="text-white text-start">Se não terminou de configurar, clique em fechar.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Salvar produto</button>
                </div>
              </div>
            </div>
          </div> 
        </div>';

//Parte para inserir a foto do produto
echo '<h1>Foto do produto</h1>';
              echo '<div>
                     <label class="form-check-label" for="defaultCheck13">
                        Foto Principal:
                     </label>
                    <input class="form-control" type="file" name="arquivo">
		</div>
                <div class="row mt-2">
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 1:
                     </label>
                    <input class="form-control" type="file" name="arquivo1">
		</div>
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 2:
                     </label>
                    <input class="form-control" type="file" name="arquivo2">
		</div>
		</div>
                <div class="row mt-2">
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto3:
                     </label>
                    <input class="form-control" type="file" name="arquivo3">
		</div>
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 4:
                     </label>
                    <input class="form-control" type="file" name="arquivo4">
		</div>
                </div>
                <div class="row mt-2">
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 5:
                     </label>
                    <input class="form-control" type="file" name="arquivo5">
		</div>
                <div class="col">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 6:
                     </label>
                    <input class="form-control" type="file" name="arquivo6">
		</div>
		</div>';
//parte da ficha técnica
echo '<h1 class="mt-3">Ficha técnica do produto</h1>		
<div class="row">
    <div class="col" >            
    <div class="mb-3 mt-3">
    <label class="form-label">Tamanho do produto:</label>
    <input class="form-control" placeholder="Digite o tamanho do produto" name="tamanho" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Altura:</label>
    <input class="form-control" placeholder="Digite a altura" name="altura" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Largura:</label>
    <input class="form-control" placeholder="Digite a largura " name="largura" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Peso:</label>
    <input class="form-control" placeholder="Digite o peso " name="peso" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Potência:</label>
    <input class="form-control" placeholder="Digite a potência " name="potencia" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Fabricante:</label>
    <input class="form-control" placeholder="Digite o fabricante " name="fabricante" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Garantia:</label>
    <input class="form-control" placeholder="Digite a garantia " name="garantia" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Temperatura Máxima:</label>
    <input class="form-control" placeholder="Digite a temperatura máxima " name="temperatura_max" >
    </div>
    </div>
    <div class="col">            
    
    <div class="mb-3 mt-3">
    <label class="form-label">Temperatura mínima:</label>
    <input class="form-control" placeholder="Digite a temperatura mínima " name="temperatura_min" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Armazenamento:</label>
    <input class="form-control" placeholder="Digite o armazenamento " name="capacidade_armazenamento" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Durabilidade:</label>
    <input class="form-control" placeholder="Digite a durabilidade " name="durabilidade" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Recarga:</label>
    <input class="form-control" placeholder="Digite o tempo de recarga " name="tempo_recarga" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Marca:</label>
    <input class="form-control" placeholder="Digite a marca " name="marca" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Modelo:</label>
    <input class="form-control" placeholder="Digite o modelo " name="modelo" >
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Velocidade:</label>
    <input class="form-control" placeholder="Digite a velocidade " name="velocidade" >
    </div>
    
    <div class="row">
    <div class="col">
    <div>
    <label class="form-label">Prova d´agua:</label>
    <select class="form-control" name="prova_agua" >
    <option value="0">Não</option>
    <option value="1">Sim</option>
    </select>
    </div>
    </div>
    <div class="col">
    <div>
    <label class="form-label">Resistente à agua:</label>
    <select class="form-control" name="resistente_agua" >
    <option value="0">Não</option>
    <option value="1">Sim</option>
    </select>
    </div>
    </div>
    </div>
    

    </div>
    </div>    
    <div class="mb-3 mt-3">
        <label class="form-label">Descrição completa:</label>
        <textarea class="form-control" rows="6" name="descricao_longa"></textarea>
    </div>    
    
                <div align="center">    
                <button type="button" class="btn btn-primary mt-3 " data-toggle="modal" data-target="#modalExemplo">
                    Salvar as configurações   
                </button></div></div>
</form></div>';


?>

</body>