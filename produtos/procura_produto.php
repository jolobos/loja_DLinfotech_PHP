<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");

if(isset($_GET['nome_busc'])){
    $_POST['busca_produto'] = $_GET['nome_busc'];
}
if(!empty($_POST['busca_produto'])){
$busca_produto_nome = $_POST['busca_produto'];
$quantidade_us = 20; 
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio     = ($quantidade_us * $pagina) - $quantidade_us;
$sql = "SELECT * FROM produtos WHERE nome LIKE '%".$busca_produto_nome."%' LIMIT $inicio,$quantidade_us";
$consulta = $conexao->query($sql);
$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

}
if(!empty($_GET['categoria'])){
$busca_produto_cat = $_GET['categoria'];
$quantidade_us = 20; 
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio     = ($quantidade_us * $pagina) - $quantidade_us;
$sql = "SELECT * FROM produtos WHERE categoria LIKE '%".$busca_produto_cat."%' LIMIT $inicio,$quantidade_us";
$consulta = $conexao->query($sql);
$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

}
require_once 'cabecalho.php';

?>
<div class="container" style="margin-top: 100px;margin-bottom: 60px">
     <?php
       if(!isset($busca_produto_nome) && !isset($busca_produto_cat)){
           echo '<h3 class="alert alert-secondary">Sem nome de produto digitado.</h3>
           <div class="row">';
        }else if(isset($busca_produto_nome)){
            echo '<h3 class="alert alert-secondary">Produtos com o nome "'.$busca_produto_nome.'"</h3>
        <div class="row">';
        }else if(isset($busca_produto_cat)){
            echo '<h3 class="alert alert-secondary">Produtos com o nome "'.$busca_produto_cat.'"</h3>
        <div class="row">';
        }
   
         
            if(!isset($busca_produto_nome) && !isset($busca_produto_cat)){
                echo '<div class="col-sm-8 alert alert-dark text-center"" style="margin:auto"><h2>Valor inválido para pesquisa.</h2>
			  <h5>Por favor, entre com um nome valido na pesquisa.</h5></div>';
            }else if(isset($busca_produto_nome)){
          
            if(strlen($busca_produto_nome) < 2){
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
            }else if(isset($busca_produto_cat)){
          
            if(strlen($busca_produto_cat) < 2){
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
            }
            //separação de nome e categoria....1° nome:
            
            if(isset($busca_produto_nome) && strlen($busca_produto_nome) > 1 && !empty($dados)){
            //continuando paginação
            $sqlTotal ="SELECT COUNT(id_produto) as id from produtos WHERE nome LIKE '%".$busca_produto_nome."%'";
            //Executa o SQL
            $consulta_c = $conexao->query($sqlTotal);
            $qrTotal = $consulta_c->fetch(PDO::FETCH_ASSOC);
            
            //O calculo do Total de página ser exibido
            $totalPagina= ceil($qrTotal['id']/$quantidade_us);
            /**
            * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
            */
            $exibir = 3;
            /**
            * Aqui montará o link que voltará uma pagina
            * Caso o valor seja zero, por padrão ficará o valor 1
            */
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
            /**
            * Aqui montará o link que ir para proxima pagina
            * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
            * caso contrario, ele pegar o valor da página + 1
            */
            $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
            /**
            * Agora monta o Link paar Primeira Página
            * Depois O link para voltar uma página
            */
            /**
            * Agora monta o Link para Próxima Página
            * Depois O link para Última Página
            */
            echo '<div id="navegacao" align="center">';
            echo '<a  class="btn btn-primary mb-2" href="?pagina=1&nome_busc='.$busca_produto_nome.'">primeira</a> | ';
            echo "<a  class='btn btn-primary mb-2' href=\"?pagina=$anterior&nome_busc=$busca_produto_nome\">anterior</a> | ";
            /**
            * O loop para exibir os valores à esquerda
            */
            for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
            if($i > 0)
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'&nome_busc='.$busca_produto_nome.'"> '.$i.'</a>';
            }
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$pagina.'&nome_busc='.$busca_produto_nome.'"><strong>'.$pagina.'</strong></a>';
            for($i = $pagina+1; $i < $pagina+$exibir; $i++){
            if($i <= $totalPagina)
            echo '<a class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'&nome_busc='.$busca_produto_nome.'"> '.$i.' </a>';
            }
            /**
            * Depois o link da página atual
            */
            /**
            * O loop para exibir os valores à direita
            */
            echo " | <a class='btn btn-primary mb-2' href=\"?pagina=$posterior&nome_busc=$busca_produto_nome\">próxima</a> | ";
            echo "  <a class='btn btn-primary mb-2' href=\"?pagina=$totalPagina&nome_busc=$busca_produto_nome\">última</a>";
            }
            
            //continuando paginação
            if(isset($busca_produto_cat) && strlen($busca_produto_cat) > 1 && !empty($dados)){
            $sqlTotal ="SELECT COUNT(id_produto) as id FROM produtos WHERE categoria LIKE '%".$busca_produto_cat."%'";
            //Executa o SQL
            $consulta_c = $conexao->query($sqlTotal);
            $qrTotal = $consulta_c->fetch(PDO::FETCH_ASSOC);
            
            //O calculo do Total de página ser exibido
            $totalPagina= ceil($qrTotal['id']/$quantidade_us);
            /**
            * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
            */
            $exibir = 3;
            /**
            * Aqui montará o link que voltará uma pagina
            * Caso o valor seja zero, por padrão ficará o valor 1
            */
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
            /**
            * Aqui montará o link que ir para proxima pagina
            * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
            * caso contrario, ele pegar o valor da página + 1
            */
            $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
            /**
            * Agora monta o Link paar Primeira Página
            * Depois O link para voltar uma página
            */
            /**
            * Agora monta o Link para Próxima Página
            * Depois O link para Última Página
            */
            echo '<div id="navegacao" align="center">';
            echo '<a  class="btn btn-primary mb-2" href="?pagina=1&categoria='.$busca_produto_cat.'">primeira</a> | ';
            echo "<a  class='btn btn-primary mb-2' href=\"?pagina=$anterior&categoria=$busca_produto_cat\">anterior</a> | ";
            /**
            * O loop para exibir os valores à esquerda
            */
            for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
            if($i > 0)
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'&categoria='.$busca_produto_cat.'"> '.$i.'</a>';
            }
            echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$pagina.'&categoria='.$busca_produto_cat.'"><strong>'.$pagina.'</strong></a>';
            for($i = $pagina+1; $i < $pagina+$exibir; $i++){
            if($i <= $totalPagina)
            echo '<a class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'&categoria='.$busca_produto_cat.'"> '.$i.' </a>';
            }
            /**
            * Depois o link da página atual
            */
            /**
            * O loop para exibir os valores à direita
            */
            echo " | <a class='btn btn-primary mb-2' href=\"?pagina=$posterior&categoria=$busca_produto_cat\">próxima</a> | ";
            echo "  <a class='btn btn-primary mb-2' href=\"?pagina=$totalPagina&categoria=$busca_produto_cat\">última</a>";
            }
            
            ?>
            
    </div>
</div>
    
    
    
    
<?php
   require_once 'rodape.php';
 ?>
  
