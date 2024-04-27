<?php
require_once('../verifica_session.php');
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");


if(isset($_GET['concluido_compra'])){
	unset($_SESSION['endereco']);
	unset($_SESSION['lista_produto']);
	unset($_SESSION['ultimo_visto']);
	unset($_SESSION['produto_carrinho']);
        if($_GET['concluido_compra'] == 'ok'){
        header('location:../index.php?mensagem_compra=ok');
        
        }else{
                header('location:../index.php?mensagem_compra=falho');
    
        }
}

if(isset($_GET['cancela_venda'])){
	$_SESSION['produto_carrinho'] = $_SESSION['lista_produto'];
	unset($_SESSION['endereco']);
	unset($_SESSION['lista_produto']);
	header('location:../../produtos/ver_carrinho.php?mensagem_cancela=ok');
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/modal.css">
</head>
<body>
<div class="container mt-5">
    <h3 class="alert alert-success text-center">Confirmação da compra</h3>
    <h3 class="text-info">Produtos</h3><hr/>
    <div>
        <table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="7">Produtos do Escolhidos</th>
                    </tr>
                    <tr>
                        <th>Código do produto</th>
                        <th>Foto do produto </th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                        <th>valor somado</th>
                        
                    </tr>
                </thead>
                <tbody>
        <?php
                $total_somado = 0;
                foreach ($_SESSION['lista_produto'] as $id => $qtd) {
                $sql = "SELECT * FROM produtos WHERE id_produto = ?";
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id));
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $cod_produto = $dados['cod_produto'];
                $nome = $dados['nome'];
                $valor= $dados['valor'];
                $quantidade= $dados['quantidade'];
                if($qtd > $quantidade){
                     $_SESSION['produto_carrinho'][$id] -=1;

                }
                $somado = $valor * $qtd;
                $total_somado += $somado;
                $foto_pr= $dados['foto'];
                echo '<tr style="height: 110px">
                <td><P style="margin-top: 40px">'.$cod_produto.'</P></td>
                <td><img style="width:100px "src="../img/produtos/'.$foto_pr.'"> </td>
                <td width="400"><P style="margin-top: 40px">'.$nome.'</P></td>
                <td><P style="margin-top: 40px">R$: '. number_format($valor,2,',','.').'</P></td>
                <td><P style="margin-top: 40px">'.$qtd.' Un</P></td>
                <td><P style="margin-top: 40px"> R$: '.number_format($somado,2,',','.').'</P></td></tr>
                ';
                }
                echo '<tr align="right">
                        <td colspan="7"><strong>Total em compras:</strong> R$ '.number_format($total_somado,2,',','.').'</td>
                    </tr></tbody></table>';
        ?>
    <h3 class="text-info">Endereço de entrega</h3><hr/>
       
<?php
$id_endereco = $_SESSION['endereco'];
$sql2 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco."'";
$consulta2 = $conexao->query($sql2);
$d = $consulta2->fetch(PDO::FETCH_ASSOC);


