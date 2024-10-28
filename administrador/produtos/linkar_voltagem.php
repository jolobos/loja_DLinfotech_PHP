<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');



if(!empty($_POST['cod_barras'])){
    $sql = "SELECT * FROM produtos WHERE cod_produto = ".$_POST['cod_barras']."";
    $consulta = $conexao->query($sql);
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);
    if(!empty($dados['id_produto'])){
    $_SESSION['produto_escolhido'] = $dados['id_produto'];
    
    }
}
if(!empty($_SESSION['produto_escolhido'])){
$sql = "SELECT * FROM produtos WHERE id_produto = ".$_SESSION['produto_escolhido']."";
$consulta = $conexao->query($sql);
$dados = $consulta->fetch(PDO::FETCH_ASSOC);
if($dados['v_110'] == 0 && $dados['v_220'] == 0 && $dados['v_bivolt'] == 0 ){
        $n = 1;
        $sql ='UPDATE produtos SET s_volt=? WHERE id_produto = '.$_SESSION['produto_escolhido'].'';
        try {
            $insercao = $conexao->prepare($sql);
            $ok = $insercao->execute(array ($n));
        }catch(PDOException $r){
    //$msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok = False;
        }catch (Exception $r){//todos as exceções
            $ok= False; 
        }
    }
}
$escolha_volt = '';
$cod_selecionado = '';
if(!empty($_POST['cod_barras_110'])){
    $cod_selecionado = $_POST['cod_barras_110'];
    $escolha_volt = 'link_110';
}
if(!empty($_POST['cod_barras_220'])){
    $cod_selecionado = $_POST['cod_barras_220'];
    $escolha_volt = 'link_220';
}
if(!empty($_POST['cod_barras_bivolt'])){
    $cod_selecionado = $_POST['cod_barras_bivolt'];
    $escolha_volt = 'link_bivolt';
}

if(!empty($cod_selecionado) && !empty($_SESSION['produto_escolhido'])){
    $sql ='UPDATE produtos SET '.$escolha_volt.'=? WHERE id_produto = '.$_SESSION['produto_escolhido'].'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($cod_selecionado));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    header('location:linkar_voltagem.php');
}
$link_23 = '';
$ativa_volt = 0;
$esc_at_cor = '';
if(!empty($_GET['ativa_110']) || !empty($_GET['desativa_110'])){
    $esc_at_cor = 'v_110';
    if(isset($_GET['ativa_110'])){$ativa_volt = 1;}
    if(isset($_GET['desativa_110'])){$link_23 = 'link_110';}
}
if(!empty($_GET['ativa_220']) || !empty($_GET['desativa_220'])){
    $esc_at_cor = 'v_220';
    if(isset($_GET['ativa_220'])){$ativa_volt = 1;}
    if(isset($_GET['desativa_220'])){$link_23 = 'link_220';}
}
if(!empty($_GET['ativa_bivolt']) || !empty($_GET['desativa_bivolt'])){
    $esc_at_cor = 'v_bivolt';
    $link_23 = 'link_bivolt';
    if(isset($_GET['ativa_bivolt'])){$ativa_volt = 1;}
    if(isset($_GET['desativa_bivolt'])){$link_23 = 'link_bivolt';}
}

