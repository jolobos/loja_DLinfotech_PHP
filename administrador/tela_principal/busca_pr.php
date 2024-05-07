<?php

require_once("../../database.php");



$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%' ORDER BY nome ASC LIMIT 0,15 ";
  $consulta = $conexao->query($sql);
    $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary mt-3" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td width=170>'.$d['cod_produto'].'</td><td width=420>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
	  <td>'.$status.'</td><td><a class="btn btn-dark border-success me-2" href = "?id_produto='.$d['id_produto'].'">Selecionar</a></td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto mt-3"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado...</h3</div>';

  
  }

?>