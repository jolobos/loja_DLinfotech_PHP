<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");
/*$CEP = $dados['CEP'];
$rua = $dados['logradouro'];
$bairro = $dados['bairro'];
$cidade = $dados['cidade'];
$UF = $dados['UF'];
$numero = $dados['numero'];
$complemento = $dados['complemento'];
$ponto_referencia = $dados['ponto_referencia'];
$retirada_com = $dados['retirada_com'];
$telefone_entrega = $dados['telefone_entrega'];
*/				


require_once'cabecalho.php';
?>
<div class="container" style="margin-top: 105px;">
<div class="card mb-3">
  <div class="row" >
    <div class="col-md-4">
      <img src="../img/entrega.jpg" class="img-fluid rounded m-3" style="height:90%;"alt="...">
    </div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title">Cadastro de endereço</h5>
		<form action="?endereco=ok" method="post">
			<div class="row">
			<div class="col-sm-6">
			<label>CEP:</label>
			<input type="text" class="form-control  mt-2" name="CEP" placeholder="Digite o seu CEP..." autofocus>
			<label>Rua:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite a sua rua..." autofocus>
			<label>Bairro:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o seu bairro..." autofocus>
			<label>Cidade:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite a sua cidade..." autofocus>
			<label>UF:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o seu estado..." autofocus>
			</div>
			<div class="col-sm-6">
			<label>Numero:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o seu numero..." autofocus>
			<label>complemento:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o seu complemento..." autofocus>
			<label>Ponto de referência:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o seu ponto de referência..." autofocus>
			<label>Responsável pela retirada:</label>
			<input type="text" class="form-control  mt-2" name="CEP" placeholder="Digite o responsável..." autofocus>
			<label>telefone para contato:</label>
			<input type="text" class="form-control mt-2" name="CEP" placeholder="Digite o telefone de contato..." autofocus>
			</div>
			</div>
		</form>
		<p class="card-text"></p>
      </div>
    </div>
  </div>
</div>
</div>

</div>