<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");
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
	$ok = $insercao->execute(array ($id_usuario,$CEP,$rua,$bairro,$cidade,$UF,$numero,$complemento,$ponto_referencia,$responsavel_retirada,$telefone_contato));
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

require_once'cabecalho.php';
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

<div class="container" style="margin-top: 105px;">
<div class="card mb-3">
  <div class="row" >
    <div class="col-md-4">
      <img src="../img/entrega.jpg" class="img-fluid rounded m-3" style="height:90%;"alt="...">
    </div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title">Cadastro de endereço</h5>
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
                    <a class="btn btn-danger mt-3 ms-3" href="endereco_compra.php">Voltar</a>
                    </div>
</form>
		<p class="card-text"></p>
      </div>
    </div>
  </div>
</div>
</div>

</div>