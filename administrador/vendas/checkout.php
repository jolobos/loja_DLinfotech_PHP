<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_SESSION['id_usuario'])){
	unset($_SESSION['id_usuario']);
}

if(!empty($_POST['email']) && !empty($_POST['senha'])){
	$verificacao = false;
	if(!empty($_POST['nome'])){ $verificacao = true; }else{	$verificacao = false;}
	if(!empty($_POST['email'])){ $verificacao = true; }else{	$verificacao = false;}
	if(is_numeric($_POST['telefone']) && !empty($_POST['telefone'])){ $verificacao = true; }else{	$verificacao = false;}
	if(is_numeric($_POST['CPF']) && !empty($_POST['CPF'])){ $verificacao = true; }else{	$verificacao = false;}
	if(!empty($_POST['senha'])){ $verificacao = true; }else{	$verificacao = false;}
	if(!empty($_POST['conf_senha'])){ $verificacao = true; }else{	$verificacao = false;}
	
	if($verificacao){
		$nome_v = $_POST['nome'];
		$email_v = $_POST['email'];
		$CPF_v = $_POST['CPF'];
		$sql= 'SELECT nome,email,CPF FROM usuarios WHERE nome= ? or email= ? or CPF = ?';
		$consulta = $conexao->prepare($sql);
		$consulta->execute(array($nome_v,$email_v,$CPF_v));
		$dado = $consulta->fetch(PDO::FETCH_ASSOC);

		$nome_ve = $dado['nome'];
		$email_ve = $dado['email'];
		if(!empty($nome_ve || $email_ve)){
			$msg = 'o Nome, E-mail ou CPF do usuário já existe em nosso banco de dados';
			header('location:?mensagem='.$msg);
		}else{
			
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['telefone'];
		$senha1 = md5($_POST['senha']);
		$senha2 = md5($_POST['conf_senha']);
		$data = date("Y-m-d H:i:s");
		$status = 1;
		if($senha1 == $senha2){
				$sql ='INSERT INTO usuarios(nome,email,celular,telefone,senha,data_entrada,status) values(?,?,?,?,?,?,?)';
				try {
				$insercao = $conexao->prepare($sql);
				$ok = $insercao->execute(array ($nome,$email,$celular,$telefone,$senha1,$data,$status));
				}catch(PDOException $r){
					//$msg= 'Problemas com o SGBD.'.$r->getMessage();
					$ok = False;
				}catch (Exception $r){//todos as exceções
				$ok= False; 
					
				}
					if ($ok){
						$msg= 'Usuário cadastrado com sucesso.';
						}else{
							$msg='Lamento, não foi possivel cadastrar o usuario.'.$r->getMessage().'';
					}
					header('location:?mensagem='.$msg);
						}else{
						 $msg = 'Por favor, digite as senhas corretamente para o cadastro!!!';  
						 header('location:?mensagem='.$msg);
		   
						}
			}
			
}
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos do sistema - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
<body style="background: #778899">
  <div class="container">
	<div class="card mt-2">
        <div class="card-header">
			<div class="row">
			<div class="col">
            <h3 class="text-info">Bem Vindo ao checkout de vendas</h3>
			</div>
			<div class="col" align="right">
				<a href="?adicionar_cliente=ok" class="btn btn-secondary border-info">Adicionar Usuário</a>
			</div>
			</div>
			</div>
        <div class="card-body">
		<h3>Escolha um dos seguintes usuários para efetuar a venda</h3>
		<?php
			$quantidade_us = 20; 
			$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
			$inicio     = ($quantidade_us * $pagina) - $quantidade_us;
				$sql_a = "SELECT * FROM usuarios WHERE status = 1 LIMIT $inicio,$quantidade_us ";
				$consulta_a = $conexao->query($sql_a);
				$dados = $consulta_a->fetchALL(PDO::FETCH_ASSOC);
				
				
				echo '<div class="card m-3">
					  <div class="card-header">
						  <h4>Lista</h4>
					  </div>
					  <div class="card-body">';
					  if(!empty($dados)){


					  echo '<table  border="3" class="border-secondary" style="table-layout: fixed;width:1113px">';
					  echo '<thead style="display: block;position: relative;" class="border">';
					  echo '<tr>';

					  echo '<th width=275>Nome</th><th width=130>CPF</th><th width=142>Telefone</th><th width=285>E-mail</th><th width=125>status</th><th>Açoes</th>';

					  echo '</tr>';
					  echo '</thead>';
					  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 600px;overflow-y: scroll;overflow-x: hidden;">';

					   foreach($dados as $d_b){
					
						if($d_b['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
							  echo '<tr><td width=275>'.$d_b['nome'].'</td><td width=130>'.$d_b['CPF'].'</td><td width=142>'. $d_b['telefone'].'</td><td width=285>'.$d_b['email'].'</td>
							  <td width=125>'.$status.'</td><td><a class="btn btn-dark border-success me-2" href = "?pagina='.$pagina.'&id_usuario='.$d_b['id_usuario'].'">Selecionar</a>
							  </td></tr>';
								}

							  echo '</tbody>';
							   echo '</table>';
						}else{

							 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuario encontrado...</h3></div>';


							}
						
							echo '</div>';

						$sqlTotal ="SELECT COUNT(id_usuario) as id FROM usuarios WHERE status = 1";

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
							 
								echo '<a  class="btn btn-primary mb-2" href="?pagina=1">primeira</a> | ';
								echo "<a  class='btn btn-primary mb-2' href=\"?pagina=$anterior\">anterior</a> | ";
							
							 
								 /**
							* O loop para exibir os valores à esquerda
							*/
						   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
							   if($i > 0)
								echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'"> '.$i.' </a>';
						  }

						  echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';

						  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							   if($i <= $totalPagina)
								echo '<a class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'"> '.$i.' </a>';
						  }

						   /**
							* Depois o link da página atual
							*/
						   /**
							* O loop para exibir os valores à direita
							*/

						  
							 echo " | <a class='btn btn-primary mb-2' href=\"?pagina=$posterior\">próxima</a> | ";
							echo "  <a class='btn btn-primary mb-2' href=\"?pagina=$totalPagina\">última</a>";
						   

				if(isset($_GET['id_usuario'])){
					$us_a = $_GET['id_usuario'];
					$sql_12 = "SELECT * FROM usuarios WHERE id_usuario = '".$us_a."'";
					$consulta_12 = $conexao->query($sql_12);
					$dados_usu = $consulta_12->fetch(PDO::FETCH_ASSOC);
					
						
					echo  '<div class="modal fade modal-lg" id="exemplomodal">
				  <div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
						<h3 class="modal-title">Tem certeza que deseja escolher o usuario a seguir?</h3>
					   </div>
					  <div class="modal-body bg-light">';
					echo '
						<h4>Dados do usuário</h4> 
						<table><thead><tr>
						<th width=120>Id. Usuario</th>
						<th width=200>Nome</th>
						<th  width=120>CPF</th>
						<th  width=120>Telefone</th>
						<th>Opções</th>
						</tr>
						</thead><tbody><tr>';
						echo '<td>'.$dados_usu['id_usuario'].'</td>
						<td>'.$dados_usu['nome'].'</td>
						<td>'.$dados_usu['CPF'].'</td>
						<td>'.$dados_usu['telefone'].'</td>
						<td><a class="btn btn-secondary" href="select_prod.php?id_usuario='.$dados_usu['id_usuario'].'">Selecionar</a></td>
						</tr></tbody></table>';    
						
						echo '</div>
						<div class="modal-footer bg-white">
						 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					   </div>
						</div>
						</div>
						</div>';	
				}					
							  
				
					if(isset($_GET['adicionar_cliente'])){
					echo  '<div class="modal fade modal-lg" id="exemplomodal">
							  <div class="modal-dialog">
								<div class="modal-content ">
								  <div class="modal-header bg-info">
									<h3 class="modal-title">Entre com os dados obrigatórios do novo usuário</h3>
								   </div>
								  <div class="modal-body bg-light">
								  <form method="POST">
								  <table border="3" class="rounded w-75">
								  <thead class="border bg-light">
								  <tr>
								  <th>
								  <strong class="ms-3">
								  Casdastro
								  </strong>
								  </th>
								  </tr>
								  </thead>
								  <tbody>
								  <tr>
								  <td>
								  <strong>
								  Nome Completo
								  </strong>
								  </td>
								  <td>
								  <input type="search" name="nome" class="form-control mt-2" value="" required/>
								  </td>
								  </tr>
								  <tr>
								  <td>
								  <strong>
								  E-mail
								  </strong>
								  </td>
								  <td>
								  <input type="e-mail" name="email" class="form-control mt-2" value="" required/>
								  </td>
								  </tr>
								  <tr> 
								  <td>
								  <strong>
								  CPF
								  </strong>
								  </td>
								  <td>
								  <input type="cpf" name="CPF" class="form-control mt-2" value="" required/>
								  </td>
								  </tr>
								  <tr>
								  <td>
								  <strong>
								  Telefone
								  </strong>
								  </td>
								  <td>
								  <input type="search" name="telefone" class="form-control mt-2" required/>
								  </td>
								  </tr>
								  <tr>
								  <td>
								  <strong>
								  Senha
								  </strong>
								  </td>
								  <td>
								  <input type="password" name="senha" class="form-control mt-2" required/>
								  </td>
								  </tr>
								  <tr>
								  <td>
								  <strong>
								  Confirmação da senha
								  </strong>
								  </td>
								  <td>
								  <input type="password" name="conf_senha" class="form-control mt-2" required/>
								  </td>
								  </tr>
								  <tr>
								  <td colspan="2" align="right">
								  <button type="button" class="btn btn-secondary mt-3 mb-2" data-bs-dismiss="modal">Fechar</button>
								  <input type="submit" class="btn btn-success mt-3 mb-2 me-3" value="Cadastrar" />
								  </td>
								  </tr>
								  </tbody>
								  </table>
								  </form>
								  </div>
								  </div>
								  </div>
								  </div>
								';}
		?>
		</div>
	</div>
  </div>
</body>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>