<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_GET['id_usuario'])){	
	$id_usuario = $_GET['id_usuario'];
	$sql = "SELECT * FROM compras WHERE id_usuario = '".$id_usuario."'";
	$consulta = $conexao->query($sql);
$dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);}
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
				<?php echo '<a class="btn btn-secondary border-danger m-2" href="us_opcoes.php?id_usuario='.$id_usuario.'">Voltar</a>'; ?>
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
	<h3 class="text-info">Opções do Usuários: </h3>
	</div>
	<div class="card-body">
	<h4 class="text">Compras realizadas pelo usuário: </h4>
	<h2>Compras com pagamento não confirmado</h2><hr>
<?php
if(isset($_GET['ver_pr_compra'])){
	$id_venda_lista = $_GET['ver_pr_compra'];
	$sql_10 = "SELECT * FROM itens_da_compra WHERE id_compra = '".$id_venda_lista."'";
	$consulta_10 = $conexao->query($sql_10);
	$dados_ab = $consulta_10->fetchALL(PDO::FETCH_ASSOC);
	
	echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Lista de produtos da compra de n°: "'.$id_venda_lista.'"</h3>
      </div>
      <div class="modal-body bg-light">';
		echo '<table class="table table-striped mt-2" border="3">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
}
if(isset($_GET['mensagem'])){
	$msg = $_GET['mensagem'];
	echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tudo certo!!!!</h3>
      </div>
      <div class="modal-body bg-light">
		<h5>'.$msg.'</h5>
	      
	</div>
      <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
}
if(isset($_GET['cancelar_compra'])){
	$id_compra_cancela = $_GET['cancelar_compra'];
echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header bg-danger">
        <h3 class="modal-title">Confirmação de cancelamento.</h3>
      </div>
      <div class="modal-body bg-light">
		<h5>Tem certeza que deseja excluir essa compra da sua lista?</h5>
	</div>
      <div class="modal-footer bg-light">
            <a class="btn btn-dark mt-2 " href="cancela_compra.php?cancelar_compra='.$id_compra_cancela.'&id_usuario='.$id_usuario.'">Cancelar Compra</a> 
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>

      </div>
    </div>
  </div>
</div>';
}






$cont=0;
foreach($dados_a as $d_1){
if($d_1['autorizado'] == 0){ $cont += 1;}
}
//puxando dados
if($cont > 0){
	  echo '<table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="8">Produtos do Carrinho</th>
                    </tr>
                    <tr>
                        <th>Id. da compra</th>
                        <th>Pagamento</th>
                        <th>Endereço</th>
                        <th>Data da compra</th>
                        <th>Pago</th>
                        <th>Entregue</th>
                        <th>Total da compra</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($dados_a as $d_2){
                $id_compra = $d_2['id_compra'];
		if($d_2['autorizado'] == 0 && $d_2['entregue'] == 0 ){
                $sql = "SELECT * FROM compras  WHERE id_compra = ?";
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id_compra));
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $data = $d_2['data'];
                $total= $d_2['total'];
                $autorizado= $d_2['autorizado'];
				if($autorizado == 0){ $pago = 'Não';
				}else{
					$pago = 'Sim';
				}
                $entregue= $dados['entregue'];
				if($entregue == 0){ $ent = 'Não';
				}else{
					$ent = 'Sim';
				}
				$pagamento= $d_2['pagamento'];
                $parcelas= $d_2['parcelas'];
				$id_endereco = $d_2['id_endereco'];
				$sqlend = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco."'";
				$consultaend = $conexao->query($sqlend);
				$dados_end = $consultaend->fetch(PDO::FETCH_ASSOC);
				$endereco = '<strong>R:</strong> '.$dados_end['logradouro'].' <strong>N°</strong> '.$dados_end['numero'].'<br><strong>B: </strong>'.$dados_end['bairro'].' <strong>Cidade:</strong> '.$dados_end['cidade'].'';
			    echo '<tr style="height: 110px">
                <td><P class="mt-4">'.$id_compra.'</P></td>
                <td><P class="mt-4">'.$pagamento.'</P></td>
                <td><P class="mt-4">'.$endereco.'</P></td>
                <td><P class="mt-4">'.date_format(new DateTime($data),"d/m/Y").'</P></td>
                <td><P class="mt-4">'.$pago.'</P></td>
                <td><P class="mt-4">'.$ent.'</P></td>
                <td><P class="mt-4"> R$: '.number_format($total,2,',','.').'</P></td>
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'&id_usuario='.$id_usuario.'">Ver Produtos</a>
                <a class="btn btn-dark mt-2 w-75" href="?cancelar_compra='.$id_compra.'&id_usuario='.$id_usuario.'">Cancelar Compra</a></td></tr>';
				}}}else{ echo '<h3 class="alert alert-secondary text-center">Nenhum produto pendente de aprovação de pagamento</h3>';}

	echo '</tbody></table>';
