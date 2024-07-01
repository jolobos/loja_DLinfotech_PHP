<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$valor."%'LIMIT 0,15";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($valor)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;width:940px">';
  echo '<thead style="display: block;position: relative;" class="border">';
  echo '<tr>';
  
  echo '<th width=120>codigo do produto</th><th width=350>Produto</th><th width=80>Valor</th><th width=110>quantidade</th><th width=120>status</th><th width=152>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 300px;overflow-y: scroll;overflow-x: hidden;">';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td width=120>'.$d['cod_produto'].'</td><td width=350>'.$d['nome'].'</td><td width=90>$ '. number_format($d['valor'],2,',','.').'</td><td width=100>'.$d['quantidade'].'</td>
	  <td width=110>'.$status.'</td><td width=150><a class="btn btn-dark border-success me-2" href = "?id_produto='.$d['id_produto'].'">add</a>
              <a class="btn btn-dark border-success me-2" href = "../produtos/ver.php?id_produto='.$d['id_produto'].'" target=_blank>ver</a></td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto mt-5"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3></div>';

  
  }
  
?>