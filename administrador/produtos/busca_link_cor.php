<?php
//document.getElementById("clip_btn").innerHTML='<i class="fas fa-clipboard-check"></i> - Copiado';

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
  $cont = 0;
  foreach($dados as $d){
          

	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>
          <textarea class="form-control ms-3" id="cod_produto_'.$cont.'" onclick="copiar_'.$cont.'()">'.$d['cod_produto'].'</textarea>
          </td><td>'.$d['nome'].'</td><td><img style="width:50px;height:50px " src="../../img/produtos/'.$d['foto'].'"></td>
	  <td>'.$status.'</td><td>
          <p><button type="button" id="clip_btn" class="btn btn-primary ms-3"  data-toggle="tooltip" data-placement="top" title="Copiar código pix" onclick="copiar_'.$cont.'()"><i class="fas fa-clipboard"> - Copiar</i></button></p></td></tr>';
 
          $cont++;
          }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3></div>';

  
  }
  
?>


