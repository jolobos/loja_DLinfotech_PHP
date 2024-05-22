<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
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
    <script type="text/javascript" src="func_us.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para Usuários
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="usuarios.php">Usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="novos_usuarios.php">Novos usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="des_usuarios.php">Usuários desativados</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_mais_cp.php">Usuários que mais compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_menos_cp.php">Usuários que menos compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_nunca_cp.php">Usuários que nunca compraram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ex_auto.php">Exclusão automática</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
	<div class="card-header">
	<h3 class="text-info">Pesquisas para Usuários: </h3>
	</div>
	<div class="card-body">
	<div class="row"><div class="col-sm-4">
	<h4 class="mt-3">Por nome do Usuários: </h4>
	<div class="col-sm-5">
	<input type="search" id="busca" style="width:370px" class="form-control" placeholder="Digite o nome do usuário..." onKeyUp="buscarprodutos(this.value)"/>
	</div>
	<h5 class="mt-3">Por CPF do Usuários: </h5>
	<form action="usuarios.php" method="POST"><div class="row">
	<div class="col-sm-6">
	<input type="text"  class="form-control" style="width:250px" name="CPF_usuario"  placeholder="Digite o CPF do usuário..." autofocus/>
	</div>
	<div class="col ms-5"><button type="submit"  class="btn btn-secondary border-info" style="width:105px" >
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
	  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
	</svg>- Buscar
	</button>
	</div></div>
	</form>
	<h5 class="mt-3">Por E-mail do Usuários: </h5>
	<form action="usuarios.php" method="POST" class="mt-2"><div class="row">
	<div class="col-sm-6">
	<input type="text"  class="form-control" style="width:250px" name="email_usuario"  placeholder="Digite o E-mail do usuário..." autofocus/>
	</div>
	<div class="col ms-5"><button type="submit"  class="btn btn-secondary border-info" style="width:105px" >
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
	  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
	</svg>- Buscar
	</button>
	</div></div>
	</form>
	<h5 class="mt-3">Por telefone do Usuários: </h5>
	<form action="usuarios.php" method="POST" class="mt-2"><div class="row">
	<div class="col-sm-6">
	<input type="text"  class="form-control" style="width:250px" name="tel_usuario"  placeholder="Digite o telefone do usuário..." autofocus/>
	</div>
	<div class="col ms-5"><button type="submit"  class="btn btn-secondary border-info" style="width:105px" >
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
	  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
	</svg>- Buscar
	</button>
	</div></div>
	</form>
	</div>
	<div class="col">  
	  <div id="resultado" >      
	<?php
	if(!empty($_POST['CPF_usuario'])){
  $valor=$_POST['CPF_usuario'];
  $sql = "SELECT * FROM usuarios WHERE CPF='".$valor."'";
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
	  <td width=100>'.$status.'</td><td width=80><a class="btn btn-dark border-success me-2" href = "us_opcoes.php?id_usuario='.$d['id_usuario'].'">Selecionar</a>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuario encontrado...</h3></div>';

  
  }	
	}else if(!empty($_POST['tel_usuario'])){
		$valor=$_POST['tel_usuario'];
  $sql = "SELECT * FROM usuarios WHERE telefone='".$valor."'";
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
	  <td width=100>'.$status.'</td><td width=80><a class="btn btn-dark border-success me-2" href = "us_opcoes.php?id_usuario='.$d['id_usuario'].'">Selecionar</a>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuario encontrado...</h3></div>';

  
  }	
	}else if(!empty($_POST['email_usuario'])){
		$valor=$_POST['email_usuario'];
  $sql = "SELECT * FROM usuarios WHERE email='".$valor."'";
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
	  <td width=100>'.$status.'</td><td width=80><a class="btn btn-dark border-success me-2" href = "us_opcoes.php?id_usuario='.$d['id_usuario'].'">Selecionar</a>
	  </td></tr>';
 }
  
  echo '</tbody>';
   echo '</table>';
  }else{

	 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuario encontrado...</h3></div>';

  
  }	
	}else{ 
			echo '<div><h3 class="alert alert-secondary mt-2">Por favor, entre com o campo de busca do usuário...</h3</div>';

	}
		
		?>
	  </div>
	  </div>
	  </div>
	  </div>
				
</div>
	
				