<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once("../database.php");

$sql = "SELECT * FROM compras WHERE id_usuario = '".$id_usuario."'";
$consulta = $conexao->query($sql);
$dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);


require_once 'cabecalho.php';

if(isset($_GET['ver_pr_compra'])){
	$id_venda_lista = $_GET['ver_pr_compra'];
        $sql_90 = "SELECT id_compra,pagamento FROM compras WHERE id_compra = '".$id_venda_lista."'";
	$consulta_90 = $conexao->query($sql_90);
	$dados_90 = $consulta_90->fetch(PDO::FETCH_ASSOC);
	      
        
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
                <td><img style="width:100px "src="../img/produtos/'.$foto_pr.'"> </td>
                <td width="400"><P style="margin-top: 40px">'.$nome.'</P></td>
                <td><P style="margin-top: 40px; width: 70px">R$: '. number_format($valor,2,',','.').'</P></td>
                <td><P style="margin-top:40px ; width: 70px">'.$quantidade.' Un</P></td>
                <td><P style="margin-top: 40px; width: 70px"> R$: '.number_format($total,2,',','.').'</P></td></tr>';
	
	}        
        
      echo '<tr><td align="right" colspan="6"><P >Total R$: '.number_format($total_somado,2,',','.').'</P></td></tr>
        </tbody></table></div>';
      if($dados_90['pagamento'] == 'PIX' && isset($_GET['lib'])){
        echo '<div class="modal-footer bg-light">
                <a class="btn btn-primary" href="../conclui_venda/pix/ver_pix.php?valor='.$total_somado.'" target="_blank">Gerar PIX</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>';
        }elseif ($dados_90['pagamento'] == 'BOLETO' && isset($_GET['lib'])) {
        echo '<div class="modal-footer bg-light">
                <a class="btn btn-primary" href="../conclui_venda/boleto/ver_boleto.php?valor='.$total_somado.'" target="_blank">Gerar Boleto</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>';
    }else{
        echo '<div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>';
    }
      echo '</div>
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
            <a class="btn btn-dark mt-2 " href="cancela_compra.php?cancelar_compra='.$id_compra_cancela.'">Cancelar Compra</a> 
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>

      </div>
    </div>
  </div>
</div>';
}
?>
<div class="container" style="margin-top:105px">
<h2>Compras com pagamento não confirmado</h2><hr>
<?php
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
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'&lib=ok">Ver Produtos</a>
                <a class="btn btn-dark mt-2 w-75" href="?cancelar_compra='.$id_compra.'">Cancelar Compra</a></td></tr>
';
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
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'">Ver Produtos</a>
                <a class="btn btn-dark mt-2 w-75" href="?cancelar_compra='.$id_compra.'">Cancelar Compra</a></td></tr>
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
                <td><a class="btn btn-success w-75 mt-2" href="?ver_pr_compra='.$id_compra.'">Ver Produtos</a>
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