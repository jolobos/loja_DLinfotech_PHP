<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['mes']) && isset($_GET['ano'])){
    $mes = $_GET['mes'];
    $ano = $_GET['ano'];
    if($mes == 'janeiro'){ $meses = 1;}elseif($mes == 'fevereiro'){$meses = 2;}elseif($mes == 'marco'){$meses = 3;}elseif($mes == 'abril'){$meses = 4;}
    elseif($mes == 'maio'){$meses = 5;}elseif($mes == 'junho'){$meses = 6;}elseif($mes == 'julho'){$meses = 7;}elseif($mes == 'agosto'){$meses = 8;}
    elseif($mes == 'setembro'){$meses = 9;}elseif($mes == 'outubro'){$meses = 10;}elseif($mes == 'novembro'){$meses = 11;}else{$meses = 12;}
    $sql = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-".$meses."-01 00:00:00' AND hora_chegada <= '".$ano."-".$meses."-31 23:59:59' AND status = 1";
    $consulta = $conexao->query($sql);
    $a = $consulta->fetchALL(PDO::FETCH_ASSOC);

    }elseif(isset($_GET['periodo1']) && isset($_GET['periodo2'])) {
    $periodo1 = $_GET['periodo1'];
    $periodo2 = $_GET['periodo2'];
    $sql = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$periodo1." 00:00:00' AND hora_chegada <= '".$periodo2." 23:59:59' AND status = 1";
    $consulta = $conexao->query($sql);
    $a = $consulta->fetchALL(PDO::FETCH_ASSOC);
}else{
    header('location:rendimentos.php?msg=Data invalida para veririficacao.');
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
                    <a class="btn btn-secondary border-info m-2" href="rendimentos.php">Voltar</a>
                    <a class="btn btn-secondary border-info m-2" href="../home.php">INICIO</a>
                    <a href="../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
                </div>
            </div>
                  
           <?php echo '<img src="../../img/foto_usuario/'.$foto.'" style="border-radius: 50%;width:50px;height:50px;align=left;margin-left:20px;margin-bottom:15px;">';
           echo '<strong class="text-success"> - '.$nome.' </strong>';
           ?>
	</div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary">Verificação de entregas</h3>
        </div>
        <div class="card-body"> <?php
        if(isset($_GET['mes']) && isset($_GET['ano'])){
        echo '<h4>Lista de entregas feitas em '.$mes.' de '.$ano.'</h4>';}else{
            echo '<h4>Lista de entregas feitas desde '.date_format(new DateTime($periodo1),'d/m/Y').' até '.date_format(new DateTime($periodo2),'d/m/Y').'</h4>';
        }
        ?>
            <div  style="max-height:320px" class="overflow-auto bg-light">
                   <?php
                        if(!empty($a)){
                        foreach($a as $b){
                            
                            if(empty($b['parente_entrega'])){
                                $parente = 'não informado';
                            }else{
                                $parente = $b['parente_entrega'];
                            }
                            if(empty($b['obs_entrega'])){
                                $obs = 'não informado';
                            }else{
                                $obs = 'Existe observações na entrega.';
                            }
                            $sql2 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$b['id_endereco']."'";
                            $consulta2 = $conexao->query($sql2);
                            $d = $consulta2->fetch(PDO::FETCH_ASSOC);
                        
                            $localizacao = $d['logradouro'].' '.$d['numero'].' '.$d['bairro'].' '.$d['cidade'].' '.$d['UF'];
                        echo '<form method="POST">
                                 <div class="row">
                                 <div class="col-sm-3">
                                    <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                    <strong>Código da entrega:</strong> '.$b['id_compra'].' 
                                    </label>
                                 </div>
                                 <div class="col-sm-1">
                                 <input type="hidden" name="ver_entrega" value="'.$b['id_entregas'].'">
                                 <input type="submit" class="btn btn-secondary h-75 pt-0" value="Visualizar">
                                </div>
                                 <div class="col">
                                <a class="btn btn-secondary h-75 pt-0 ms-2" href="https://maps.google.it/maps?q='.$localizacao.'" target="_blank">Ver no mapa</a>
                                </div>
                                </div>
                                <h6 class="mb-0" >Endereço</h6>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong>CEP:</strong> '.$d['CEP'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong> Rua:</strong> '.$d['logradouro'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong> Bairro:</strong> '.$d['bairro'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong> Cidade:</strong> '.$d['cidade'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong> UF:</strong> '.$d['UF'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong> n°:</strong> '.$d['numero'].' 
                                </label>
                                <h6 class="mb-0" >Informações sobre a entrega</h6>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong>Recebedor:</strong> '.$b['nome_entrega'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong>CPF:</strong> '.$b['CPF_entrega'].' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong>Parentesco:</strong> '.$parente.' 
                                </label>
                                <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                <strong>Observações:</strong> '.$obs.' 
                                </label>
                               </form><hr/>';
                        }}else{
                             echo '<h3 class="alert alert-danger">Não existe entregas para a data selecionada!</h3>';
                        }
                              
                            ?>
            </div>
        </div>        
    </div>        
  </div>    
      <?php
      if(isset($_POST['ver_entrega'])){
          $id = $_POST['ver_entrega'];
          echo $id;
          echo  '<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

                            <script type="text/javascript">
                  $(window).load(function() {
                      $("#exemplomodal").modal("show");
                  });
                  </script>
                   <div class="modal fade modal-lg" id="exemplomodal">
                    <div class="modal-dialog">
                      <div class="modal-content">';
                      echo '<div class="modal-header bg-info">
                        <h3 class="modal-title">Verificação completa</h3>
                    </div>
                    <div class="modal-body bg-light">
                        <div style="max-height:400px" class="overflow-auto bg-light">        
';
                        $sql = "SELECT * FROM entregas WHERE id_entregas = ".$id."";
                        $consulta = $conexao->query($sql);
                        $a = $consulta->fetch(PDO::FETCH_ASSOC);
                        
                        $sqlu = "SELECT * FROM usuarios WHERE id_usuario = ".$a['id_usuario']."";
                        $consultau = $conexao->query($sqlu);
                        $au = $consultau->fetch(PDO::FETCH_ASSOC);
                        
                        $sqlc = "SELECT * FROM compras WHERE id_compra = ".$a['id_compra']."";
                        $consultac = $conexao->query($sqlc);
                        $ac = $consultac->fetch(PDO::FETCH_ASSOC);
                        $date_n = date_format(date_create($ac['data']),"d/m/Y H:i:s");
                        
                        $sqlic = "SELECT * FROM itens_da_compra WHERE id_compra = ".$a['id_compra']."";
                        $consultaic = $conexao->query($sqlic);
                        $aic = $consultaic->fetchALL(PDO::FETCH_ASSOC);
                        
                        $sqle = "SELECT * FROM endereco_usuario WHERE id_endereco = ".$a['id_endereco']."";
                        $consultae = $conexao->query($sqle);
                        $ae = $consultae->fetch(PDO::FETCH_ASSOC);
                        
                        echo '<table class="table table-strip border border-2 border-dark">
                        <tbody><tr><td><strong>Código da entrega</strong> '.$id.'</td><td><strong>Comprador</strong> '.$au['nome'].'</td><td><strong>Data da compra</strong> '.$date_n.'</td></tr>
                        <tr><td colspan=3><strong>Endereço de entrega</strong><br>
                        <strong>Rua:</strong> '.$ae['logradouro'].'<strong> N°:</strong> '.$ae['numero'].' <strong>Bairro:</strong> '.$ae['bairro'].' <strong>Cidade:</strong> '.$ae['cidade'].' <strong>CEP:</strong> '.$ae['CEP'].'</td></tr>
                        <tr><td colspan=3><strong>Produtos da entrega</strong><br>';
                        $contador = 1;
                        foreach($aic as $itens){
                            $sqlp = "SELECT * FROM produtos WHERE id_produto = ".$itens['id_produto']."";
                            $consultap = $conexao->query($sqlp);
                            $ap = $consultap->fetch(PDO::FETCH_ASSOC);
                            
                            echo '<strong>'.$contador.'° Produto:</strong><br><strong>Código:</strong> '.$ap['cod_produto'].'<strong>Produto:</strong> '.$ap['nome'].'
                                  <strong>Quantidade:</strong> '.$itens['quantidade'].'<hr>';
                            $contador++;
                        }
                        
                        echo '</td></tr>
                        <tr><td colspan=3><strong>Informações sobre a entrega</strong><br>
                        <strong>Pessoa que recebeu a entrega:</strong> '.$a['nome_entrega'].'<strong> CPF do responsável:</strong> '.$a['CPF_entrega'].' <strong>Parentesco:</strong> '.$a['parente_entrega'].'<br>
                            <strong>Observações da entrega: </strong> '.$a['obs_entrega'].'</td></tr>
                        </tbody></table>';
                        
                    
                      echo '</div></div><div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                          </div>
                        </div>
                      </div>
                    </div>';

                                      }
      ?>
</body>