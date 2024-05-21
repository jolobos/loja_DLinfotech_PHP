<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_GET['id_usuario'])){	
	$id_usuario = $_GET['id_usuario'];
	$sql = "SELECT * FROM usuarios WHERE id_usuario='".$id_usuario."'";
	$consulta = $conexao->query($sql);
	$dados = $consulta->fetch(PDO::FETCH_ASSOC);
}

if(!empty($_POST['assunto']) && !empty($_POST['conteudo'])){
	$id = $_POST['id_usuario'];
	$condicao = 1;
	$data_envio = date("Y-m-d H:s:i");
	$assunto = $_POST['assunto'];
	$conteudo = $_POST['conteudo'];
	$link_1 = $_POST['Link_1'];
	$link_2 = $_POST['Link_2'];
	$link_3 = $_POST['Link_3'];
	$link_4 = $_POST['Link_4'];
	$link_5 = $_POST['Link_5'];
	$sql ='INSERT INTO notificacoes (id_usuario,titulo,conteudo,link_1,link_2,link_3,link_4,link_5,condicao,data_envio)
    values(?,?,?,?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id,$assunto,$conteudo,$link_1,$link_2,$link_3,$link_4,$link_5,$condicao,$data_envio));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	if($ok){    
    $msg= 'Sua mensagem foi enviada com sucesso!!!';
}else{
    $msg='Lamento, não foi possivel enviar a mensagem.'.$r->getMessage().'';
}
header('location:us_opcoes.php?mensagem='.$msg.'&id_usuario='.$id);

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
				<?php echo '<a class="btn btn-secondary border-danger m-2" href="usuarios.php">Voltar</a>'; ?>
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
		<h3 class="text-info">Envie a sua Notificação ao usuário</h3>
	</div>
	<div class="card-body">
	<form action="enviar_not_us.php" method="post">
	<h4>Assunto</h4>
	<input type="text" class="form-control form-control-lg border-dark" name="assunto" required>
	<div class="row">
	<div class="col">
	<h4 class="mt-2">Mensagem</h4>
	<textarea class="form-control border-dark" rows="9" name="conteudo" required></textarea>
	</div>
	<div class="col-sm-5">
	<h4 class="mt-2">Links</h4>
	<div class="row">
	<div class="col-sm-2 pt-1">
	<strong class="pt-2">Link 1:</strong>
	</div>
	<div class="col">
	<input type="text" class="form-control border-dark" name="Link_1" placeholder="Digite aqui o primeiro Link...">
	</div>
	</div>
	<div class="row mt-1">
	<div class="col-sm-2 pt-1">
	<strong class="pt-2">Link 2:</strong>
	</div>
	<div class="col">
	<input type="text" class="form-control border-dark" name="Link_2" placeholder="Digite aqui o segundo Link...">
	</div>
	</div>
	<div class="row mt-1">
	<div class="col-sm-2 pt-1">
	<strong class="pt-2">Link 3:</strong>
	</div>
	<div class="col">
	<input type="text" class="form-control border-dark" name="Link_3" placeholder="Digite aqui o terceiro Link...">
	</div>
	</div>
	<div class="row mt-1">
	<div class="col-sm-2 pt-1">
	<strong class="pt-2">Link 4:</strong>
	</div>
	<div class="col">
	<input type="text" class="form-control border-dark" name="Link_4" placeholder="Digite aqui o quarto Link...">
	</div>
	</div>
	<div class="row mt-1">
	<div class="col-sm-2 pt-1">
	<strong class="pt-2">Link 5:</strong>
	</div>
	<div class="col">
	<input type="text" class="form-control border-dark" name="Link_5" placeholder="Digite aqui o quinto Link...">
	</div>
	</div>
	
	</div>
	</div>
	<div align="center">
		<?php echo '<input type="hidden" name="id_usuario" value="'.$id_usuario.'">'; ?>
		<input type="submit" class="btn btn-primary mt-3" value="Enviar Notificação">
	</div>
	</form>
	</div>
	</div>
	</div>