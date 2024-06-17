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
	<h3>Escolha uma das opções de exclusão de usuários</h3>
	</div>
	<div class="card-body">
	<strong>atenção!!!!</strong>
	<p> Ao excluir os usuários, você pode acabar excluindo as compras efetuadas pelo usuário selecionado.</p>
	<p> Talvez seja do interesse do administrador, apenas tornar os usuários selecionados em usuários desativados, caso esses usuários
	já possuam alguma compra efetuada no sistema. Para esse caso, ficará a disposição as opções tanto de exclusão, quanto de desativação.</p>
	<h4>Opções de desativação automática</h4>
	<div id="accordion">

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseOne">
        Por Tempo
      </a>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body">
       <a href="?tempodes=30" class="btn btn-secondary border-info">1 mês</a>
		<a href="?tempodes=60" class="btn btn-secondary border-info">2 meses</a>
		<a href="?tempodes=90" class="btn btn-secondary border-info">3 meses</a>
		<a href="?tempodes=180" class="btn btn-secondary border-info">6 meses</a>
		<a href="?tempodes=270" class="btn btn-secondary border-info">9 meses</a>
		<a href="?tempodes=365" class="btn btn-secondary border-info">1 ano</a>
		<a href="?tempodes=730" class="btn btn-secondary border-info">2 anos</a>
		<a href="?tempodes=1095" class="btn btn-secondary border-info">3 anos</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseTwo">
       Por Compras
      </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
       <a href="?comprades=0" class="btn btn-secondary border-info">nenhuma compra</a>
       <a href="?comprades=1" class="btn btn-secondary border-info">1 compra</a>
       <a href="?comprades=2" class="btn btn-secondary border-info">2 compras</a>
       <a href="?comprades=3" class="btn btn-secondary border-info">3 compras</a>
       <a href="?comprades=4" class="btn btn-secondary border-info">4 compras</a>
       <a href="?comprades=5" class="btn btn-secondary border-info">5 compras</a>
       <a href="?comprades=6" class="btn btn-secondary border-info">6 compras</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseThree">
        Por Tempo sem Compras
      </a>
    </div>
    <div id="collapseThree" class="collapse" data-parent="#accordion">
      <div class="card-body">
	  <form class="mb-2">
	  <h4>Tempo personalizado</h4>
	  <div class="row">
	  <div class="col-sm-2">
	  <input type="date" name="data_person_temp_com_des" class="form-control">
	  </div>
	  <div class="col-sm-2">
	  <input type="submit" value="Enviar" class="btn btn-primary">
	  </div></div>
	  </form>
        <a href="?tempoxcomdes=30" class="btn btn-secondary border-info">1 mês</a>
		<a href="?tempoxcomdes=60" class="btn btn-secondary border-info">2 meses</a>
		<a href="?tempoxcomdes=90" class="btn btn-secondary border-info">3 meses</a>
		<a href="?tempoxcomdes=180" class="btn btn-secondary border-info">6 meses</a>
		<a href="?tempoxcomdes=270" class="btn btn-secondary border-info">9 meses</a>
		<a href="?tempoxcomdes=365" class="btn btn-secondary border-info">1 ano</a>
		<a href="?tempoxcomdes=730" class="btn btn-secondary border-info">2 anos</a>
		<a href="?tempoxcomdes=1095" class="btn btn-secondary border-info">3 anos</a>
      </div>
    </div>
  </div>
  </div>
  
  <h4 class='mt-3'>Opções de exclusão automática</h4>
	<div id="accordion">

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseOne2">
        Por Tempo
      </a>
    </div>
    <div id="collapseOne2" class="collapse" data-parent="#accordion">
      <div class="card-body">
       <a href="?tempoex=30" class="btn btn-secondary border-info">1 mês</a>
		<a href="?tempoex=60" class="btn btn-secondary border-info">2 meses</a>
		<a href="?tempoex=90" class="btn btn-secondary border-info">3 meses</a>
		<a href="?tempoex=180" class="btn btn-secondary border-info">6 meses</a>
		<a href="?tempoex=270" class="btn btn-secondary border-info">9 meses</a>
		<a href="?tempoex=365" class="btn btn-secondary border-info">1 ano</a>
		<a href="?tempoex=730" class="btn btn-secondary border-info">2 anos</a>
		<a href="?tempoex=1095" class="btn btn-secondary border-info">3 anos</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseTwo2">
       Por Compras
      </a>
    </div>
    <div id="collapseTwo2" class="collapse" data-parent="#accordion">
      <div class="card-body">
	   <a href="?compraex=0" class="btn btn-secondary border-info">nenhuma compra</a>
       <a href="?compraex=1" class="btn btn-secondary border-info">1 compra</a>
       <a href="?compraex=2" class="btn btn-secondary border-info">2 compras</a>
       <a href="?compraex=3" class="btn btn-secondary border-info">3 compras</a>
       <a href="?compraex=4" class="btn btn-secondary border-info">4 compras</a>
       <a href="?compraex=5" class="btn btn-secondary border-info">5 compras</a>
       <a href="?compraex=6" class="btn btn-secondary border-info">6 compras</a>
            </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="btn btn-success" data-toggle="collapse" href="#collapseThree2">
        Por Tempo sem Compras
      </a>
    </div>
    <div id="collapseThree2" class="collapse" data-parent="#accordion">
      <div class="card-body">
	  <form class="mb-2">
	  <h4>Tempo personalizado</h4>
	  <div class="row">
	  <div class="col-sm-2">
	  <input type="date" name="data_person_temp_com_exc" class="form-control">
	  </div>
	  <div class="col-sm-2">
	  <input type="submit" value="Enviar" class="btn btn-primary">
	  </div></div>
	  </form>
                <a href="?tempoxcomexc=30" class="btn btn-secondary border-info">1 mês</a>
		<a href="?tempoxcomexc=60" class="btn btn-secondary border-info">2 meses</a>
		<a href="?tempoxcomexc=90" class="btn btn-secondary border-info">3 meses</a>
		<a href="?tempoxcomexc=180" class="btn btn-secondary border-info">6 meses</a>
		<a href="?tempoxcomexc=270" class="btn btn-secondary border-info">9 meses</a>
		<a href="?tempoxcomexc=365" class="btn btn-secondary border-info">1 ano</a>
		<a href="?tempoxcomexc=730" class="btn btn-secondary border-info">2 anos</a>
		<a href="?tempoxcomexc=1095" class="btn btn-secondary border-info">3 anos</a>
      </div>
    </div>
  </div>

