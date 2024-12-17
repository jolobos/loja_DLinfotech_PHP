<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_SESSION['controlador'])){
    header('location:../entregas/entrega_iniciada.php?rodando=Você tem uma entrega curso, conclua ela ou cancele para poder acessar as outras paginas do entregador. Em até 6 horas de curso, sua entrega será cancelada automaticamente');
}
   if(!isset($_SESSION['ordem_etinerario'])){
        $_SESSION['ordem_etinerario'] = array();
        $sqlZYZ = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."' AND ordem_ent !=0 ORDER BY ordem_ent ASC";
	$consultaZYZ = $conexao->query($sqlZYZ);
	$dZYZ = $consultaZYZ->fetchALL(PDO::FETCH_ASSOC);
        foreach ($dZYZ as $g){
            array_push($_SESSION['ordem_etinerario'],$g['id_compra']);
        }            
}

if(isset($_POST['concluir_etinerario'])){
    if(!empty($_SESSION['ordem_etinerario'])){
        
        $sql ='UPDATE entregas SET ordem_ent=? WHERE id_entregador = '.$id_entregador.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($conttt));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
        
        $conttt = 1;
        foreach ($_SESSION['ordem_etinerario'] as $id_compra21){
           
            $sql ='UPDATE entregas SET ordem_ent=? WHERE id_compra = '.$id_compra21.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($conttt));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
                    $conttt++;
                    }
			}
		unset($_SESSION['ordem_etinerario']);
                header('location:../entregas/iniciar.php');
        
    }



if(isset($_GET['zerar'])){
    unset($_SESSION['ordem_etinerario']);
    $sql ='UPDATE entregas SET ordem_ent=? WHERE id_entregador = '.$id_entregador.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($conttt));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
                    
    header('location:seleciona_etinerario.php');
}
if(isset($_GET['tirar'])){
    $remover = array($_GET['tirar']);
    $_SESSION['ordem_etinerario'] = array_diff($_SESSION['ordem_etinerario'], $remover);
    header('location:seleciona_etinerario.php');
}
if(!empty($_POST['sel_etinerario'])){
    $cont = 0;
    foreach ($_SESSION['ordem_etinerario'] as $ZYS){
        if($ZYS == $_POST['sel_etinerario']){
            $cont++;
        }
    }
    if($cont == 0){
    array_push($_SESSION['ordem_etinerario'], $_POST['sel_etinerario']); }}             
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
                    <a class="btn btn-secondary border-info m-2" href="../selecionar/seleciona_entrega.php">selecionar entregas</a>
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
                <h2 class="text-primary">Monte a ordem de suas entregas</h2>  
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8" ><div  style="max-height:320px" class="overflow-auto">
                            <h5>Entregas</h5>
                <?php
                    $sql45 = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."'";
                    $consulta45 = $conexao->query($sql45);
                    $d45 = $consulta45->fetchALL(PDO::FETCH_ASSOC);
                    
                    foreach($d45 as $a){
                       $sql2 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$a['id_endereco']."'";
			$consulta2 = $conexao->query($sql2);
			$d = $consulta2->fetch(PDO::FETCH_ASSOC);
                        
                        $CEP = $d['CEP'];
					$rua = $d['logradouro'];
					$bairro = $d['bairro'];
					$cidade = $d['cidade'];
					$UF = $d['UF'];
					$numero = $d['numero'];
					$complemento = $d['complemento'];
					$ponto_referencia = $d['ponto_referencia'];
					$retirada_com = $d['retirada_com'];
					$telefone_entrega = $d['telefone_entrega'];
                                        
		$localizacao = $d['logradouro'].' '.$d['numero'].' '.$d['bairro'].' '.$d['cidade'].' '.$d['UF'];					
		echo '<div class="row">
                        <div class="col">
                  <form method="POST">
		  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong>Código:</strong> '.$a['id_compra'].' 
		  </label></br>
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
		  </label></br>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> n°:</strong> '.$d['numero'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Complemento:</strong> '.$d['complemento'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
		  </label></br>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
		  </label></div>
                  <div class="col-sm-2"> 
                  <input type="hidden" name="sel_etinerario" value="'.$a['id_compra'].'">
                  <input class="btn btn-primary me-4" type="submit" id="endereco'.$d['id_endereco'].'"  value=">>"></br>
                  <a class="btn btn-primary mt-2" href="https://maps.google.it/maps?q='.$localizacao.'" target="_blank">Ver no mapa</a>
                  </div>
                  </div>
                  </form><hr/>
                ';                  
                   
                    }
                  
                ?>  
                </div>            
                </div>
                    <div class="col">
                        <div  style="max-height:320px" class="overflow-auto">
                        <h5>Ordem de entrega</h5>
                            <?php
                                            $contt = 1;
                                 foreach ($_SESSION['ordem_etinerario'] as $ZWQ){
                                     echo $contt.'° - '.$ZWQ.' <a class="btn btn-secondary mb-2" href="?tirar='.$ZWQ.'">R</a></br>';
                                     $contt++;
                                 }            
                                 echo '<a class="btn btn-secondary" href="?zerar=ok">Excluir Ordem</a>';           
                            ?>

                    </div>    
                    </div>    
                </div>
                <div align="center">
                <form method="POST">
                    <input type="hidden" name="concluir_etinerario" value="ok"/>
                    <input type="submit" class="btn btn-success mt-4" value="Fechar Etinerario"/>
                </form>
                </div>
            </div>
    </div>
    </div>
  </body>
            
                
