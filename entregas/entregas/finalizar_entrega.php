<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if($_POST['concluir_ent']){
    $id_compra = $_POST['concluir_ent'];
    $nome_entrega = $_POST['nome_entrega'];
    $CPF_entrega = $_POST['CPF_entrega'];
    if($_POST['parente_entrega']){
    $parente_entrega = $_POST['parente_entrega'];
    }else{
        $parente_entrega = '';
    }
    if($_POST['obs_entrega']){
    $obs_entrega = $_POST['obs_entrega'];
    }else{
        $obs_entrega = '';
    }
    $sql455z = "SELECT * FROM entregas WHERE id_compra = '".$id_compra."'";
    $consulta455z = $conexao->query($sql455z);
    $b = $consulta455z->fetch(PDO::FETCH_ASSOC);
    
    $remover = array($id_compra);
    $_SESSION['ordem_etinerario'] = array_diff($_SESSION['ordem_etinerario'], $remover);
    $zero = 1;
    $zera_hor =  date('Y-m-d H:i:s');
    $sql ='UPDATE entregas SET ordem_ent=?,chegada=?,hora_chegada=?,status=? WHERE id_compra = '.$id_compra.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok2 = $insercao->execute(array ($zero,$zero,$zera_hor,$zero));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok2 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok2= False; 
                    }
    if($ok2){   
        $conttt = 1;
    foreach ($_SESSION['ordem_etinerario'] as $vish){
               
               $sql ='UPDATE entregas SET ordem_ent=? WHERE id_compra = '.$vish.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($conttt));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
                $conttt++;}
    
       
}
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
</head>
  <body style="background: #778899">
    <div class="container">
        <div class="bg-dark">
            <div class="row">
                <div class="col" >
                    <h1 class="text-success ms-3">
                        Sistema de entregas DL
                    </h1>
                </div>
                <div class="col" align="right">
                    <a class="btn btn-secondary border-info m-2" href="../home.php">INICIO</a>
                    <a href="../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
                </div>
            </div>
                
           <?php echo '<img src="../../img/foto_usuario/'.$foto.'" style="border-radius: 50%;width:50px;height:50px;align=left;margin-left:20px;margin-bottom:15px;">';
           echo '<strong class="text-success"> - '.$nome.' </strong>';
           ?>
	</div>
    <div class="card">
        <div class="card-header"></div>
    </div>
    </div>
  </body>
