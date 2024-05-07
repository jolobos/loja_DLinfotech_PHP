<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
$sql1 = "SELECT * FROM tela_principal ";
$consulta1 = $conexao->query($sql1);
$dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['banner']) || isset($_POST['titulo_banner'])){
if(!empty($_GET['banner'])){
    $_SESSION['banner'] = $_GET['banner'];
    $banner = $_SESSION['banner'];
}else{
   $banner = $_SESSION['banner']; 
}



if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    if($extensao == '.png' || $extensao == '.jpg' || $extensao == '.svg' || $extensao == '.gif'){
    $novo_nome = md5(microtime()) . $extensao; //define o nome do arquivo
    $diretorio = "../../img/banner/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); //efetua o upload
    $banner_novo = $novo_nome;
}}

if(!empty($_POST['titulo_banner'])){
    $banner = $_POST['banner'];
    $link_novo = $_POST['link_banner'];
    $titulo_novo = $_POST['titulo_banner'];
    $sql ='UPDATE tela_principal SET banner_'.$banner.'=?,titulo_banner_'.$banner.'=?,link_banner_'.$banner.'=? WHERE id_tela = 1' ;
    try {
    $insercao = $conexao->prepare($sql);
    $ok = $insercao->execute(array($banner_novo,$titulo_novo,$link_novo));
    }catch(PDOException $r){
            $msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok = False;
    }catch (Exception $r){//todos as exceções
    $ok= False; 

    }
            if ($ok){
                    $msg= 'Banner alterado com sucesso!.';
                    }else{
                            $msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
            }
    header('location:index_init.php?mensagem='.$msg);



}}

if(isset($_GET['excluir_banner']) || isset($_POST['excluir_banner'])){
if(!empty($_GET['excluir_banner'])){
    $_SESSION['banner'] = $_GET['excluir_banner'];
    $banner = $_SESSION['banner'];
}else{
   $banner = $_SESSION['banner']; 
}
    
if(!empty($_POST['excluir_banner'])){
    $banner_novo = '';
    $link_novo = '';
    $titulo_novo = '';
    $sql ='UPDATE tela_principal SET banner_'.$banner.'=?,titulo_banner_'.$banner.'=?,link_banner_'.$banner.'=? WHERE id_tela = 1' ;
    try {
    $insercao = $conexao->prepare($sql);
    $ok = $insercao->execute(array($banner_novo,$titulo_novo,$link_novo));
    }catch(PDOException $r){
            $msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok = False;
    }catch (Exception $r){//todos as exceções
    $ok= False; 

    }
            if ($ok){
                    $msg= 'Banner excluido com sucesso!.';
                    }else{
                            $msg='Lamento, não foi possivel alterar seus dados!.'.$r->getMessage().'';
            }
    header('location:index_init.php?mensagem='.$msg);

 
}    
}

if(isset($_GET['inserir'])){
    $_SESSION['banner'] = $_GET['inserir'];
    $banner = $_SESSION['banner'];
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
                Opções para tela inicial
        </h1>
        <a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
        <a href="index_init.php" class="btn btn-secondary border-danger m-2">Voltar</a>
        <a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
        </div>

 <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Banners</h3>
                    </div>
     <div class="card-body">
         
         <?php
        if(isset($_GET['banner']) || isset($_POST['titulo_banner'])){
        echo '<h4>Banner atual</h4><div align="center"> <img src="../../img/banner/'.$dados1['banner_'.$banner].'" style="height: 450px"></div>';
        echo '<h4>Trocar banner '.$banner.'</h4>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                     <label class="form-label" for="defaultCheck13">
                        Foto do banner:
                     </label>
                    <input class="form-control" type="file" name="arquivo" required>
		</div>
            <div class="mb-3 mt-3">
            <label class="form-label">Titulo do banner:</label>
            <input class="form-control" placeholder="Digite o titulo do banner..." name="titulo_banner" required>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Link do banner:</label>
            <input class="form-control" placeholder="Digite o link do banner, senao haver link digite ´#´" name="link_banner" required>
            </div>
            <div align="center">
                <input type="hidden" value="'.$banner.'" name="banner"> 
                <input type="submit" class="btn btn-primary" value="Salvar mudanças"> 
            </div>
            
         </form>';}
         
         if(isset($_GET['excluir_banner']) || isset($_POST['excluir_banner'])){
            echo '<h4>Banner atual</h4><div align="center"> <img src="../../img/banner/'.$dados1['banner_'.$banner].'" style="height: 450px"></div>';
            echo '<h4>Excluir banner '.$banner.'</h4>
        <form action="" method="POST">
            <div>
                     <label class="form-label" for="defaultCheck13">
                        Foto do banner: img/banner/'.$dados1['banner_'.$banner].'
                     </label>
		</div>
            <div class="mb-3 mt-3">
            <label class="form-label">Titulo do banner: '.$dados1['titulo_banner_'.$banner].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Link do banner: '.$dados1['link_banner_'.$banner].'</label>
            </div>
            <div align="center">
                <h5 class="alert alert-danger">Se você tem certeza que deseja excluir o banner atual da posição '.$banner.', click no botão abaixo:</h5>
                <input type="hidden" value="'.$banner.'" name="excluir_banner"> 
                <input type="submit" class="btn btn-danger" value="Excluir Banner"> 
            </div>
            
         </form>';}
         
         if(isset($_GET['inserir'])){
              echo '<h4>Trocar banner '.$banner.'</h4>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                     <label class="form-label" for="defaultCheck13">
                        Foto do banner:
                     </label>
                    <input class="form-control" type="file" name="arquivo" required>
		</div>
            <div class="mb-3 mt-3">
            <label class="form-label">Titulo do banner:</label>
            <input class="form-control" placeholder="Digite o titulo do banner..." name="titulo_banner" required>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Link do banner:</label>
            <input class="form-control" placeholder="Digite o link do banner, senao haver link digite ´#´" name="link_banner" required>
            </div>
            <div align="center">
                <input type="hidden" value="'.$banner.'" name="banner"> 
                <input type="submit" class="btn btn-primary" value="Salvar mudanças"> 
            </div>
            
         </form>';
             
         }
         
?>

         
     </div>  
  
  </div>
      