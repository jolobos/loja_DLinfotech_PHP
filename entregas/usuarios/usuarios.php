<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['id_entregador'])){
$id_usuario = $_POST['id_entregador'];
$nome = $_POST['nome'];
$CPF = $_POST['CPF'];
$telefone_1 = $_POST['telefone_1'];
$telefone_2 = $_POST['telefone_2'];
$endereco = $_POST['endereco'];
$sql ='UPDATE entregador_us SET nome=?,CPF=?,telefone_1=?,telefone_2=?,endereco_ent=? WHERE id_entregador=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($nome,$CPF,$telefone_1,$telefone_2,$endereco,$id_usuario));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Seus dados foram alterados com sucesso!.';
				}else{
					$msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
			}
    header('location:usuarios.php?mensagem='.$msg);
}

if(isset($_FILES['arquivo'])){
    $arq = '../../img/foto_usuario/'.$foto;
    unlink($arq);
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
    $diretorio = "../../img/foto_usuario/"; //define o diretorio para onde enviaremos o arquivo

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); //efetua o upload

	$sql ='UPDATE entregador_us SET foto_ent=? WHERE id_entregador=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($novo_nome,$id_entregador));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Foto alterada com sucesso!';
				$_SESSION['foto'] = $novo_nome;
				}else{
					$msg='Lamento, não foi possivel alterar sua foto!'.$r->getMessage().'';
			}
		header('location:usuarios.php?mensagem='.$msg.'&foto=ok');

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
                <h2 class="text-primary">Configurações do entregador</h2>  
            </div>
        <div class="card-body">
            <?php if(isset($_GET['foto']) || isset($_GET['mensagem'])) {
                echo '<div class="modal" id="myModal23">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title">Fique Ligado!!!!</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>'.$_GET['mensagem'].'</h5>                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                </div>

                            </div>
                        </div>
                      </div>';
                echo '<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

                            <script type="text/javascript">
                  $(window).load(function() {
                      $("#myModal23").modal("show");
                  });
                  </script>';
            }?>
 <div class="row">
 <div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data" >
                <div class="container">
                    <h1>Upload de imagem</h1>
                   <?php 
                   if(!empty($foto)){$foto_usuario = $foto;}else{$foto_usuario ="user_null.png" ;}
                   echo '<img src="../../img/foto_usuario/'.$foto_usuario.'" width="150px" height="150px"/>'; 


                   ?>
                                <input class="form-control mt-2" type="file" required name="arquivo">
                                <input class="btn btn-secondary mt-3" type="submit" value="Salvar Foto">
                        </div>
            </form>
            <?php
            $sql= 'SELECT * FROM entregador_us WHERE id_entregador= ?';
            $consulta = $conexao->prepare($sql);
            $consulta->execute(array($id_entregador));
            $dado = $consulta->fetch(PDO::FETCH_ASSOC);
            
            echo '<form method="post">
           </div>
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">Nome:</label>
            <input class="form-control " placeholder="Digite o seu nome" name="nome" value="'.$dado['nome'].'">
            </div>
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">CPF/CNPJ:</label>
            <input class="form-control" placeholder="Digite o seu CPF/CNPJ" name="CPF" value="'.$dado['CPF'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Telefone Principal:</label>
            <input class="form-control" placeholder="Digite o seu telefone" name="telefone_1" value="'.$dado['telefone_1'].'">
            </div>
            <div class="mb-3 mt-3">
            <div class="mb-3 mt-3">
            <label class="form-label">Telefone Secundario:</label>
            <input class="form-control" placeholder="Digite o seu telefone" name="telefone_2" value="'.$dado['telefone_2'].'">
            </div>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Endereço:</label>
            <input class="form-control" placeholder="Digite o seu telefone" name="endereco" value="'.$dado['endereco_ent'].'">
            </div>
            </div>
            </div>
            <div class="mb-3 mt-3" align="center">
            <input type="hidden" name="id_entregador" value="'.$dado['id_entregador'].'"/>
            <button type="submit" class="btn btn-primary ">Salvar as alterações</button>
            </div>
        </form>';
            ?>
            
        </div>
    </div>
   </div>
</body>