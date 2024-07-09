<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['ex_td_cp'])){
	$sql_ex = 'SELECT * FROM compras AS c WHERE NOT EXISTS (SELECT id_usuario FROM usuarios AS us WHERE us.id_usuario = c.id_usuario)';
	$consulta_ex = $conexao->query($sql_ex);
	$dados_ex = $consulta_ex->fetchALL(PDO::FETCH_ASSOC);
	foreach($dados_ex as $d_ex){
	
	$exc = $d_ex['id_compra'];
	$sql ='DELETE FROM itens_da_compra WHERE id_compra = ?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($exc));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	
	if($ok){
		$sql1 ='DELETE FROM compras WHERE id_compra = ?';
		try {
			$insercao1 = $conexao->prepare($sql1);
		$ok1 = $insercao1->execute(array ($exc));
		}catch(PDOException $r){
	//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok1 = False;
		}catch (Exception $r){//todos as exceções
		$ok1= False; 
		}
		
	}
	
	}
	
	if($ok1){
		$msg = 'Compras excluidas com sucesso.';
		header("location:compras.php?msg=".$msg);
	}else{
		$msg = 'Erro, as compras não foram excluidas.';
		header("location:compras.php?msg=".$msg);
	}
}

if(isset($_GET['id_usuario'])){
	$id_usuario = $_GET['id_usuario'];
	$id_compra = $_GET['opcoes_compra'];
	$sql ='UPDATE compras SET id_usuario=? WHERE id_compra = '.$id_compra.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	
	if($ok){
		header("location:?opcoes_compra=".$id_compra."&mensagem=OK! atualizado com sucesso");
	}else{
		header("location:opcoes_compra=".$id_compra."&mensagem=ERRO! Nao rolou...");

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
                <div class="row">
                <div class="col">
				<h3 class="text-info">Pesquisa de compras sem usuários</h3>
				</div>
				<div class="col">
					<div class="row">
					<div class="col mt-2" align="right">
					<h5>Excluir todas as compras sem usuários:</h5>
					</div>
					<div class="col-sm-2">
					<a class="btn btn-dark border-danger" href="?ex_td_cp">Excluir</a>
					</div>
					</div>
				</div>
				</div>
            </div>
            <div class="card-body">
                <h3>Escolha em qual ordem será organizado a pesquisa:</h3>
				<form>
				<div class="row">
				<div class="col-sm-2">
				<p><strong>Categoria</strong></p>
				</div>
				<div class="col-sm-2">
				<p><strong>Ordem</strong></p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-2">
				<select name="organizacao" class="form-control">
				<option>Data da compra</option>
				<option>Valor da compra</option>
				</select>
				</div>
				<div class="col-sm-2">
				<select name="ordenacao" class="form-control">
				<option>Crescente</option>
				<option>Decrescente</option>
				</select>
				</div>
				<div class="col-sm-2">
				<input class="btn btn-success" type="submit" value="Pesquisar"/>
				</div>
				</div>
				</form>
				
				
			</div>
	</div>
</div>

<?php
if(!empty($_GET['organizacao'])){
$organizacao = $_GET['organizacao'];
$ordem = $_GET['ordenacao'];
if($organizacao == "Data da compra"){
$org = 'data';}
else if($organizacao == "Valor da compra"){
$org = 'total';}else{
$org = 'id_compra';}

if($ordem == "Crescente"){
$ord = 'ASC';}
else if ($ordem == "Decrescente"){
$ord = 'DESC';}else{
$ord = 'ASC';}

$quantidade_cp = 15; 
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio     = ($quantidade_cp * $pagina) - $quantidade_cp;
    $sql_a = "SELECT * FROM compras AS c WHERE NOT EXISTS (SELECT id_usuario FROM usuarios AS us WHERE us.id_usuario = c.id_usuario) ORDER BY $org $ord LIMIT ".$inicio.",".$quantidade_cp."";
	$consulta_a = $conexao->query($sql_a);
	$dados = $consulta_a->fetchALL(PDO::FETCH_ASSOC);
	
	echo '<div class="modal fade modal-xl"  id="exemplomodal">
					  <div class="modal-dialog" >
						<div class="modal-content ">
						  <div class="modal-header bg-info">
							<h3 class="modal-title">Compras que não foram pagas organizadas por '.$organizacao.' - '.$ordem.'</h3>
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
								foreach ($dados as $d){
									
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
						  <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>';
    
        
    

$sqlTotal = "SELECT COUNT(id_compra) AS id FROM compras AS c WHERE NOT EXISTS (SELECT id_compra FROM itens_da_compra AS cp WHERE cp.id_compra = c.id_compra)";
  //Executa o SQL
$consulta_c = $conexao->query($sqlTotal);
$qrTotal = $consulta_c->fetch(PDO::FETCH_ASSOC);
   
  //O calculo do Total de página ser exibido
  $totalPagina= ceil($qrTotal['id']/$quantidade_cp);
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
     
        echo '<a  class="btn btn-primary mb-2" href="?organizacao='.$organizacao.'&ordenacao='.$ordem.'&pagina=1">primeira</a> | ';
        echo "<a  class='btn btn-primary mb-2' href=\"?organizacao=$organizacao&ordenacao=$ordem&pagina=$anterior\">anterior</a> | ";
    
     
         /**
    * O loop para exibir os valores à esquerda
    */
   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0)
        echo '<a  class="btn btn-primary mb-2 " href="?organizacao='.$organizacao.'&ordenacao='.$ordem.'&pagina='.$i.'"> '.$i.' </a>';
  }

  echo '<a  class="btn btn-primary mb-2 ms-1" href="?organizacao='.$organizacao.'&ordenacao='.$ordem.'&pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';

  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo '<a class="btn btn-primary mb-2 ms-1" href="?organizacao='.$organizacao.'&ordenacao='.$ordem.'&pagina='.$i.'"> '.$i.' </a>';
  }

   /**
    * Depois o link da página atual
    */
   /**
    * O loop para exibir os valores à direita
    */

  
     echo " | <a class='btn btn-primary mb-2' href=\"?organizacao=$organizacao&ordenacao=$ordem&pagina=$posterior\">próxima</a> | ";
    echo "  <a class='btn btn-primary mb-2' href=\"?organizacao=$organizacao&ordenacao=$ordem&pagina=$totalPagina\">última</a>";
   
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
        </thead><tbody><tr>';
		if(!empty($dados_usu)){
        echo '<td>'.$dados_usu['id_usuario'].'</td>
        <td>'.$dados_usu['nome'].'</td>
        <td>'.$dados_usu['CPF'].'</td>
        <td>'.$dados_usu['telefone'].'</td>
        <td><a class="btn btn-secondary" href="../usuarios/us_opcoes.php?id_usuario='.$dados_usu['id_usuario'].'" target=_blank>Visualizar usuário</a></td>';    
        }else{
		echo '<td>SEM USUARIO</td>
        <td> ---- </td>
        <td> ---- </td>
        <td> ---- </td>
        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo33">
			Adicionar Usuário
		</button></td>';    
        
		}
		echo '</tr></tbody></table>
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
                <a class="btn btn-dark border-info" href="alterar_com.php?alterar_compra='.$id_venda_lista.'">alterar compra</a>
                <a class="btn btn-dark border-info" href="add_itens.php?add_itens_compra='.$id_venda_lista.'">Adicionar produtos</a>

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
        <a class="btn btn-success" href="excluir_com.php?excluir_compra='.$id_venda_lista.'">Excluir</a>
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
       				
echo '
<div class="modal fade modal-lg" id="modalExemplo33" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" id="exampleModalLabel">Escolha um dos usuários</h5>
      </div>
      <div class="modal-body bg-white">';
        $sql_1221 = "SELECT * FROM usuarios WHERE status = 1";
		$consulta_1221 = $conexao->query($sql_1221);
		$dados_usua = $consulta_1221->fetchALL(PDO::FETCH_ASSOC);
		if(!empty($dados_usua)){
		 echo '<table  align="center" border="3" class="border-secondary" style="table-layout: fixed;width:750px">';
		 echo '<thead style="display: block;position: relative;" class="border">';
								
		  echo '<tr>';
		  
		  echo '<th width=200>Nome</th><th width=100>CPF</th><th width=100>Telefone</th><th width=200>E-mail</th><th width=80>Açoes</th>';
		  
		  echo '</tr>';
		  echo '</thead>';
		  echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 300px;overflow-y: scroll;overflow-x: hidden;">';
		  
		  foreach($dados_usua as $d){
			  if($d['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
			  echo '<tr><td width=200>'.$d['nome'].'</td><td width=100>'.$d['CPF'].'</td><td width=100>'. $d['telefone'].'</td><td width=200>'.$d['email'].'</td>
			  <td width=80><a class="btn btn-dark border-success me-2" href = "?opcoes_compra='.$id_venda_lista.'&id_usuario='.$d['id_usuario'].'">Selecionar</a>
			  </td></tr>';
		 }
		  
		  echo '</tbody>';
		   echo '</table>';
		  }
		
      echo '</div>
      <div class="modal-footer bg-white">
		<div>
		<p><strong>Caso você não ache o usuário que procura, aperte "Ctrl + F", para localizar o usuário desejado!</strong></p>
        </div>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
';	
?>



<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>