?>
<h2>Compras aguardando entrega</h2><hr>
<?php
$cont_ent=0;
foreach($dados_a as $d_1){
if($d_1['autorizado'] == 1 && $d_1['entregue'] == 0){ $cont_ent += 1;}
}
//puxando dados
if($cont_ent > 0){
	  echo '<table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="8">Produtos do Carrinho</th>
                    </tr>
                    <tr>
                        <th>Id. da compra</th>
                        <th>Pagamento</th>
                        <th>Endereço</th>
                        <th>Data da compra</th>
                        <th>Pago</th>
                        <th>Entregue</th>
                        <th>Total da compra</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($dados_a as $d_2){
		$id_compra = $d_2['id_compra'];
		if($d_2['autorizado'] == 1 && $d_2['entregue'] == 0 ){
                $sql = "SELECT * FROM compras WHERE id_compra = ?";
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id_compra));
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $data = $d_2['data'];
                $total= $d_2['total'];
                $autorizado= $d_2['autorizado'];
				if($autorizado == 0){ $pago = 'Não';
				}else{
					$pago = 'Sim';
				}
                $entregue= $dados['entregue'];
				if($entregue == 0){ $ent = 'Não';
				}else{
					$ent = 'Sim';
				}
				$pagamento= $d_2['pagamento'];
                $parcelas= $d_2['parcelas'];
				$id_endereco = $d_2['id_endereco'];
				$sqlend = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco."'";
				$consultaend = $conexao->query($sqlend);
				$dados_end = $consultaend->fetch(PDO::FETCH_ASSOC);
				$endereco = '<strong>R:</strong> '.$dados_end['logradouro'].' <strong>N°</strong> '.$dados_end['numero'].'<br><strong>B: </strong>'.$dados_end['bairro'].' <strong>Cidade:</strong> '.$dados_end['cidade'].'';
			    echo '<tr style="height: 110px">
                <td><P class="mt-4">'.$id_compra.'</P></td>
                <td><P class="mt-4">'.$pagamento.'</P></td>
                <td><P class="mt-4">'.$endereco.'</P></td>
                <td><P class="mt-4">'.date_format(new DateTime($data),"d/m/Y").'</P></td>
                <td><P class="mt-4">'.$pago.'</P></td>
                <td><P class="mt-4">'.$ent.'</P></td>
                <td><P class="mt-4"> R$: '.number_format($total,2,',','.').'</P></td>
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'&id_usuario='.$id_usuario.'">Ver Produtos</a>
                <a class="btn btn-dark mt-2 w-75" href="?cancelar_compra='.$id_compra.'&id_usuario='.$id_usuario.'">Cancelar Compra</a></td></tr>
';
				}}}else{ echo '<h3 class="alert alert-secondary text-center">Nenhum produto pendente de entrega</h3>';}

	echo '</tbody></table>';
	?>

<h2>Compras entregues</h2><hr>
<?php 
$cont_faturado=0;
foreach($dados_a as $d_1){
if($d_1['autorizado'] == 1 && $d_1['entregue'] == 1){ $cont_faturado += 1;}
}
//puxando dados
if($cont_faturado > 0){
	  echo '<table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="8">Produtos do Carrinho</th>
                    </tr>
                    <tr>
                        <th>Id. da compra</th>
                        <th>Pagamento</th>
                        <th>Endereço</th>
                        <th>Data da compra</th>
                        <th>Pago</th>
                        <th>Entregue</th>
                        <th>Total da compra</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>';
          
                foreach ($dados_a as $d_2){
		$id_compra = $d_2['id_compra'];
		if($d_2['autorizado'] == 1 && $d_2['entregue'] == 1 ){
                $sql = "SELECT * FROM compras WHERE id_compra = ?";
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id_compra));
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $data = $d_2['data'];
                $total= $d_2['total'];
                $autorizado= $d_2['autorizado'];
				if($autorizado == 0){ $pago = 'Não';
				}else{
					$pago = 'Sim';
				}
                $entregue= $dados['entregue'];
				if($entregue == 0){ $ent = 'Não';
				}else{
					$ent = 'Sim';
				}
				$pagamento= $d_2['pagamento'];
                $parcelas= $d_2['parcelas'];
				$id_endereco = $d_2['id_endereco'];
				$sqlend = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco."'";
				$consultaend = $conexao->query($sqlend);
				$dados_end = $consultaend->fetch(PDO::FETCH_ASSOC);
				$endereco = '<strong>R:</strong> '.$dados_end['logradouro'].' <strong>N°</strong> '.$dados_end['numero'].'<br><strong>B: </strong>'.$dados_end['bairro'].' <strong>Cidade:</strong> '.$dados_end['cidade'].'';
			    echo '<tr style="height: 110px">
                <td><P class="mt-4">'.$id_compra.'</P></td>
                <td><P class="mt-4">'.$pagamento.'</P></td>
                <td><P class="mt-4">'.$endereco.'</P></td>
                <td><P class="mt-4">'.date_format(new DateTime($data),"d/m/Y").'</P></td>
                <td><P class="mt-4">'.$pago.'</P></td>
                <td><P class="mt-4">'.$ent.'</P></td>
                <td><P class="mt-4"> R$: '.number_format($total,2,',','.').'</P></td>
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'&id_usuario='.$id_usuario.'">Ver Produtos</a>
                </td></tr>
';
				}}}else{ echo '<h3 class="alert alert-secondary text-center">Nenhuma compra efetuada ou entregue</h3>';}

	echo '</tbody></table>';
	?>

</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>	
	</div>
	</div>
	</div>