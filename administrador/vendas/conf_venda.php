<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

$id_usuario_1 = $_SESSION['id_usuario_1'];

if(!empty($_POST['esc_novo_end'])){
	unset($_SESSION['endereco']);
}
if(!empty($_POST['id_endereco'])){
	$_SESSION['endereco'] = $_POST['id_endereco'];
}

if(!isset($_SESSION['endereco'])){
if(isset($_SESSION['id_usuario_1'])){
	$sql2 = "SELECT * FROM endereco_usuario WHERE id_usuario = '".$id_usuario_1."'";
	$consulta2 = $conexao->query($sql2);
	$dados_a = $consulta2->fetchALL(PDO::FETCH_ASSOC);
	if(!empty($dados_a)){
		$endereco = true;
	}else{
		$endereco = false;
	}
}
}
if(!empty($_POST['CEP']) && !empty($_POST['numero']) && !empty($_POST['telefone_contato'] )){
$CEP = $_POST['CEP'];
$rua = $_POST['logradouro'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
if($_POST['UF'] == 'Rio Grande do Sul'){
$UF = 'RS';}else{$UF='';}
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$ponto_referencia = $_POST['ponto_referencia'];
$responsavel_retirada = $_POST['responsavel_retirada'];
$telefone_contato = $_POST['telefone_contato'];

    $sql ='INSERT INTO endereco_usuario(id_usuario,CEP,logradouro,bairro,cidade,UF,numero,complemento,ponto_referencia,retirada_com,telefone_entrega)
    values(?,?,?,?,?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario1,$CEP,$rua,$bairro,$cidade,$UF,$numero,$complemento,$ponto_referencia,$responsavel_retirada,$telefone_contato));
    }catch(PDOException $r){
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
if ($ok){
    $msg = 'Endereço cadastrado com sucesso!!!';
    header('location:endereco_compra.php?mensagem='.$msg);
}else{
    echo  '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h3 class="modal-title">Erro...</h3>
      </div>
      <div class="modal-body bg-light">
        <h5>Lamento, alguma informação não foi adicionada corretamente ao banco de dados.</h5>
        <h5>Tente novamente.</h5>
        <h5>'.$r.'.</h5>
      </div>
      <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
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
    <script type="text/javascript" src="func_pr.js"></script>


</head>
<body style="background: #778899">
<div class="container">
	<div class="card mt-2">
        <div class="card-header">
		
		<div class="row">
		<div class="col">
		<h3 class="text-info">Confirme os dados para concluir a venda</h3>
		</div>
		<div class="col" align="right">
		<a class="btn btn-dark border-danger" href="select_prod.php">Voltar</a>
		</div>
		</div>
		
		</div>
		<div class="card-body">
		<h3 class="text-info">Lista dos produtos</h3>
		<?php
		$total_venda = 0;
			if(!empty($_SESSION['produto_carrinho'])){
				echo '<table  border="3" class="table table-striped border-secondary" style="table-layout: fixed;width:100%">
                <thead style="display: block;position: relative;" class="border">
                    <tr align="center">
                        <th colspan="7">Produtos do Carrinho</th>
                    </tr>
                    <tr>
                        <th width="160">Código do produto</th>
                        <th width="140">Foto do produto </th>
                        <th width="450">Produto</th>
                        <th width="100">Valor</th>
                        <th width="100">Disponível</th>
                        <th width="100">Quantidade</th>
                        <th width="205">valor somado</th>
                    </tr>
                </thead>
                <tbody style="display: block;  overflow: auto;width: 100%;max-height: 300px;overflow-y: scroll;overflow-x: hidden;">';
                foreach ($_SESSION['produto_carrinho'] as $id => $qtd) {
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
                $foto_pr= $dados['foto'];
                echo '<tr style="height: 110px">
                <td  width="160"><P style="margin-top: 40px">'.$cod_produto.'</P></td>
                <td  width="140" align="center"><img style="width:100px "src="../../img/produtos/'.$foto_pr.'"></td>
                <td width="450"><P style="margin-top: 40px">'.$nome.'</P></td>
                <td  width="100"><P style="margin-top: 40px">R$: '. number_format($valor,2,',','.').'</P></td>
                <td  width="100"><P style="margin-top: 40px">'.$quantidade.' Un</P></td>
                <td width="100"><P style="margin-top: 40px">'.$qtd.' Un</P></td>
                <td width="190"><P style="margin-top: 40px"> R$: '.number_format($somado,2,',','.').'</P></td></tr>';
				$total_venda += $somado;
			}
			echo '
			</tbody></table>';
			echo '
			<div class="row">
			<div class="col">
			<table><thead>
			<tr><th>Total da venda</th><td>R$ '.number_format($total_venda,2,',','.').'</td></tr>
			</thead></table>
			</div>
			<div class="col-sm-3">
				<form method="POST">
				<input type="submit" class="btn btn-success" value="Concluir Venda" />
				</fom>
			</div>
			</div>
			';
			

			}
		?>
		<hr>
		<h3 class="text-info">Local de entrega</h3>
			<?php
				if(isset($_SESSION['endereco'])){
					$id_endereco_esc = $_SESSION['endereco'];
					$sql3 = "SELECT * FROM endereco_usuario WHERE id_endereco = '".$id_endereco_esc."'";
					$consulta3 = $conexao->query($sql3);
					$d3 = $consulta3->fetch(PDO::FETCH_ASSOC);	
					
					
					echo '<div class="card">
							<div class="card-body">
							<div class="row">
							<div class="col">
						<label class="form-check-label" for="flexRadioDefault1">
							<strong>CEP:</strong> '.$d3['CEP'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Rua:</strong> '.$d3['logradouro'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Bairro:</strong> '.$d3['bairro'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Cidade:</strong> '.$d3['cidade'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> UF:</strong> '.$d3['UF'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> n°:</strong> '.$d3['numero'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Complemento:</strong> '.$d3['complemento'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Ponto de referência:</strong> '.$d3['ponto_referencia'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Responsável pela retirada:</strong> '.$d3['retirada_com'].' 
						</label>
							  <label class="form-check-label" for="flexRadioDefault1">
							  <strong> Telefone de contato:</strong> '.$d3['telefone_entrega'].' 
						</label>
								</div>
								<div class="col-sm-1">
								<form method="POST">
								<input type="hidden" name="esc_novo_end" value="1">
								<input type="submit" class="btn btn-dark" value="Trocar">
								</form>
								</div>
								
								</div>
								</div>
								</div>
								';
				
				}
			?>
		</div>
	</div>
</div>
</body>
<?php

if(isset($endereco) && $endereco == false){
	echo    '<div class="modal fade modal-xl" id="exemplomodal">
				<div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
					  <h5>Escolha um endereço para entrega</h5>
					  </div>
					  <div class="modal-body bg-white">
					  <h5> Insira um endereço para entrega dos produtos:</h5>
					  <form action="" method="post">
						<div class="row">
						<div class="col-sm-6">
						<label>CEP:</label>
						<input class="form-control  mt-2" name="CEP" id="cep" title="Ex: 00000-000" pattern="([0-9]{5})-([0-9]{3})"placeholder="Digite o seu CEP..." required autofocus>
						<label>Rua:</label>
						<input type="text" class="form-control mt-2" name="logradouro" placeholder="Digite a sua rua..." required>
						<label>Bairro:</label>
						<input type="text" class="form-control mt-2" name="bairro" placeholder="Digite o seu bairro..." required>
						<label>Cidade:</label>
						<input type="text" class="form-control mt-2" name="cidade" placeholder="Digite a sua cidade..." required>
						<label>UF:</label>
									<input type="text" class="form-control mt-2" name="UF" placeholder="Digite o seu estado..." value="Rio Grande do Sul" >
						</div>
						<div class="col-sm-6">
						<label>Numero:</label>
									<input type="text" class="form-control mt-2" name="numero" title="Ex: 123" required pattern="([0-9]{1,})" placeholder="Digite o seu numero..." >
						<label>complemento:</label>
						<input type="text" class="form-control mt-2" name="complemento" placeholder="Digite o seu complemento..." >
						<label>Ponto de referência:</label>
						<input type="text" class="form-control mt-2" name="ponto_referencia" placeholder="Digite o seu ponto de referência..." >
						<label>Responsável pela retirada:</label>
						<input type="text" class="form-control  mt-2" name="responsavel_retirada" placeholder="Digite o responsável..." required>
						<label>telefone para contato:</label>
						<input type="tel" class="form-control mt-2 sp_celphones" name="telefone_contato" title="Ex: (00) 00000-0000" pattern="(.([0-9]{2}.))\s([9]{1})?([0-9]{4})-([0-9]{4})" placeholder="Digite o telefone de contato..." required >
						</div>
						</div>
								<div align="center">
								<input class="btn btn-primary mt-3 " type="submit" value="Salvar">
								<a class="btn btn-danger mt-3 ms-3" href="select_prod.php">Voltar</a>
								</div>
					  </form>
					  </div>
					  <div class="modal-footer bg-light">
					  
					  </div>
					 </div>
				</div>
			</div>
					  
					  
					  ';
	
}

if(isset($endereco) && $endereco == true){
$sql2 = "SELECT * FROM endereco_usuario WHERE id_usuario = '".$id_usuario_1."'";
$consulta2 = $conexao->query($sql2);
$dados_a = $consulta2->fetchALL(PDO::FETCH_ASSOC);	
echo    '<div class="modal fade modal-xl" id="exemplomodal">
				<div class="modal-dialog">
					<div class="modal-content ">
					  <div class="modal-header bg-info">
					  <h5>Escolha um endereço para entrega</h5>
					  </div>
					  <div class="modal-body bg-white">';
					  
echo '<form method="POST">';
                    $checked = 1;
                    foreach($dados_a as $d){
					if($checked == 1){ 
                    $checked_show = 'checked';
                    }else{
                    $checked_show = '';
                    }
                    $checked +=1;
							
		echo '<div class="form-check">
		  <input class="form-check-input" type="radio" name="id_endereco" value="'.$d['id_endereco'].'" '.$checked_show.'>
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
		</div><hr/>
                ';
                }		
	echo ' </div>
					  <div class="modal-footer bg-light">
						<a class="btn btn-secondary" href="cadastro_endereco.php">Novo endereço</a>
						<input type="submit" class="btn btn-info" value="Continuar" >
						</form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>


<script type="text/javascript">
$(document).ready(function () { 
        var $campo = $("#cep");
        $campo.mask('00000-000', {reverse: true});
       });
</script>
<script>
$(document).ready(function(){
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.sp_celphones').mask(SPMaskBehavior, spOptions);
});
</script>
