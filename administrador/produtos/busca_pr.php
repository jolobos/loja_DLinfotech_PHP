<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%'LIMIT 0,15";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
	  <td>'.$status.'</td><td><a class="btn btn-dark border-success me-2" href = "ver.php?id_produto='.$d['id_produto'].'">ver</a>
	  <a class="btn btn-dark border-success me-2" href = "alterar.php?id_produto='.$d['id_produto'].'"> alterar</a>
	  <a class="btn btn-dark border-success" href = "deletar.php?id_produto='.$d['id_produto'].'"> deletar</a></td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3></div>';

  
  }
  
?>