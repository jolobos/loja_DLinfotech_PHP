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
$dados = $consulta->fetch   (PDO::FETCH_ASSOC);
$id_cartao = $dados['id_cartao'];
		
if(!empty($_POST['id_endereco'])){
    $_SESSION['endereco'] = $_POST['id_endereco'];
    
}
//valores para mostrar...
$total = 0;
foreach($_SESSION['lista_produto'] as $id => $qtd){
$sql = "SELECT * FROM produtos WHERE id_produto = '".$id."'";
$consulta = $conexao->query($sql);
$dados = $consulta->fetch(PDO::FETCH_ASSOC);
$total += $dados['valor'] * $qtd;

}

require_once'cabecalho.php';

?>
<script type="text/javascript" src="chama_forma_pg.js"></script>
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
	<form action="pix/confirmacao_pix.php" method="POST"	<!--tags de pagamento -->
		<h5>Pagamento à vista.</h5>
                <p>Total: <?php echo 'R$ '.number_format($total,2,',','.'); ?></p>
		<div align="right">
		<input type="hidden"  name="confirma_pix" value="ok">
		<input type="hidden"  name="valor" <?php echo 'value="'.$total.'"'; ?> >
		<input type="submit" class="btn btn-secondary" value="Selecionar"> 
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
                <h5>Pagamento à vista ou parcelado a partir de R$ 20,00.</h5>
		<p>Total: <?php echo 'R$ '.number_format($total,2,',','.'); ?></p>
                <?php 
                echo '<strong>N° de parcelas: </strong></br>';
                    if($total >= 10 && $total <= 24.99 ){
                      echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">1X de R$ '.number_format($total,2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2X de R$ '.number_format(($total/2),2,'.',',').'</label>
                                  </div>';
                    }
                    if($total >=  25 && $total <= 49.99){
                       echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">1X de R$ '.number_format($total,2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2X de R$ '.number_format(($total/2),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3X de R$ '.number_format(($total/3),2,'.',',').'</label>
                                  </div>';
                    }
                    if($total >=  50 && $total <= 74.99){
                       echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">1X de R$ '.number_format($total,2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2X de R$ '.number_format(($total/2),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3X de R$ '.number_format(($total/3),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio4" value="4" >
                                    <label class="form-check-label" for="inlineRadio4">4X de R$ '.number_format(($total/4),2,'.',',').'</label>
                                  </div>
                                 ';
                    }
                    if($total >= 75 && $total <= 99.99){
                       echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">1X de R$ '.number_format($total,2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2X de R$ '.number_format(($total/2),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3X de R$ '.number_format(($total/3),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio4" value="4" >
                                    <label class="form-check-label" for="inlineRadio4">4X de R$ '.number_format(($total/4),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio5" value="5" >
                                    <label class="form-check-label" for="inlineRadio5">5X de R$ '.number_format(($total/5),2,'.',',').'</label>
                                  </div>'
                                  ;
                    }
                    if($total >= 100){
                        echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">1X de R$ '.number_format($total,2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2X de R$ '.number_format(($total/2),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio3" value="3">
                                    <label class="form-check-label" for="inlineRadio3">3X de R$ '.number_format(($total/3),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio4" value="4" >
                                    <label class="form-check-label" for="inlineRadio4">4X de R$ '.number_format(($total/4),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio5" value="5" >
                                    <label class="form-check-label" for="inlineRadio5">5X de R$ '.number_format(($total/5),2,'.',',').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="vezes" id="inlineRadio6" value="6" >
                                    <label class="form-check-label" for="inlineRadio6">6X de R$ '.number_format(($total/6),2,'.',',').'</label>
                                  </div>';

                    }                
                ?>
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
		<h5>Pagamento à vista.</h5>
                <p>Total: <?php echo 'R$ '.number_format($total,2,',','.'); ?></p>
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
                <h5>Formas de Pagamento.</h5>
                <?php 
                echo '<div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="entrega" id="inlineRadio1" value="pix_entrega" checked>
                                    <label class="form-check-label" for="inlineRadio1"><strong>PIX</strong></label>
                                    <label>À vista R$ '.number_format($dados['valor'],2,',','.').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="entrega" id="inlineRadio2" value="dinheiro_entrega">
                                     <label class="form-check-label" for="inlineRadio1"><strong>Dinheiro</strong></label>
                                    <label>À vista R$ '.number_format($dados['valor'],2,',','.').'</label>
                                  </div>
                                  <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="entrega" id="inlineRadio3" value="cartao_entrega">
                                    <label class="form-check-label" for="inlineRadio1"><strong>Cartão</strong></label> ';
                                    if($total >= 10 && $total <= 24.99 ){                                    
                                    echo '<label class="form-check-label" for="inlineRadio3">Até 2X de R$ '.number_format(($total/2),2,'.',',').'</label>';
                                        }
                                    if($total >= 25 && $total <= 49.99 ){                                    
                                    echo '<label class="form-check-label" for="inlineRadio3">Até 3X de R$ '.number_format(($total/3),2,'.',',').'</label>';
                                        }
                                    if($total >= 50 && $total <= 74.99 ){                                    
                                    echo '<label class="form-check-label" for="inlineRadio3">Até 4X de R$ '.number_format(($total/4),2,'.',',').'</label>';
                                        }
                                    if($total >= 75 && $total <= 99.99 ){                                    
                                    echo '<label class="form-check-label" for="inlineRadio3">Até 5X de R$ '.number_format(($total/5),2,'.',',').'</label>';
                                        }
                                    if($total >= 100){                                    
                                    echo '<label class="form-check-label" for="inlineRadio3">Até 6X de R$ '.number_format(($total/6),2,'.',',').'</label>';
                                        }
                                  echo '</div>';
                
              
                ?>
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