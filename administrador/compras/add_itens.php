<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['add_itens_compra'])){$_SESSION['add_itens'] = $_GET['add_itens_compra'];}
if(isset($_GET['id_produto'])){
    $id_produto = $_GET['id_produto'];
    $id_compra = $_SESSION['add_itens'];
    $quantidade = 1;
    $data_item = date("Y-m-d H:i:s");
    
    $sql = "SELECT * FROM itens_da_compra WHERE id_produto = ".$id_produto." AND id_compra=".$id_compra."";
    $consulta = $conexao->query($sql);
    $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
    if(empty($dados)){    
    $sql ='INSERT INTO itens_da_compra (id_compra,id_produto,quantidade,data_item) values(?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_compra,$id_produto,$quantidade,$data_item));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    } 
   
    if($ok){
        $total = 0;
        $sql1 = "SELECT * FROM itens_da_compra WHERE id_compra=".$id_compra."";
        $consulta1 = $conexao->query($sql1);
        $dados1 = $consulta1->fetchALL(PDO::FETCH_ASSOC);
        
        foreach($dados1 as $d1){
            $sql2 = "SELECT * FROM produtos WHERE id_produto=".$d1['id_produto']."";
            $consulta2 = $conexao->query($sql2);
            $dados2 = $consulta2->fetch(PDO::FETCH_ASSOC);
            $total += $dados2['valor'] * $d1['quantidade']; 
        }
        
     $sql ='UPDATE compras SET total=? WHERE id_compra=?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok1 = $insercao->execute(array ($total,$id_compra));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
    } 
   }
   
    if($ok1){
        unset($_SESSION['add_itens']);
        header("location:compras_usuario.php?opcoes_compra=".$id_compra);
    }
}else{
    $mensagem_negada = '<h3 class="alert alert-danger">Produto já existente na compra! Selecione outro produto, por favor.</h3>';
}
}
?>

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
					Opções para Compras
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
				<a class="btn btn-secondary border-danger m-2" href="compras.php">Compras do dia</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_usuario.php">Compras por usuário</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_data.php">Compras por data</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_valor.php">Compras por valor</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_pag.php">Compras sem pagamento</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_nao_ent.php">Compras não entregue</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_us.php">Compras sem usuários</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
            <div class="card-header">
                <h3 class="text-info">Alteração de compras</h3>
            </div>
            <div class="card-body">
                <?php if(isset($mensagem_negada)){ echo $mensagem_negada; } ?>
                <div class="row">
                    <div class="col-sm-3">
                        
                        <input type="search" id="busca"  class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)" autofocus/>
                    </div>
                    <div class="col">
                        <div id="resultado">
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
  </div>
  