<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%'LIMIT 0,7";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>foto</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td><img style="width:50px;height:50px " src="../../img/produtos/'.$d['foto'].'"></td>
	  <td>'.$status.'</td><td><button class="btn btn-dark border-success">Copiar</button></td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3></div>';

  
  }
  
?>


