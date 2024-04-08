<?php
require_once 'cabecalho.php';

if(!empty($_POST)){
$busca_produto = $_POST['busca_produto'];

$sql = "SELECT * FROM produtos WHERE nome LIKE '%".$busca_produto."%'";
$consulta = $conexao->query($sql);
$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

}
?>
<div class="container" style="margin-top: 95px;margin-bottom: 60px">
    <h3 class="alert alert-secondary">Produtos com o nome "<?php echo $busca_produto;?>"</h3>
   <div class="row">
          <?php
          
          foreach($dados as $d){
            if(!empty($d['foto'])){$foto_produto = $d['foto'];}else{$foto_produto ="produto_null.png" ;}

            echo '<div class="col-sm-3">
                  <div class="card m-2 " style="height: 95%;padding-bottom: 40px;">
                  <img class="card-img-top" src="../img/produtos/'.$foto_produto.'" alt="Imagem de capa do card" style="width: 90%; display: block;margin-left: auto;margin-right: auto;">
                  <div class="card-body">
                    <h5 class="card-title">'.$d['nome'].'</h5>
                    <p class="card-text">'.$d['descricao'].'</p>
                    <a href="pagina_produto.php?id_produto='.$d['id_produto'].'" class="btn btn-success" style="position: absolute;bottom:10px;">R$ '. number_format($d['valor'],2,',','.').'</a>
                  </div>
		  </div>
                  </div>';
          
            
            }
            ?>
        
    </div>
</div>
    
    
    
    
<?php
   require_once 'rodape.php';
 ?>
  