$CEP = $d['CEP'];
$rua = $d['logradouro'];
$bairro = $d['bairro'];
$cidade = $d['cidade'];
$UF = $d['UF'];
$numero = $d['numero'];
$complemento = $d['complemento'];
$ponto_referencia = $d['ponto_referencia'];
$retirada_com = $d['retirada_com'];
$telefone_entrega = $d['telefone_entrega'];

							
echo '<div class="form-check">
<label class="form-check-label" for="flexRadioDefault1">
<strong>CEP:</strong> '.$d['CEP'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Rua:</strong> '.$d['logradouro'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Bairro:</strong> '.$d['bairro'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Cidade:</strong> '.$d['cidade'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> UF:</strong> '.$d['UF'].' 
</label></br>
<label class="form-check-label" for="flexRadioDefault1">
<strong> n°:</strong> '.$d['numero'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Complemento:</strong> '.$d['complemento'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Ponto de referência:</strong> '.$d['ponto_referencia'].' 
</label></br>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Responsável pela retirada:</strong> '.$d['retirada_com'].' 
</label>
<label class="form-check-label" for="flexRadioDefault1">
<strong> Telefone de contato:</strong> '.$d['telefone_entrega'].' 
</label>
</div><br><hr>
';
?>
    <h3 class="text-info">Modo de pagamento na entrega</h3><hr/>
<?php
if(isset($_POST['entrega'])){
	$escolha = $_POST['entrega'];
	if($escolha == 'pix'){
		echo '
<h3>OBSERVAÇÕES - PIX</h3>
<h5>Confirmação de pagamento</h5>
<p>Salientamos que o pagamento via entrega na modalidade PIX deve ser feita no ato do recebimento do produto, 
sua compra fica em modo de espera para conclusão, até o entregador confirmar o pagamento e a entrega do produto em mãos do cliente. </p>
<h5>Tempo de entrega</h5>
<p>O prazo médio de entrega para toda a região metropolitana é de aproximadamente 24 horas, a partir da confirmação de pagamento, podendo se estender no máximo até 48 horas.
Caso a entrega não seja concluida dentro do prazo máximo da empresa, o cliente pode estar requerendo o estorno de pagamento dos produtos.</p>
<h5>Conclusão da compra</h5>
<p> Ao clicar em "concluir compra", você receberá em sua tela uma mensagem de confirmação da compra. Após isso você terá a opção de retorno a tela principal, ou de visualizar
as suas compras.</p>

<form action="" method="POST" align="center" class="mb-5">
<input type="hidden" name="confirma_'.$escolha.'" value="ok">
<a href="?cancela_venda=1" class="btn btn-secondary">Cancelar a Compra</a>
<input type="submit" class="btn btn-success" value="Concluir Compra">
</form>
		';
	}
	if($escolha == 'dinheiro'){
		echo '
<h3>OBSERVAÇÕES - DINHEIRO</h3>
<h5>Confirmação de pagamento</h5>
<p>Salientamos que o pagamento via entrega na modalidade DINHEIRO deve ser feita no ato do recebimento do produto, 
sua compra fica em modo de espera para conclusão, até o entregador confirmar o pagamento e a entrega do produto em mãos do cliente. </p>
<h5>Tempo de entrega</h5>
<p>O prazo médio de entrega para toda a região metropolitana é de aproximadamente 24 horas, a partir da confirmação de pagamento, podendo se estender no máximo até 48 horas.
Caso a entrega não seja concluida dentro do prazo máximo da empresa, o cliente pode estar requerendo o estorno de pagamento dos produtos.</p>
<h5>Conclusão da compra</h5>
<p> Ao clicar em "concluir compra", você receberá em sua tela uma mensagem de confirmação da compra. Após isso você terá a opção de retorno a tela principal, ou de visualizar
as suas compras.</p>

<form action="" method="POST" align="center" class="mb-5">
<input type="hidden" name="confirma_'.$escolha.'" value="ok">
<a href="?cancela_venda=1" class="btn btn-secondary">Cancelar a Compra</a>
<input type="submit" class="btn btn-success" value="Concluir Compra">
</form>';
	}
	if($escolha == 'cartao'){
		echo '
<h3>OBSERVAÇÕES - CARTÃO</h3>
<h5>Confirmação de pagamento</h5>
<p>Salientamos que o pagamento via entrega na modalidade CARTÃO deve ser feita no ato do recebimento do produto, 
sua compra fica em modo de espera para conclusão, até o entregador confirmar o pagamento e a entrega do produto em mãos do cliente. </p>
<h5>Tempo de entrega</h5>
<p>O prazo médio de entrega para toda a região metropolitana é de aproximadamente 24 horas, a partir da confirmação de pagamento, podendo se estender no máximo até 48 horas.
Caso a entrega não seja concluida dentro do prazo máximo da empresa, o cliente pode estar requerendo o estorno de pagamento dos produtos.</p>
<h5>Conclusão da compra</h5>
<p> Ao clicar em "concluir compra", você receberá em sua tela uma mensagem de confirmação da compra. Após isso você terá a opção de retorno a tela principal, ou de visualizar
as suas compras.</p>

<form action="" method="POST" align="center" class="mb-5">
<input type="hidden" name="confirma_'.$escolha.'" value="ok">
<a href="?cancela_venda=1" class="btn btn-secondary">Cancelar a Compra</a>
<input type="submit" class="btn btn-success" value="Concluir Compra">
</form>
';
	}
}

?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>   
 <?php
 if(isset($_POST['confirma_pix'])){
    $data = date('Y-m-d H:i:s');
    $autorizado = 0;
    $pagamento = 'PIX';
    $parcelas = 1;
    $id_endereco = $_SESSION['endereco']; 
    $sql ='INSERT INTO compras (id_usuario,id_endereco,data,total,autorizado,pagamento,parcelas)
    values(?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario,$id_endereco,$data,$total_somado,$autorizado,$pagamento,$parcelas));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
     
     
    if($ok){
        $sqld = "SELECT id_compra,data FROM compras WHERE id_compra ORDER BY id_compra DESC LIMIT 0,1";
        $consulta = $conexao->query($sqld);
        $dadosd = $consulta->fetch(PDO::FETCH_ASSOC);
        $id_compras = $dadosd['id_compra'];
        $data_item = date('Y-m-d H:i:s');
        foreach ($_SESSION['lista_produto'] as $id => $qtd) {
            $sql ='INSERT INTO itens_da_compra (id_compra,id_produto,quantidade,data_item)
            values(?,?,?,?)';
            try {
                $insercao = $conexao->prepare($sql);
                $ok_a = $insercao->execute(array ($id_compras,$id,$qtd,$data_item));
            }catch(PDOException $r){
        //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                $ok_a = False;
            }catch (Exception $r){//todos as exceções
                $ok_a= False; 
            }
 
        }
    if($ok_a){
	 echo '
 <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info"> 
		<h3>Compra efetuada com sucesso!!!!</h3> 
      </div>';
echo '

      <div class="modal-footer bg-light">
			<a href="?concluido_compra=ok" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
  </div>
</div>';       
       
 }else{
     echo ' <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">   
      <h2>Erro!!!!</h2></div>
      <div class="modal-body">
      <p>Lamento, a compra não pode ser efetuada por um erro de comunicação com o banco de dados.</p>
      <p>Por favor, escolha uma das opções abaixo e tente novamente mais tarde. Obrigado!.</p>';
      //<p>'.$r.'<p>
      echo '</div>
      <div class="modal-footer bg-light">
			<a href="?concluido_compra=falho" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
';
     
 }
 }
 }
if(isset($_POST['confirma_dinheiro'])){
    $data = date('Y-m-d H:i:s');
    $autorizado = 0;
    $pagamento = 'DINHEIRO';
    $parcelas = 1;
    $id_endereco = $_SESSION['endereco']; 
    $sql ='INSERT INTO compras (id_usuario,id_endereco,data,total,autorizado,pagamento,parcelas)
    values(?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario,$id_endereco,$data,$total_somado,$autorizado,$pagamento,$parcelas));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
     
     
    if($ok){
        $sqld = "SELECT id_compra,data FROM compras WHERE id_compra ORDER BY id_compra DESC LIMIT 0,1";
        $consulta = $conexao->query($sqld);
        $dadosd = $consulta->fetch(PDO::FETCH_ASSOC);
        $id_compras = $dadosd['id_compra'];
        $data_item = date('Y-m-d H:i:s');
        foreach ($_SESSION['lista_produto'] as $id => $qtd) {
            $sql ='INSERT INTO itens_da_compra (id_compra,id_produto,quantidade,data_item)
            values(?,?,?,?)';
            try {
                $insercao = $conexao->prepare($sql);
                $ok_a = $insercao->execute(array ($id_compras,$id,$qtd,$data_item));
            }catch(PDOException $r){
        //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                $ok_a = False;
            }catch (Exception $r){//todos as exceções
                $ok_a= False; 
            }
 
        }
    if($ok_a){
	 echo '
 <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info"> 
		<h3>Compra efetuada com sucesso!!!!</h3> 
      </div>';
echo '

      <div class="modal-footer bg-light">
			<a href="?concluido_compra=ok" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
  </div>
</div>';       
       
 }else{
     echo ' <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">   
      <h2>Erro!!!!</h2></div>
      <div class="modal-body">
      <p>Lamento, a compra não pode ser efetuada por um erro de comunicação com o banco de dados.</p>
      <p>Por favor, escolha uma das opções abaixo e tente novamente mais tarde. Obrigado!.</p>';
      //<p>'.$r.'<p>
      echo '</div>
      <div class="modal-footer bg-light">
			<a href="?concluido_compra=falho" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
';
     
 }
 }
 }
if(isset($_POST['confirma_cartao'])){
    $data = date('Y-m-d H:i:s');
    $autorizado = 0;
    $pagamento = 'CARTAO';
    $parcelas = 1;
    $id_endereco = $_SESSION['endereco']; 
    $sql ='INSERT INTO compras (id_usuario,id_endereco,data,total,autorizado,pagamento,parcelas)
    values(?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario,$id_endereco,$data,$total_somado,$autorizado,$pagamento,$parcelas));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
     
     
    if($ok){
        $sqld = "SELECT id_compra,data FROM compras WHERE id_compra ORDER BY id_compra DESC LIMIT 0,1";
        $consulta = $conexao->query($sqld);
        $dadosd = $consulta->fetch(PDO::FETCH_ASSOC);
        $id_compras = $dadosd['id_compra'];
        $data_item = date('Y-m-d H:i:s');
        foreach ($_SESSION['lista_produto'] as $id => $qtd) {
            $sql ='INSERT INTO itens_da_compra (id_compra,id_produto,quantidade,data_item)
            values(?,?,?,?)';
            try {
                $insercao = $conexao->prepare($sql);
                $ok_a = $insercao->execute(array ($id_compras,$id,$qtd,$data_item));
            }catch(PDOException $r){
        //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                $ok_a = False;
            }catch (Exception $r){//todos as exceções
                $ok_a= False; 
            }
 
        }
    if($ok_a){
	 echo '
 <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info"> 
		<h3>Compra efetuada com sucesso!!!!</h3> 
      </div>';
echo '

      <div class="modal-footer bg-light">
			<a href="?concluido_compra=ok" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
  </div>
</div>';       
       
 }else{
     echo ' <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">   
      <h2>Erro!!!!</h2></div>
      <div class="modal-body">
      <p>Lamento, a compra não pode ser efetuada por um erro de comunicação com o banco de dados.</p>
      <p>Por favor, escolha uma das opções abaixo e tente novamente mais tarde. Obrigado!.</p>';
      //<p>'.$r.'<p>
      echo '</div>
      <div class="modal-footer bg-light">
			<a href="?concluido_compra=falho" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
';
     
 }
 }
 }

?>      
