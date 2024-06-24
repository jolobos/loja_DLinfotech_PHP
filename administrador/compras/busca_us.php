<?php

require_once("../../database.php");

 

$valor = $_GET['valor'];
 

if($valor != ''){
  $sql = "SELECT * FROM usuarios WHERE nome LIKE '%".$valor."%'LIMIT 0,10";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
  if(!empty($dados)){
    
  
  echo '<table  border="3" class="table table-striped border-secondary" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th width=200>Nome</th><th width=100>CPF</th><th width=100>Telefone</th><th width=200>E-mail</th><th width=100>status</th><th width=80>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td width=220>'.$d['nome'].'</td><td width=100>'.$d['CPF'].'</td><td width=100>'. $d['telefone'].'</td><td width=200>'.$d['email'].'</td>
	  <td width=100>'.$status.'</td><td width=80><a class="btn btn-dark border-success me-2" href = "compras_usuario.php?id_usuario='.$d['id_usuario'].'">Selecionar</a>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuário encontrado...</h3></div>';

  
  }
}else{
	echo '<div><h3 class="alert alert-secondary mt-2">Por favor, entre com o campo de busca do usuário...</h3</div>';

}
?>