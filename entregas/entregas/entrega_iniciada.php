<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['cancelar_ent'])){
    $remover = array($_POST['cancelar_ent']);
    $motivo_can = $_POST['motivo_can'];
    $_SESSION['ordem_etinerario'] = array_diff($_SESSION['ordem_etinerario'], $remover);
    $zero = 0;
    $zera_hor = '';
    $rem = $_POST['cancelar_ent'];
    $sql ='UPDATE entregas SET ordem_ent=?,saida=?,hora_saida=?,motivo_canc=?,cancelamento=1 WHERE id_compra = '.$rem.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok2 = $insercao->execute(array ($zero,$zero,$zera_hor,$motivo_can));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok2 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok2= False; 
                    }
    if($ok2){  
        
                $sqlzb = 'SELECT * FROM compras WHERE id_compra='.$rem.'';
                                $consultazb = $conexao->query($sqlzb);
                                $dadozb = $consultazb->fetch(PDO::FETCH_ASSOC);
                                
                        $id_usuarioza = $dadozb['id_usuario'];
                        $tituloza = 'Lamento! Aconteceu algo inesperado na sua entrega.';
                        $conteudoza = 'Infelizmente não foi possivel realizar a sua entrega nesse momento.<br>'
                                . 'Mas não se preocupe, assim que possivel estaremos realizando novamente a sua entrega.<br>'
                                . 'Segue a motivação do porque não foi possivel entregar a sua compra:<br>'.$motivo_can;
                        $link_1 = '';
                        $link_2 = '';
                        $link_3 = '';
                        $link_4 = '';
                        $link_5 = '';
                        $condicaoza = 1;
                        $data_new = date('Y-m-d H:i:s');
                                
                $sqlza ='INSERT INTO notificacoes (id_usuario,titulo,conteudo,link_1,link_2,link_3,link_4,link_5,condicao,data_envio) values(?,?,?,?,?,?,?,?,?,?)';
		try {
		$insercaoza = $conexao->prepare($sqlza);
		$okza = $insercaoza->execute(array ($id_usuarioza,$tituloza,$conteudoza,$link_1,$link_2,$link_3,$link_4,$link_5,$condicaoza,$data_new));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
        
        
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
                    unset($_SESSION['ordem_etinerario']);
    
    header('location:entrega_iniciada.php?zera_control=ok');
    
                    }else{
        header('location:entrega_iniciada.php?tudo_errado=ok');
    }
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

if(isset($_SESSION['controlador']) && !empty($_SESSION['ordem_etinerario'])){
    $_POST['iniciar_corrida'] = $_SESSION['ordem_etinerario'][0];
}

if(isset($_SESSION['controlador']) && empty($_SESSION['ordem_etinerario'])){
    unset($_SESSION['controlador']);
}



if(!empty($_POST['iniciar_corrida'])){
    $id_compra = $_POST['iniciar_corrida'];
    $sql455 = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."' AND id_compra = '".$id_compra."'";
    $consulta455 = $conexao->query($sql455);
    $a = $consulta455->fetch(PDO::FETCH_ASSOC);
    if(!empty($a)){
        $valido = 1;
        if($a['hora_saida'] != '0000-00-00 00:00:00'){
        $hora_iniciada = $a['hora_saida'];
        }else{
        $hora_iniciada = date('Y-m-d H:i:s');
        }
        if(!isset($_SESSION['controlador']) || isset($_GET['zera_control'])){
            $_SESSION['controlador'] = 0;
        }
        if( $_SESSION['controlador'] == 0){
        $sql ='UPDATE entregas SET saida=?,hora_saida=? WHERE id_compra = '.$id_compra.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($valido,$hora_iniciada));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
                    if($ok1){
                        $_SESSION['controlador'] = $id_compra;
                         $sqlzb = 'SELECT * FROM compras WHERE id_compra='.$id_compra.'';
                                $consultazb = $conexao->query($sqlzb);
                                $dadozb = $consultazb->fetch(PDO::FETCH_ASSOC);
                                
                        $id_usuarioza = $dadozb['id_usuario'];
                        $tituloza = 'Boa noticia! Sua compra esta em curso para entrega.';
                        $conteudoza = 'Sua Compra acabou de sair da empresa para ser entregue no seu endereço.<br>'
                                . 'Por favor, fique atento e no local de retrada para receber o seu pacote.';
                        $link_1 = '';
                        $link_2 = '';
                        $link_3 = '';
                        $link_4 = '';
                        $link_5 = '';
                        $condicaoza = 1;
                        $data_new = date('Y-m-d H:i:s');
                                
                $sqlza ='INSERT INTO notificacoes (id_usuario,titulo,conteudo,link_1,link_2,link_3,link_4,link_5,condicao,data_envio) values(?,?,?,?,?,?,?,?,?,?)';
		try {
		$insercaoza = $conexao->prepare($sqlza);
		$okza = $insercaoza->execute(array ($id_usuarioza,$tituloza,$conteudoza,$link_1,$link_2,$link_3,$link_4,$link_5,$condicaoza,$data_new));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
                        
                    }else{
                        header('location:iniciar.php?msg=A corrida nao pode ser iniciada por um erro com o banco de dados');
                    }}
    }               
}else{
        header('location:iniciar.php?msg=A corrida nao pode ser iniciada por um erro com o banco de dados');

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
            <div class="card-header">
                <h2 class="text-primary">Entrega Iniciada</h2>  
            </div>
        <div class="card-body">
            <?php
            $sql455z = "SELECT hora_saida FROM entregas WHERE id_entregador = '".$id_entregador."' AND id_compra = '".$id_compra."'";
            $consulta455z = $conexao->query($sql455z);
            $b = $consulta455z->fetch(PDO::FETCH_ASSOC);
            $hora_de_inicio = date_create($b['hora_saida']);
            
            echo '
                   <div class="row">
                   <div class="col">
                   <strong>Código da entrega = </strong>'.$_SESSION['ordem_etinerario'][0].'</br>   <strong>Hora de inicio da entrega = </strong>'.date_format($hora_de_inicio, 'd/m/Y H:i:s').'</br>';
                    
                        if(!empty($_SESSION['ordem_etinerario'][0])){
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
                                        
							
		echo '
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
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Complemento:</strong> '.$d['complemento'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
		  </label>
                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                  <strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
		  </label></br>
                ';                   
                    }
                    
                    
                    echo '<form method="post" action="finalizar_entrega.php">
                  <div class="row">      
                  <div class="col-sm-4">      
                  <label class="form-check-label mt-3" for="Nome_entrega">
                  <strong>Nome de quem recebe:</strong></label>
                  </div>
                  <div class="col">      
                  <input class="form-control mt-3" type="text" name="nome_entrega" id="Nome_entrega"  title="Digite o nome de quem recebera o pacote." required>
                  </div>
                  </div>
                  
                  <div class="row">      
                  <div class="col-sm-4">    
                  <label class="form-check-label mt-3" for="Cpf_entrega">
                  <strong>CPF de quem recebe:</strong></label>
                  </div>
                  <div class="col">
                  <input class="form-control w-50 mt-3" type="text" name="CPF_entrega" id="Cpf_entrega" required>
                  </div>
                  </div>
                  
                  <div class="row">      
                  <div class="col-sm-4">
                  <label class="form-check-label mt-3" for="parent_entrega">
                  <strong>Parentesco:</strong></label>
                  </div>
                  <div class="col">
                  <input class="form-control mt-3" type="text" name="parente_entrega" id="parent_entrega">
                  </div>
                  </div>
                  
                  <div class="row">      
                  <div class="col-sm-4">
                  <label class="form-check-label mt-3" for="obs_entrega">
                  <strong>Observações de entrega:</strong></label>
                  </div>
                  <div class="col">
                  <textarea class="form-control mt-3" rows="4" name="obs_entrega" id="obs_entrega" maxlength="1000"></textarea>
                  </div>
                  </div>
                    
                  <div class="mt-2" align="right">
                  
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal2323">
                        Cancelar Entrega
                      </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Próximas Entregas
                      </button>
                    <input type="hidden" name="concluir_ent" value="'.$id_compra.'">
                    <input type="submit" class="btn btn-success" value="Concluir Entrega">
                    </form>


                     </div>
                      <!-- The Modal -->
                      <div class="modal" id="myModal">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Próximas entregas</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">';
                            
                            //colocarei as proximas entregas aqui...
                            $sql455ty = "SELECT id_endereco,id_compra FROM entregas WHERE id_entregador = '".$id_entregador."' AND ordem_ent >= 2 ORDER BY ordem_ent ASC";
                            $consulta455ty = $conexao->query($sql455ty);
                            $ty = $consulta455ty->fetchALL(PDO::FETCH_ASSOC);
                            if(!empty($ty)){
                            foreach($ty as $t){
                                $sql2 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$t['id_endereco']."'";
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
                                        
							
                                echo '
                                  <label class="form-check-label">
                                  <strong>Código da entrega:</strong> '.$t['id_compra'].' 
                                  </label><br>
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
                                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                  <strong> Complemento:</strong> '.$d['complemento'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                  <strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                  <strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco'.$d['id_endereco'].'">
                                  <strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
                                  </label><hr/>
                                ';                   

                            }}else{
                                echo '<h4>Você esta na sua ultima entrega!</h4>';
                            }
                    
                            echo '</div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            </div>

                          </div>
                        </div>
                      </div>
                  
                      <div class="modal" id="myModal2323">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title">Fique Ligado!!!!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                <h4>Tem certeza que você deseja cancelar essa entrega?</h4>
                               
                                <form method="post">
                                <h5>Motivo do cancelamento:</h5>
                                <textarea class="form-control" name="motivo_can" rows="2" maxlength="1000" placeholder="Limite máximo de 1000 caracteres..." required></textarea>
                                
                                <div align="right" class="mt-2">
                                <input type="hidden" class="btn btn-info" name="cancelar_ent" value="'.$_SESSION['ordem_etinerario'][0].'">
                                <input type="submit" class="btn btn-info" value="Sim">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                                </div>
                                </form>
                                </div>
                               
                            </div>
                        </div>
                      </div>
                 
                

                    ';
                    
                    
                    
                    $localizacao = $d['logradouro'].' '.$d['numero'].' '.$d['bairro'].' '.$d['cidade'].' '.$d['UF'];
                    echo '</div>
                    <div class="col">
                    <h5>Mapa de entrega</h5>
                       <div class="card">
                        <div class="card-body">
                            <div style="height:400px">
                            <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q='.$localizacao.'&output=embed"></iframe>
                            </div>
                        </div>
                       </div>
                   </div>
                    </div>
                        ';
                
            
            
            ?>
        </div>
    </div>
    </div>
<?php
if(isset($_GET['rodando'])){
echo '<div class="modal" id="myModal23">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Fique Ligado!!!!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h5>'.$_GET['rodando'].'</h5>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>';
}
?>
                   
  </body>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	  <script type="text/javascript">
$(window).load(function() {
    $("#myModal23").modal("show");
});
</script>