<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");


if(!empty($_POST)){
$busca_produto = $_POST['busca_produto'];

$sql = "SELECT * FROM produtos WHERE nome LIKE '%".$busca_produto."%'";
$consulta = $conexao->query($sql);
$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

}
require_once 'cabecalho.php';

?>
<div class="container" style="margin-top: 95px;margin-bottom: 60px">
    <h3 class="alert alert-secondary">Produtos com o nome "<?php echo $busca_produto;?>"</h3>
   <div class="row">
          <?php
          if(strlen($_POST['busca_produto']) < 2){
			  echo '<div class="col-sm-8 alert alert-dark text-center"" style="margin:auto"><h2>Valor inválido para pesquisa.</h2>
			  <h5>Por favor, entre com um nome valido na pesquisa.</h5></div>';
		  }else{
			  if(empty($dados)){
				  echo '<h2>Nenhum produto encontrado...</h2>';
				  
			  }else{
          foreach($dados as $d){
            if(!empty($d['foto'])){$foto_produto = $d['foto'];}else{$foto_produto ="produto_null.png" ;}

            echo '<div class="col-sm-3">
                  <div class="card m-2 " style="height: 95%;padding-bottom: 40px;">
                  <img class="card-img-top" src="../img/produtos/'.$foto_produto.'" style="width: 90%; height: 90%; margin: auto">
                  <div class="card-body">
                    <h5 class="card-title">'.$d['nome'].'</h5>
                    <p class="card-text">'.$d['descricao'].'</p>
                    <a href="pagina_produto.php?id_produto='.$d['id_produto'].'" class="btn btn-success" style="position: absolute;bottom:10px;">R$ '. number_format($d['valor'],2,',','.').'</a>
                  </div>
		  </div>
                  </div>';
          
            
		  }}}
            ?>
        
    </div>
</div>
    
    
    
    
<?php
   require_once 'rodape.php';
 ?>
  
