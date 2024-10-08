<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_POST['cod_barras'])){
    $sql = "SELECT id_produto FROM produtos WHERE cod_produto = ".$_POST['cod_barras']."";
    $consulta = $conexao->query($sql);
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);
    if(!empty($dados['id_produto'])){
    $_SESSION['produto_escolhido'] = $dados['id_produto'];
    }
}

if(!empty($_POST['cod_barras_azul'])){
    $_SESSION['azul'] = $_POST['cod_barras_azul'];
}
if(!empty($_POST['cod_barras_vermelho'])){
    $_SESSION['vermelho'] = $_POST['cod_barras_vermelho'];
}
if(!empty($_POST['cod_barras_preto'])){
    $_SESSION['preto'] = $_POST['cod_barras_preto'];
}
if(!empty($_POST['cod_barras_branco'])){
    $_SESSION['branco'] = $_POST['cod_barras_branco'];
}
if(!empty($_POST['cod_barras_amarelo'])){
    $_SESSION['amarelo'] = $_POST['cod_barras_amarelo'];
}
if(!empty($_POST['cod_barras_verde'])){
    $_SESSION['verde'] = $_POST['cod_barras_verde'];
}
if(!empty($_POST['cod_barras_laranja'])){
    $_SESSION['laranja'] = $_POST['cod_barras_laranja'];
}
if(!empty($_POST['cod_barras_cinza'])){
    $_SESSION['cinza'] = $_POST['cod_barras_cinza'];
}
if(!empty($_POST['cod_barras_rosa'])){
    $_SESSION['rosa'] = $_POST['cod_barras_rosa'];
}
if(!empty($_POST['cod_barras_marrom'])){
    $_SESSION['marrom'] = $_POST['cod_barras_marrom'];
}
if(!empty($_POST['cod_barras_roxo'])){
    $_SESSION['roxo'] = $_POST['cod_barras_roxo'];
}
if(!empty($_POST['cod_barras_prata'])){
    $_SESSION['prata'] = $_POST['cod_barras_prata'];
}
if(!empty($_POST['cod_barras_dourado'])){
    $_SESSION['dourado'] = $_POST['cod_barras_dourado'];
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
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col">   
                <form action="" method="post">
                <h4>Leitor de código de barras:</h4>
                <div class="row">
                    <div class="col" >            
                        <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras" autofocus>
                    </div>
                            <div class="col" >            
                                <input type="submit" class="btn btn-dark " value="Adicionar">
                    </div>
                </div>
                </form>
              
                
                <?php
                    if(!empty($_SESSION['produto_escolhido'])){
                        
                        $sql_b = "SELECT * FROM produtos WHERE id_produto = ".$_SESSION['produto_escolhido']."";
                        $consulta_b = $conexao->query($sql_b);
                        $dados_b = $consulta_b->fetch(PDO::FETCH_ASSOC);
                        echo '<hr>
                            <div class="row">
                                <div class="col">';
                         if($dados_b['azul'] == 1){
                            echo '<h5>Azul: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_azul">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';
                             }
                            
                             if($dados_b['vermelho'] == 1){
                            echo '<h5>Vermelho: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_vermelho">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';}
                            
                             if($dados_b['branco'] == 1){
                            echo '<h5>Branco: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_branco">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';}
                            
                            if($dados_b['preto'] == 1){
                            echo '<h5>Preto: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_preto">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['amarelo'] == 1){
                            echo '<h5>Amarelo: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_amarelo">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['verde'] == 1){
                            echo '<h5>Verde: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_verde">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['laranja'] == 1){
                            echo '<h5>Laranja: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_laranja">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            echo '</div>
                            
                            <div class="col">';
                            
                            if($dados_b['cinza'] == 1){
                            echo '<h5>Cinza: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_cinza">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['rosa'] == 1){
                            echo '<h5>Rosa: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_rosa">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['marrom'] == 1){
                            echo '<h5>Marrom: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_marrom">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['roxo'] == 1){
                            echo '<h5>Roxo: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_roxo">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['prata'] == 1){
                            echo '<h5>Prata: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_prata">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            
                            if($dados_b['dourado'] == 1){
                            echo '<h5>Dourado: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_dourado">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}
                            echo '</div>
                                </div>';
                    }
                
                ?>
                </div>
                <div class="col-sm-4">
                    <div class="card mt-2 h-100">
                    <div class="card-header">
                        <h4>Produto escolhido:</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if(!empty($_SESSION['produto_escolhido'])){
                                $sql_a = "SELECT * FROM produtos WHERE id_produto = ".$_SESSION['produto_escolhido']."";
                                $consulta_a = $conexao->query($sql_a);
                                $dados_a = $consulta_a->fetch(PDO::FETCH_ASSOC);
                               
                                echo '<table><tr>';
                                echo '<td><img style="width:100px "src="../../img/produtos/'.$dados_a['foto'].'"></td>';
                                echo '<td><strong>'.$dados_a['nome'].'</strong></td>';
                                echo '</tr></table>';
                               
                                if(isset($_SESSION['azul']) && $dados_a['azul'] == 1){
                                    echo '<tr><td>Azul = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['vermelho']) && $dados_a['vermelho'] == 1){
                                    echo '<tr><td>Vermelho = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['branco']) && $dados_a['branco'] == 1){
                                    echo '<tr><td>Branco = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['preto']) && $dados_a['preto'] == 1){
                                    echo '<tr><td>Preto = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['amarelo']) && $dados_a['amarelo'] == 1){
                                    echo '<tr><td>Amarelo = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['verde']) && $dados_a['verde'] == 1){
                                    echo '<tr><td>Verde = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['laranja']) && $dados_a['laranja'] == 1){
                                    echo '<tr><td>Laranja = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['cinza']) && $dados_a['cinza'] == 1){
                                    echo '<tr><td>Cinza = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['rosa']) && $dados_a['rosa'] == 1){
                                    echo '<tr><td>Cinza = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['marrom']) && $dados_a['marrom'] == 1){
                                    echo '<tr><td>Marrom = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['roxo']) && $dados_a['roxo'] == 1){
                                    echo '<tr><td>Roxo = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['prata']) && $dados_a['prata'] == 1){
                                    echo '<tr><td>Prata = OK</td></tr>';
                                }
                                
                                if(isset($_SESSION['dourado']) && $dados_a['dourado'] == 1){
                                    echo '<tr><td>Dourado = OK</td></tr>';
                                }
                                
                            }
                        ?>
                    </div>
                </div>
                </div>
                </div>
      </div>
      </div>