<?php
require_once 'cabecalho.php';
?>
<<script type="text/javascript" src="buscaprod.js"></script>
<div class="container mt-5">
				<h1 class="text-info">
					Lista de Produtos
				</h1>
			

<div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> </br></br>

<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>      <h4>Buscar: <input type="text" id="busca"  onKeyUp="buscarprodutos(this.value)" />
</h4></br>
  <div id="resultado">      



<?php
if(!empty($_GET['mensagem'])){
	echo $_GET['mensagem'];
}
?>


<?php

 if (!empty($erro)){
	 echo '<p> houve um problema no acesso ao banco de dados contate o administrador e diga que ocorreu o erro <b>'.$erro.'</b></p>';
 }
  
  $sql = 'SELECT * FROM produtos LIMIT 0,15';
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
  echo '<div class="form-group"><a class="btn btn-warning" href="insere.php">inserir</a></div></br>';
  
  
  echo '<table  border="3" class="table table-striped" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>Descriçao</th><th>status</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
          if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td>'.$d['cod_prod'].'</td><td>'.$d['produto'].'</td><td>$ '.$d['valor'].'</td><td>'.$d['quantidade'].'</td><td>'.$d['descricao'].
          '</td><td>'.$status.'</td><td><a class="btn btn-success me-2" href = "ver.php?id_produto='.$d['id_produto'].'">ver</a><a class="btn btn-primary me-2" href = "alterar.php?id_produto='.$d['id_produto'].'"> alterar</a><a class="btn btn-danger" href = "deletar.php?id_produto='.$d['id_produto'].'"> deletar</a></td></tr>';
  }
  
  echo '</tbody>';
   echo '</table>';
  
  
  ?>
  
  </div>
  <hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
				
		</div>
	
	
	</div>
</body>
</html>
