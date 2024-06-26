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
					Opções para Compras
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
				<a class="btn btn-secondary border-danger m-2" href="compras.php">Compras do dia</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_usuario.php">Compras por usuário</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_data.php">Compras por data</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_valor.php">Compras por valor</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_pag.php">Compras sem pagamento</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_nao_ent.php">Compras não entregue</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_us.php">Compras sem usuários</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
            <div class="card-header">
                <h3 class="text-info">Pesquisa de compras por usuários</h3>
            </div>
            <div class="card-body">
                <h3>Escolha o tipo de busca desejado</h3>
                <div class="row">
                <div class="col-sm-4">
				<p><strong>Nome</strong></p>
                <input type="search" id="busca"  class="form-control" placeholder="Digite o nome do usuário..." onKeyUp="buscarprodutos(this.value)" autofocus/>
                <form class="mt-2">
                <p><strong>ID Usuário</strong></p>
				<div class="row">
				<div class="col-sm-8">
                <input type="search" class="form-control" name="ID_us" placeholder="Digite o ID do usuário..."/>
                </div><div class="col"><input type="submit" class="btn btn-secondary" value="Pesquisar"></div></div>
				</form>
				<form class="mt-2">
				<p><strong>CPF</strong></p>
               <div class="row">
				<div class="col-sm-8">
                <input type="search" class="form-control" name="CPF_us" placeholder="Digite o CPF do usuário..."/>
                </div>
				<div class="col">
				<input type="submit" class="btn btn-secondary" value="Pesquisar"></div>
				</div>
				</form>
				<form class="mt-2">
				<p><strong>E-mail</strong></p>
				<div class="row">
				<div class="col-sm-8">
                <input type="email" class="form-control" name="email_us" placeholder="Digite o E-mail do usuário..."/>
                </div><div class="col"><input type="submit" class="btn btn-secondary" value="Pesquisar"></div></div>
                </form>
                </div>
                <div class="col">
				<div class="mt-3" id="resultado">
				<?php
				if(isset($_GET['ID_us'])){
					$valor = $_GET['ID_us'];
					if($valor != ''){
					  $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$valor." LIMIT 0,10";
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
				}
				else if(isset($_GET['CPF_us'])){
					$valor = $_GET['CPF_us'];
					if($valor != ''){
					  $sql = "SELECT * FROM usuarios WHERE CPF = ".$valor." LIMIT 0,10";
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
				}
				else if(isset($_GET['email_us'])){
					$valor = $_GET['email_us'];
					if($valor != ''){
					  $sql = "SELECT * FROM usuarios WHERE email = ".$valor." LIMIT 0,10";
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
				}
                ?></div>
				</div>
            </div>
        </div>
		<?php
			if(isset($_GET['id_usuario'])){
				$id_compra = $_GET['id_usuario'];
				$sql_1 = "SELECT * FROM usuarios WHERE id_usuario = ".$id_compra." LIMIT 0,10";
				$consulta_1 = $conexao->query($sql_1);
				$dados_usu = $consulta_1->fetch(PDO::FETCH_ASSOC);
				
				$sql_2 = "SELECT * FROM compras WHERE id_usuario = ".$id_compra."";
				$consulta_2 = $conexao->query($sql_2);
				$dados_2 = $consulta_2->fetchALL(PDO::FETCH_ASSOC);
				
				
				
				echo '<div class="modal fade modal-xl"  id="exemplomodal">
					  <div class="modal-dialog" >
						<div class="modal-content ">
						  <div class="modal-header bg-info">
							<h3 class="modal-title">Compras efetuadas pelo usuário : "'.$dados_usu['nome'].'"</h3>
						   </div>
						  <div class="modal-body bg-light">';
								echo '<table  align="center" border="3" class="border-secondary" style="table-layout: fixed;width:1113px">';
								echo '<thead style="display: block;position: relative;" class="border">';
								echo '<tr>';

								echo '  <th width=120>Id. da compra</th>
								<th width=120>Pagamento</th>
								<th width=250>Endereço</th>
								<th width=120>Data da compra</th>
								<th width=120>Pago</th>
								<th width=120>Entregue</th>
								<th width=120>Total da compra</th>
								<th width=120>Ações</th>';
								echo '</tr>';
								echo '</thead>';
								echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';
								$contagem = 0;
								foreach ($dados_2 as $d){
									$contagem += 1;
									$id_compra_1 = $d['id_compra'];
									$id_endereco = $d['id_endereco'];
									$sqlend = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco."'";
									$consultaend = $conexao->query($sqlend);
									$dados_end = $consultaend->fetch(PDO::FETCH_ASSOC);
									$endereco = '<strong>R:</strong> '.$dados_end['logradouro'].' <strong>N°</strong> '.$dados_end['numero'].'<br><strong>B: </strong>'.$dados_end['bairro'].' <strong>Cidade:</strong> '.$dados_end['cidade'].'';
													
													$autorizado= $d['autorizado'];
									if($autorizado == 0){ $pago = 'Não';
														}else{
																$pago = 'Sim';
														}
													$entregue=$d['entregue'];
														if($entregue == 0){ $ent = 'Não';
														}else{
																$ent = 'Sim';
														}
								   echo '<tr style="height: 60px">
										<td width=120><P class="mt-4">'.$d['id_compra'].'</P></td>
										<td width=120><P class="mt-4">'.$d['pagamento'].'</P></td>
										<td width=250><P class="mt-4">'.$endereco.'</P></td>
										<td width=120><P class="mt-4">'.date_format(new DateTime($d['data']),"d/m/Y").'</P></td>
										<td width=120><P class="mt-4">'.$pago.'</P></td>
										<td width=120><P class="mt-4">'.$ent.'</P></td>
										<td width=120><P class="mt-4"> R$: '.number_format($d['total'],2,',','.').'</P></td>
										<td width=120><a class="btn btn-success w-75 mt-2" href="?opcoes_compra='.$id_compra_1.'">Opções</a></td></tr>';
										
										}
										echo '</tbody></table>';
									  
								  
						  echo '</div>
						  <div class="modal-footer bg-light">'.$contagem.'<br>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
						  ';
									
			
			}
			
                if(isset($_GET['opcoes_compra'])){
	$id_venda_lista = $_GET['opcoes_compra'];
	$sql_10 = "SELECT * FROM itens_da_compra WHERE id_compra = '".$id_venda_lista."'";
	$consulta_10 = $conexao->query($sql_10);
	$dados_ab = $consulta_10->fetchALL(PDO::FETCH_ASSOC);
	
        $sql_11 = "SELECT * FROM compras WHERE id_compra = '".$id_venda_lista."'";
	$consulta_11 = $conexao->query($sql_11);
	$dados_com = $consulta_11->fetch(PDO::FETCH_ASSOC);
	$us_a = $dados_com['id_usuario'];
        
        $sql_12 = "SELECT * FROM usuarios WHERE id_usuario = '".$us_a."'";
	$consulta_12 = $conexao->query($sql_12);
	$dados_usu = $consulta_12->fetch(PDO::FETCH_ASSOC);
	
        
	echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Lista de produtos da compra de n°: "'.$id_venda_lista.'"</h3>
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
        </thead><tbody><tr>
        <td>'.$dados_usu['id_usuario'].'</td>
        <td>'.$dados_usu['nome'].'</td>
        <td>'.$dados_usu['CPF'].'</td>
        <td>'.$dados_usu['telefone'].'</td>
        <td><a class="btn btn-secondary" href="../usuarios/us_opcoes.php?id_usuario='.$dados_usu['id_usuario'].'" target=_blank>Visualizar usuário</a></td>    
        </tr></tbody></table>
        <table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="8">Produtos da Compra</th>
                    </tr>
                    <tr>
                        <th>Código do produto</th>
                        <th>Foto do produto </th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>';
	$total_somado = 0;
	foreach($dados_ab as $d_ab){
	$id_produto_lista = $d_ab['id_produto'];
	$sql_100 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto_lista."'";
	$consulta_100 = $conexao->query($sql_100);
	$dados_abc = $consulta_100->fetch(PDO::FETCH_ASSOC);
	
	$cod_produto = $dados_abc['cod_produto'];
        $nome = $dados_abc['nome'];
        $valor= $dados_abc['valor'];
        $quantidade= $d_ab['quantidade'];
	$foto_pr= $dados_abc['foto'];
	$total = $quantidade * $dados_abc['valor'];
        $total_somado += $total;
	echo '<tr style="height: 110px">
                <td><P style="margin-top: 40px">'.$cod_produto.'</P></td>
                <td><img style="width:100px "src="../../img/produtos/'.$foto_pr.'"> </td>
                <td width="400"><P style="margin-top: 40px">'.$nome.'</P></td>
                <td><P style="margin-top: 40px; width: 70px">R$: '. number_format($valor,2,',','.').'</P></td>
                <td><P style="margin-top:40px ; width: 70px">'.$quantidade.' Un</P></td>
                <td><P style="margin-top: 40px; width: 70px"> R$: '.number_format($total,2,',','.').'</P></td></tr>';
	
	}        
		
      echo '<tr><td align="right" colspan="6"><P >Total R$: '.number_format($total_somado,2,',','.').'</P></td></tr>

          </tbody></table></div>
      <div class="modal-footer bg-light">
                <a class="btn btn-dark border-info" href="alterar_com?alterar_compra='.$id_venda_lista.'">alterar compra</a>
                <a class="btn btn-dark border-info" href="add_itens?add_itens_compra='.$id_venda_lista.'">Adicionar produtos</a>

                <button type="button" class="btn btn-dark border-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                     Excluir
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
      echo '

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Tem certeza que deseja excluir essa compra?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body bg-white">
        <p>Escolha uma das opções abaixo...</p>
        <div align="right">
        <a class="btn btn-success" href="excluir_com?excluir_compra='.$id_venda_lista.'">Excluir</a>
        <a class="btn btn-danger" href="?opcoes_compra='.$id_venda_lista.'">Cancelar</a>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer bg-white">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>';
}			
		?>
		
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>