if(!empty($esc_at_cor) && $ativa_volt == 1){
    $sql ='UPDATE produtos SET '.$esc_at_cor.'=?,s_volt=0 WHERE id_produto = '.$_SESSION['produto_escolhido'].'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($ativa_volt));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    header('location:linkar_voltagem.php');
}
if(!empty($esc_at_cor) && $ativa_volt == 0){
    $v = '';
    $sql ='UPDATE produtos SET '.$esc_at_cor.'=?,'.$link_23.'=? WHERE id_produto = '.$_SESSION['produto_escolhido'].'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($ativa_volt,$v));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    header('location:linkar_voltagem.php');
}
if(isset($_GET['ativa_s_volt'])){
    $ativa_volt = 1;
    $sql ='UPDATE produtos SET s_volt=?,v_110=0,v_220=0,v_bivolt=0 WHERE id_produto = '.$_SESSION['produto_escolhido'].'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($ativa_volt));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    header('location:linkar_voltagem.php');
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
    <script type="text/javascript" src="func_link_cor.js"></script>
    <link rel="stylesheet" href="../../css/modal.css">
    <script src="https://kit.fontawesome.com/0f8eed42e7.js" crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E6M96X7Y2Y"></script>

  
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
      <?php
      if(isset($_GET['msg'])){          
            echo '<h2 class="alert alert-info mt-2">'.$_GET['msg'].'</h2>';}
      ?>
      
      <div class="card mt-2">
          <div class="card-header">
              <div class="row">
                  <div class="col">
              <h4>Escolha uma das opções abaixo:</h4>
                  </div>
                  <div class="col" align="right">
                      <button class="btn btn-secondary border-info" data-bs-toggle="modal" data-bs-target="#exampleModal7">Visualizar produtos sem link</button>
                  </div>
                  </div>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    Buscar produto
                                </button>
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
                         if($dados_b['v_110'] == 1){
                            if(empty($dados_b['link_110'])){
                                echo '<h5>Voltagem 110: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_110">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';}else{
                                echo '<h5>Voltagem 110: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_110" value="'.$dados_b['link_110'].'">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                            </div>';
                            }
                             }
                            
                             if($dados_b['v_220'] == 1){
                                 if(empty($dados_b['link_220'])){
                            echo '<h5>Voltagem 220: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_220">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';}else{
                                echo '<h5>Voltagem 220: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_220" value="'.$dados_b['link_220'].'">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';
                            }}
                            
                             if($dados_b['v_bivolt'] == 1){
                                 if(empty($dados_b['link_bivolt'])){
                            echo '<h5>Voltagem Bi-volt: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_bivolt">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';}else{
                                echo '<h5>Voltagem Bi-volt: </h5>
                            <div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-8" >            
                                    <input class="form-control " placeholder="Digite ou leia código do produto..." name="cod_barras_bivolt" value="'.$dados_b['link_bivolt'].'">
                                </div>
                                        <div class="col" >            
                                            <input type="submit" class="btn btn-dark " value="Linkar">
                                </div>
                                </div>
                            </form>
                             </div>';
                            }}
                            
                            
                            
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
                                echo '</tr>';
                               
                                if($dados_a['v_110'] == 1){
                                    echo '<tr><td>
                                    <label>110</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" checked disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_110=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_110=ok">Desativar</a></td></tr>';
                                }else{
                                    echo '<tr><td>
                                    <label>110</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled"  disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_110=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_110=ok">Desativar</a></td></tr>';
                                }
                                
                                if($dados_a['v_220'] == 1){
                                    echo '<tr><td>
                                    <label>220</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" checked disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_220=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_220=ok">Desativar</a></td></tr>';
                                }else{
                                    echo '<tr><td>
                                    <label>220</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled"  disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_220=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_220=ok">Desativar</a></td></tr>';
                                }
                                
                                if($dados_a['v_bivolt'] == 1){
                                    echo '<tr><td>
                                    <label>Bivolt</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" checked disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_bivolt=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_bivolt=ok">Desativar</a></td></tr>';
                                }else{
                                    echo '<tr><td>
                                    <label>Bivolt</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled"  disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_bivolt=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_bivolt=ok">Desativar</a></td></tr>';
                                }
                                
                                if($dados_a['s_volt'] == 1){
                                    echo '<tr><td>
                                    <label>Nenhum</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" checked disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_s_volt=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_s_volt=ok">Desativar</a></td></tr>';
                                }else{
                                    echo '<tr><td>
                                    <label>Nenhum</label> 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled"  disabled>
                                    </td><td><a class="btn btn-secondary" href="?ativa_s_volt=ok">Ativar</a>
                                    <a class="btn btn-secondary" href="?desativa_s_volt=ok">Desativar</a></td></tr>';
                                }
                                
                                echo '</table>';
                            }
                        ?>
                    </div>
                </div>
                </div>
                </div>
              <div>
                  <a class="btn btn-secondary border-info" href="regularizar_voltagem.php">Aplicar configurações em todos os produtos</a>
              </div>
      </div>
      </div>
      </div>
      
      <div class="modal fade modal-xl" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Busca de Produtos</h5>
      </div>
          
      <div class="modal-body bg-light">
         <input type="search" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)"/>
         <div class="mt-2" id="resultado"></div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
      <div class="modal fade modal-xl" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Busca de Produtos</h5>
      </div>
      <div class="modal-body bg-light">
     <?php 
     $quantidade_us = 10; 
     $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
     $inicio     = ($quantidade_us * $pagina) - $quantidade_us;  
      $sql_37 = "SELECT * FROM produtos WHERE link_110 = 0 AND
               link_220 = 0 AND link_bivolt = 0 AND s_volt = 0  LIMIT $inicio,$quantidade_us";
      $consulta_37 = $conexao->query($sql_37);
      $dados_37 = $consulta_37->fetchALL(PDO::FETCH_ASSOC);

  

    
  
  echo '<table  border="3" class="table table-striped border-secondary" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>foto</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  $cont = 0;
  $clip = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
  <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