</div>
<?php
if(!empty($_GET['tempodes'])){
	$tempo = $_GET['tempodes'];
	$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;
		
		$sql = "SELECT * FROM usuarios WHERE data_entrada >=".$periodo." ORDER BY data_entrada DESC";
		$consulta = $conexao->query($sql);
		$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a desativar os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d){
		if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
			$data_new = $d['data_entrada'];
			echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
			<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
			</td></tr>';
		}}else{
				 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuário encontrado...</h3></div>';

		}
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?desativa_tempo='.$tempo.'" class="btn btn-primary">Desativar</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}
if(!empty($_GET['tempoex'])){
	$tempo = $_GET['tempoex'];
	$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;
		
		$sql = "SELECT * FROM usuarios WHERE data_entrada >=".$periodo." ORDER BY data_entrada DESC";
		$consulta = $conexao->query($sql);
		$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a excluir os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d){
		if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
			$data_new = $d['data_entrada'];
			echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
			<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
			</td></tr>';
		}}else{
				 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuário encontrado...</h3></div>';

		}
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?exclui_tempo='.$tempo.'" class="btn btn-primary">Excluir</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}
if(isset($_GET['comprades'])){
	$compras = $_GET['comprades'];
    if($compras == 0 )
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	}else{
	$sql_b = "SELECT id_usuario,COUNT(id_usuario) AS id_us FROM compras GROUP BY id_usuario";
	$consulta_b = $conexao->query($sql_b);
	$dados_b = $consulta_b->fetchALL(PDO::FETCH_ASSOC);
	}
	$cont =0;
		
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a excluir os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d){
						
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
				</td></tr>';
                                $cont +=1;
                                }
		}else if(!empty($dados_b)){		
		foreach($dados_b as $d_b){ 
				if($d_b['id_us'] == $compras){
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
		</td></tr>';
                                $cont +=1;
                                }}
		}
                if($cont == 0){echo '<tr><td width=1110 colspan=6>Lamento, não há resultado para sua busca...</td></tr>';
                
		}
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?desativa_compra='.$compras.'" class="btn btn-primary">Desativar</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}

