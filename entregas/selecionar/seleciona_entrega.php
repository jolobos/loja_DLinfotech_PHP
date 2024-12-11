<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_POST['sel_entrega'])){
    $id_compra = $_POST['sel_entrega'];
    $sql_YU = "SELECT * FROM compras WHERE id_compra = '".$id_compra."'";
    $consulta_YU = $conexao->query($sql_YU);
    $dados_YU = $consulta_YU->fetch(PDO::FETCH_ASSOC);
    $id_usuario = $dados_YU['id_usuario'];
    $id_endereco = $dados_YU['id_endereco'];
    $saida = 0;
    $chegada = 0;
    $devolucao = 0;
    $cancelamento = 0;
    $observações = 'vazio';
    $status = 0;
    
    $sql ='INSERT INTO entregas (id_entregador,id_compra,id_usuario,id_endereco,saida,chegada,devolucao,cancelamento,observacoes,status) values(?,?,?,?,?,?,?,?,?,?)';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($id_entregador,$id_compra,$id_usuario,$id_endereco,$saida,$chegada,$devolucao,$cancelamento,$observações,$status));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
		if($ok){
                    $valor = 1;
                    $sql ='UPDATE compras SET sel_entrega=? WHERE id_compra = '.$id_compra.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok1 = $insercao->execute(array ($valor));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok1 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok1= False; 
                    }
    
                }
			if ($ok1){
				$msg= 'Seus dados foram alterados com sucesso!.';
				}else{
					$msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
			}
		header('location:seleciona_entrega.php?mensagem='.$msg);
} 
if(!empty($_POST['rec_entrega'])){
    $id_compra = $_POST['rec_entrega'];
    
    $sql1 ='DELETE FROM entregas WHERE id_compra = ?';
		try {
			$insercao1 = $conexao->prepare($sql1);
		$ok1 = $insercao1->execute(array ($id_compra));
		}catch(PDOException $r){
	//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok1 = False;
		}catch (Exception $r){//todos as exceções
		$ok1= False; 
		}
		if($ok1){
                    $valor = 0;
                    $sql ='UPDATE compras SET sel_entrega=? WHERE id_compra = '.$id_compra.'';
                try {
               $insercao = $conexao->prepare($sql);
                $ok2 = $insercao->execute(array ($valor));
                }catch(PDOException $r){
                //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                        $ok2 = False;
                    }catch (Exception $r){//todos as exceções
                        $ok2= False; 
                    }
    
                }
			if ($ok2){
				$msg= 'Seus dados foram alterados com sucesso!.';
				}else{
					$msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
			}
		header('location:seleciona_entrega.php?mensagem='.$msg);
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
                    <h1 class="text-success">
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
                <h2 class="text-primary">Selecione as entregas que voce deseja entregar</h2>  
            </div>
            <div class="card-body">
                
                
                    <?php
                    $sql = "SELECT * FROM compras WHERE autorizado = 1 AND sel_entrega = 0";
                    $consulta = $conexao->query($sql);
                    $dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);
                    echo '<div class="row">
                            <div class="col">
                                <h5>Entregas:</h5>
                                <div style="max-height:400px" class="overflow-auto">
                                    ';
                    foreach ($dados_a as $a){
                        $sql45 = "SELECT * FROM entregas WHERE id_compra = '".$a['id_compra']."'";
			$consulta45 = $conexao->query($sql45);
			$d45 = $consulta45->fetch(PDO::FETCH_ASSOC);
                        
                        if(empty($d45['id_compra'])){
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
                                        
							
		echo '<form method="POST">
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
		  </label></br>
                  <input type="hidden" name="sel_entrega" value="'.$a['id_compra'].'">
                  <div align="right">    
                  <input class="btn btn-primary me-4" type="submit" id="endereco'.$d['id_endereco'].'"  value="Selecionar">
                  </div>
                  </form><hr/>
                ';                   
                    }}
                    echo '
                            </div>
                            </div>
                            <div class="col">
                            <h5>Selecionadas:</h5>
                            ';
                    
                    echo '<div class="card">
                            <div class="card-header">
                               
                            </div>
                            <div class="card-body"><div style="max-height:400px" class="overflow-auto">';
                            $sql93 = "SELECT * FROM entregas WHERE id_entregador = '".$id_entregador."'";
                            $consulta93 = $conexao->query($sql93);
                            $d93 = $consulta93->fetchALL(PDO::FETCH_ASSOC);

                            foreach ($d93 as $s){
                                $sql2 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$s['id_endereco']."'";
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
                                        
							
                                echo '<form method="POST">
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong>CEP:</strong> '.$d['CEP'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Rua:</strong> '.$d['logradouro'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Bairro:</strong> '.$d['bairro'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Cidade:</strong> '.$d['cidade'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> UF:</strong> '.$d['UF'].' 
                                  </label></br>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> n°:</strong> '.$d['numero'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Complemento:</strong> '.$d['complemento'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
                                  </label></br>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
                                  </label>
                                  <label class="form-check-label" for="endereco_2'.$d['id_endereco'].'">
                                  <strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
                                  </label></br>
                                  <input type="hidden" name="rec_entrega" value="'.$s['id_compra'].'">
                                  <div align="right">    
                                  <input class="btn btn-primary me-4" type="submit" id="endereco_2'.$d['id_endereco'].'"  value="Selecionar">
                                  </div></form>
                                  <hr/>
                                ';                   
                                    }    

                    echo '</div></div>
                            <div class="card-footer">
                            </div>';
                    
                    echo '</div>';
                    
                    ?>
                </div>
            </div>
        </div>


    </div>
  </body>