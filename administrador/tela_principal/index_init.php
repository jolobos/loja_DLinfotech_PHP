<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_SESSION['banner'])){
    unset($_SESSION['banner']);
}

if(isset($_SESSION['box'])){
    unset($_SESSION['box']);
}

if(isset($_SESSION['oferta'])){
    unset($_SESSION['oferta']);
}

if(isset($_SESSION['carr'])){
    unset($_SESSION['carr']);
}

$sql1 = "SELECT * FROM tela_principal ";
$consulta1 = $conexao->query($sql1);
$dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);
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
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
                <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Banners</h3>
                    </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                            $contagem_banners = 0;
                            while($contagem_banners < 5){
                                $contagem_banners += 1;
                                if(!empty($dados1['banner_'.$contagem_banners])){
                                echo '<div class="col"><p><strong>Banner '.$contagem_banners.':</strong></p>
                                <img src="../../img/banner/'.$dados1['banner_'.$contagem_banners].'" style="height:100px;width:300px">
                                <p><strong>Titulo: </strong>'.$dados1['titulo_banner_'.$contagem_banners].'</p>
                                <p><strong>Link da pagina: </strong>'.$dados1['link_banner_'.$contagem_banners].'</p>
                                <a class="btn btn-secondary border-warning m-2" href="troca_banner.php?banner='.$contagem_banners.'">Trocar Banner</a>';
                                if($contagem_banners != 1){
                                echo   '<a class="btn btn-secondary border-danger m-2" href="troca_banner.php?excluir_banner='.$contagem_banners.'">Excluir Banner</a></div>
 
                                ';}else {    echo '</div>';}
                                if($contagem_banners == 3){
                                    echo '</div><div class="row">';
                                }
                            }else{
                                echo '<div class="col"><p><strong>Banner '.$contagem_banners.':</strong></p><a class="btn btn-secondary border-danger m-2" href="troca_banner.php?inserir='.$contagem_banners.'">inserir novo banner</a></div>';
                                

                                
                            }
                            }
                            ?>
                            </div>
			</div>
			</div>
      <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Box</h3>
                    </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                            $contagem_box = 0;
                            while($contagem_box < 5){
                                $contagem_box += 1;
                                if(!empty($dados1['ft_box_'.$contagem_box])){
                                echo '<div class="col"><p><strong>Box '.$contagem_box.':</strong></p>
                                <img src="../../img/box/'.$dados1['ft_box_'.$contagem_box].'" style="height:200px;width:200px">
                                <p><strong>Titulo: </strong>'.$dados1['titulo_box_'.$contagem_box].'</p>
                                <p><strong>Descrição: </strong>'.$dados1['descricao_box_'.$contagem_box].'</p>
                                <p><strong>Link do Box: </strong>'.$dados1['categoria_box_'.$contagem_box].'</p>
                                <a class="btn btn-secondary border-warning m-2" href="troca_box.php?box='.$contagem_box.'">Trocar Box</a></div>
 
                           ';
                                if($contagem_box == 3){
                                    echo '</div><div class="row">';
                                }
                            }else{
                                echo '<div class="col"><p><strong>Box '.$contagem_box.':</strong></p><a class="btn btn-secondary border-danger m-2" href="troca_box.php?inserir='.$contagem_box.'">inserir novo banner</a></div>';
                                

                                
                            }
                            }
                            ?>
                            
			</div>
			</div>
			</div>
      
                <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Ofertas da semana</h3>
                    </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                            $contagem_ofertas = 0;
                            while($contagem_ofertas < 5){
                                $contagem_ofertas += 1;
                                if(!empty($dados1['id_oferta_'.$contagem_ofertas])){
                                    $sql1 = "SELECT * FROM produtos WHERE id_produto = '".$dados1['id_oferta_'.$contagem_ofertas]."'";
                                    $consulta1 = $conexao->query($sql1);
                                    $dados_of = $consulta1->fetch(PDO::FETCH_ASSOC);
                                    
                                echo '<div class="col"><p><strong>'.$contagem_ofertas.'° Oferta:</strong></p>
                                <img src="../../img/produtos/'.$dados_of['foto'].'" style="height:200px;width:200px">
                                <p><strong>Produto: </strong>'.$dados_of['nome'].'</p>
                                <p><strong>Código de identificação do produto: </strong>'.$dados_of['id_produto'].'</p>
                                <a class="btn btn-secondary border-warning m-2" href="troca_oferta.php?oferta='.$contagem_ofertas.'">Trocar Oferta</a></div>
 
                           ';
                                if($contagem_ofertas == 3){
                                    echo '</div><div class="row">';
                                }
                            }else{
                                echo '<div class="col"><p><strong>Box '.$contagem_ofertas.':</strong></p><a class="btn btn-secondary border-danger m-2" href="troca_oferta.php?inserir='.$contagem_ofertas.'">inserir novo banner</a></div>';
                                

                                
                            }
                            }
                            ?>
                            
			</div>
			</div>
			</div>
      
                <div class="card mt-2" role="document">
                    <div class="card-header">
                        <h3 class="text-info">Opções de Produtos do carrossel</h3>
                    </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
                            $contagem_car = 0;
                            while($contagem_car < 16){
                                $contagem_car += 1;
                                if(!empty($dados1['id_car_prod_'.$contagem_car])){
                                    $sql1 = "SELECT * FROM produtos WHERE id_produto = '".$dados1['id_car_prod_'.$contagem_car]."'";
                                    $consulta1 = $conexao->query($sql1);
                                    $dados_pr = $consulta1->fetch(PDO::FETCH_ASSOC);
                                    
                                    
                                echo '<div class="col m-1 p-1" ><div class="card m-1 p-2 w-100" style="height: 380px;">
                                <p><strong>'.$contagem_car.'° Produto:</strong></p>
                                <img src="../../img/produtos/'.$dados_pr['foto'].'" style="height:100px;width:100px">
                                <p><strong>Produto: </strong>'.$dados_pr['nome'].'</p>
                                <p><strong>Cod. identificação do produto: </strong>'.$dados_pr['id_produto'].'</p>
                                <a class="btn btn-secondary border-warning" style="position:absolute;bottom:55px;" href="troca_carr.php?carr='.$contagem_car.'">Trocar Produto</a>
                                <a class="btn btn-secondary border-danger " style="position:absolute;bottom:10px;" href="troca_carr.php?excluir_carr='.$contagem_car.'">Excluir produto</a></div></div>
 
                           ';
                                if(($contagem_car % 4) == 0){
                                    echo '</div><div class="row">';
                                }
                            }else{
                                echo '<div class="col"><p><strong>'.$contagem_car.'° Produto:</strong></p><a class="btn btn-secondary border-danger m-2" href="troca_carr.php?inserir='.$contagem_car.'">inserir novo Produto</a></div>';
                                

                                
                            }
                            }
                            ?>
                            
			</div>
			</div>
			</div>
      
      
			</div>
      
 </body></html>