if(isset($_GET['compraex'])){
	$compras = $_GET['compraex'];
    if($compras == 0 )
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
	}else{
	$sql_b = "SELECT id_usuario,COUNT(id_usuario) AS id_us FROM compras GROUP BY id_usuario";
	$consulta_b = $conexao->query($sql_b);
	$dados_b = $consulta_b->fetchALL(PDO::FETCH_ASSOC);
	}
	$cont = 0;	
		
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a excluir os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d){
						
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
				</td></tr>';
                                $cont +=1;
                                }
		}else if(!empty($dados_b)){		
		foreach($dados_b as $d_b){ 
				if($d_b['id_us'] == $compras){
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
		</td></tr>';
                                $cont +=1;
                                }}
		}
                if($cont == 0){echo '<tr><td width=1110 colspan=6>Lamento, não há resultado para sua busca...</td></tr>';
                
		}
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?exclui_compra='.$compras.'" class="btn btn-primary">Excluir</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}
// iniciando configuração de tempo sem compras
if(isset($_GET['tempoxcomdes']) || isset($_GET['data_person_temp_com_des'])){
	if(isset($_GET['tempoxcomdes'])){$compras = $_GET['tempoxcomdes'];}
	if(isset($_GET['data_person_temp_com_des'])){ 
	$date1=date_create($_GET['data_person_temp_com_des']);
	$date2=date_create(date('Y-m-d'));
	$diff=date_diff($date1,$date2);
	$compras = $diff->format("%a");
	}
    if(!empty($compras))
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
          $contt = 0;
		
		
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a excluir os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários para '.$compras.' dias</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d_b){ 
				if($compras != 0){
				$tempo = $compras;
				$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;	
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']." AND data_entrada >= ".$periodo."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				if(!empty($d['id_usuario'])){
                                $contt +=1;
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
				</td></tr>';}}}}
                                if($contt == 0){
                                    echo '<tr><td width=1110>Lamento, não há resultado para sua busca...</td></tr>';
		
                                }
		
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?desativa_tempo_compra='.$compras.'" class="btn btn-primary">Desativar</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}
}
if(isset($_GET['tempoxcomexc']) || isset($_GET['data_person_temp_com_exc'])){
	if(isset($_GET['tempoxcomexc'])){$compras = $_GET['tempoxcomexc'];}
	if(isset($_GET['data_person_temp_com_exc'])){ 
	$date1=date_create($_GET['data_person_temp_com_exc']);
	$date2=date_create(date('Y-m-d'));
	$diff=date_diff($date1,$date2);
	$compras = $diff->format("%a");
	}
    if(!empty($compras))
	{ $sql = "SELECT * FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC ";
	  $consulta = $conexao->query($sql);
	  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
          $contt = 0;
		
		
		echo '
		
		<div class="modal modal-xl" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Você está preste a excluir os seguintes usuários:</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
				  <h4>Lista de usuários para '.$compras.' dias</h4>';
		echo '<h3 class="ms-3">Resultado:</h3>';
		echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;">';
		echo '<thead border="2" class="border-secondary" style="display: block;position: relative">';
		echo '<tr>';
		  
		echo '<th width=270>Nome</th><th width=120>CPF</th><th width=130>Telefone</th><th width=335>E-mail</th><th width=130>status</th><th width=120>data</th>';
		  
		echo '</tr>';
		echo '</thead>';
		echo '<tbody   style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
		if(!empty($dados)){		
		foreach($dados as $d_b){ 
				if($compras != 0){
				$tempo = $compras;
				$periodo = ' DATE_ADD(CURDATE(),INTERVAL -'.$tempo.' DAY)' ;	
				$sql_c = "SELECT * FROM usuarios WHERE id_usuario = ".$d_b['id_usuario']." AND data_entrada >= ".$periodo."";
				$consulta_c = $conexao->query($sql_c);
				$d = $consulta_c->fetch(PDO::FETCH_ASSOC);		
				if(!empty($d['id_usuario'])){
                                $contt +=1;
				if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
				$data_new = $d['data_entrada'];
				echo '<tr><td width=270>'.$d['nome'].'</td><td width=120>'.$d['CPF'].'</td><td width=130>'. $d['telefone'].'</td><td width=335>'.$d['email'].'</td>
				<td width=130>'.$status.'</td><td>'.date_format(new DateTime($data_new),"d/m/Y").'</td>
				</td></tr>';}}}}
                                if($contt == 0){
                                    echo '<tr><td width=1110>Lamento, não há resultado para sua busca...</td></tr>';
		
                                }
		
		 echo '
		 </tbody></table>
		 
		 </div>

				  <!-- Modal footer -->
				  <div class="modal-footer">
					<a href="prog_ex_auto.php?exclui_tempo_compra='.$compras.'" class="btn btn-primary">Excluir</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="myBtn">Cancelar</button>
				  </div>

				</div>
			  </div>
			</div>';
echo '<script>
$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
    });
	
	$("#myBtn").click(function(){
    $("#myModal").modal("hide");
  });
</script>';

}
}

?>	
	
	</div>
	</div>
</div>