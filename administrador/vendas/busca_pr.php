<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%'LIMIT 0,15";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
  echo '<thead style="display: block;position: relative;" class="border">';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>'.$d['cod_produto'].'</td><td>'.$d['nome'].'</td><td>$ '. number_format($d['valor'],2,',','.').'</td><td>'.$d['quantidade'].'</td>
	  <td>'.$status.'</td><td><form method="post">
	  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
	  <input type="submit" class="btn btn-dark border-success me-2"  value="Adicionar" />
	  
	  <a class="btn btn-dark border-success me-2 mt-1" href = "?ver_produto='.$d['id_produto'].'">  Verificar </a></form>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }
  
?>