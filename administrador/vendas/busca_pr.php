<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%' AND status = 1 LIMIT 0,15";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" border="3" style="table-layout: fixed;width:100%" >';
  echo '<thead style="display: block;position: relative;" class="border">';
  echo '<tr>';
  
  echo '<th width="160">codigo do produto</th><th width="250">Produto</th><th width="87">Valor</th><th width="100">quantidade</th><th width="230">Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
  
  foreach($dados as $d){
	  
	  echo '<tr><td width="160">'.$d['cod_produto'].'</td><td width="250">'.$d['nome'].'</td><td width="87">$ '. number_format($d['valor'],2,',','.').'</td><td width="100">'.$d['quantidade'].'</td>
	 <td><form method="post">
	  <input type="hidden" name="id_produto" value="'.$d['id_produto'].'" />
	  <input type="submit" class="btn btn-dark border-success me-2  mt-1"  value="Adicionar" />
	  
	  <a class="btn btn-dark border-success me-2 mt-1" href = "?ver_produto='.$d['id_produto'].'">  Verificar </a></form>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }
  
?>