<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");
if(isset($_POST['id_endereco']) && isset($_SESSION['lista_produto'])){
		$_SESSION['id_endereco'] = $_POST['id_endereco'];
}
$sql = "SELECT * FROM cartao_usuario WHERE id_usuario = '".$id_usuario."'";
$consulta = $conexao->query($sql);
$dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
		
require_once'cabecalho.php';



?>
<div class="container" style="margin-top:105px">
	<h4 class="alert alert-info" align="center">Escolha a forma de pagamento dos produtos</h4>
<div class="card mb-3">
  <div class="row" >
    <div class="col-md-4">
      <img src="../img/home-hero-img.svg" class="img-fluid rounded m-3" alt="...">
    </div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title">Formas de pagamento</h5>
<!--Começo do acordião -->

<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
<form action="" method="POST">
        <div class="form-check" data-toggle="collapse" data-target="#collapseOne">
		  <input  type="hidden"  name="pix" value="1" >
		  <label class="form-check-label"  >
                  <strong>PIX</strong> 
		  </label>
	  </div>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
		<!--tags de pagamento -->
		<h5>Pagamento a vista.</h5>
		<p>Total: <?php echo 'R$ '; ?></p>
		<div align="right">
		<input type="submit" class="btn btn-secondary" value="selecionar">
		</div>
</form>
      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
<form action="" method="POST">
		<div class="form-check"data-toggle="collapse" data-target="#collapseTwo" >
		  <input type="hidden" name="cartao" value="2" >
		  <label class="form-check-label">
                  <strong>CARTÃO</strong> 
		  </label>
	  </div>
	</h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
		<!--tags de pagamento -->
		<div align="right">
		<input type="submit" class="btn btn-secondary" value="selecionar">
		</div>
</form>
      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
<form action="" method="POST">
		<div class="form-check"data-toggle="collapse" data-target="#collapseThree">
		  <input class="form-check-input" type="hidden"  name="boleto" value="3" >
		  <label class="form-check-label" >
                  <strong>BOLETO</strong> 
		  </label>
	  </div>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
		<!--tags de pagamento -->
		<div align="right">
		<input type="submit" class="btn btn-secondary" value="selecionar">
		</div>
</form>
      </div>
    </div>
  </div>
<div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
<form action="" method="POST">
		<div class="form-check" data-toggle="collapse" data-target="#collapseFour">
		  <input class="form-check-input" type="hidden"  name="entrega" value="4" >
		  <label class="form-check-label" >
                  <strong>NA ENTREGA</strong> 
		  </label>
	  </div>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
		<!--tags de pagamento -->
		<div align="right">
		<input type="submit" class="btn btn-secondary" value="selecionar">
		</div>
</form>
      
      </div>
    </div>
  </div>
</div>
<!-- Fim do acordião -->
</div>
</div>
</div>
</div>
</div>
	
<?php
if(!empty($_POST['pix'])){
	echo $_POST['pix'];
}
if(!empty($_POST['boleto'])){
	echo $_POST['boleto'];
}
if(!empty($_POST['entrega'])){
	echo $_POST['entrega'];
}
if(!empty($_POST['cartao'])){
	echo $_POST['cartao'];
}

?>