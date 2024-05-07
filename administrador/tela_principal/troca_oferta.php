<?php

require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
$sql1 = "SELECT * FROM tela_principal ";
$consulta1 = $conexao->query($sql1);
$dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);

if(!empty($_GET['oferta'])){
    $_SESSION['oferta'] = $_GET['oferta'];
    $oferta = $_SESSION['oferta'];
}else{
    $oferta = $_SESSION['oferta']; 
}

if(!empty($_GET['id_produto'])){
    $id_p = $_GET['id_produto'];
    $sql ='UPDATE tela_principal SET id_oferta_'.$oferta.'=? WHERE id_tela = 1' ;
    try {
    $insercao = $conexao->prepare($sql);
    $ok = $insercao->execute(array($id_p));
    }catch(PDOException $r){
            $msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok = False;
    }catch (Exception $r){//todos as exceções
    $ok= False; 

    }
            if ($ok){
                    $msg= 'Box alterado com sucesso!.';
                    }else{
                            $msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
            }
    header('location:troca_oferta.php?mensagem='.$msg);
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

</head>
  <body style="background: #778899">
  <div class="container">
        <div class="bg-dark"><h1 class="text-success">
                Opções para tela inicial
        </h1>
        <a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
        <a href="index_init.php" class="btn btn-secondary border-danger m-2">Voltar</a>
        <a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
        </div>

 <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Ofertas</h3>
                    </div>
     <div class="card-body">
         <?php
            $id = $dados1['id_oferta_'.$oferta];
            $sqla = "SELECT * FROM produtos WHERE id_produto ='".$id."'";
            $consultaa = $conexao->query($sqla);
            $dadosa = $consultaa->fetch(PDO::FETCH_ASSOC);

         
         echo   '
                <h4>Oferta atual - n°: '.$oferta.'</h4>
                 <img src="../../img/produtos/'.$dadosa['foto'].'" style="height:200px;width:200px">
                                <p><strong>Nome: </strong>'.$dadosa['nome'].'</p>
                                <p><strong>Descrição: </strong>'.$dadosa['descricao'].'</p>
                                <p><strong>Valor: </strong>R$ '. number_format($dadosa['valor'],2,',','.').'</p>
                                <p><strong>Categoria: </strong>'.$dadosa['categoria'].'</p><hr>
                                <h4>Trocar oferta: </h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Mudar oferta
                                </button>';
             ?>
         
     

<!-- Modal -->
<div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 90%">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h4 class="mt-3">Pesquisar produto: </h4>
        <div class="col-sm-5">
        <input type="search" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)"/>
        </div>
      <div id="resultado"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
     </div>
     </div>
      
      
     </div>
     