</svg> - Copiar';
  foreach($dados_37 as $d){
          

	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>
          <textarea class="form-control ms-3 border-dark" rows="1"  id="cod_produto_'.$cont.'" onclick="copiar_'.$cont.'()">'.$d['cod_produto'].'</textarea>
          </td><td>'.$d['nome'].'</td><td><img style="width:50px;height:50px " src="../../img/produtos/'.$d['foto'].'"></td>
	  <td>'.$status.'</td><td>
          <p><button type="button" id="clip_btn" class="btn btn-primary ms-3"  data-toggle="tooltip" data-placement="top" title="Copiar código pix" onclick="copiar_'.$cont.'()">'.$clip.'</button></p></td></tr>';
 
          $cont++;
          }
  
  echo '</tbody>';
   echo '</table>';
   
   //paginacao
   if(!empty($dados_37)){
            //continuando paginação
            $sqlTotal ="SELECT COUNT(id_produto) as id FROM produtos WHERE link_azul = 0 AND
               link_vermelho = 0 AND link_preto = 0 AND link_branco = 0 AND
               link_amarelo = 0 AND link_verde = 0 AND link_laranja = 0 AND
               link_cinza = 0 AND link_rosa = 0 AND link_marrom = 0 AND
               link_roxo = 0 AND link_prata = 0 AND link_dourado = 0";
            //Executa o SQL
            $consulta_c = $conexao->query($sqlTotal);
            $qrTotal = $consulta_c->fetch(PDO::FETCH_ASSOC);
            
            //O calculo do Total de página ser exibido
            $totalPagina= ceil($qrTotal['id']/$quantidade_us);
            /**
            * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
            */
            $exibir = 3;
            /**
            * Aqui montará o link que voltará uma pagina
            * Caso o valor seja zero, por padrão ficará o valor 1
            */
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
            /**
            * Aqui montará o link que ir para proxima pagina
            * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
            * caso contrario, ele pegar o valor da página + 1
            */
            $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
            /**
            * Agora monta o Link paar Primeira Página
            * Depois O link para voltar uma página
            */
            /**
            * Agora monta o Link para Próxima Página
            * Depois O link para Última Página
            */
            echo '<div id="navegacao" align="center">';
            echo '<a  class="btn btn-primary mb-2" href="?pagina=1">primeira</a> | ';
            echo "<a  class='btn btn-primary mb-2' href=\"?pagina=$anterior\">anterior</a> | ";
            /**
            * O loop para exibir os valores à esquerda
            */
            for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
            if($i > 0)
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'"> '.$i.'</a>';
            }
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';
            for($i = $pagina+1; $i < $pagina+$exibir; $i++){
            if($i <= $totalPagina)
            echo '<a class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'"> '.$i.' </a>';
            }
            /**
            * Depois o link da página atual
            */
            /**
            * O loop para exibir os valores à direita
            */
            echo " | <a class='btn btn-primary mb-2' href=\"?pagina=$posterior\">próxima</a> | ";
            echo "  <a class='btn btn-primary mb-2' href=\"?pagina=$totalPagina\">última</a>";
            }
   
   
   
   ?>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php
//document.getElementById("clip_btn").innerHTML='<i class="fas fa-clipboard-check"></i> - Copiado';
$cont_2 = 0;
while($cont_2 < 10){
    echo '<script>
            function copiar_'.$cont_2.'() {
            var copyText = document.getElementById("cod_produto_'.$cont_2.'");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand("copy");

            }
            </script>';

    $cont_2++;
}
?>