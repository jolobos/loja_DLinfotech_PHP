<?php
require_once('../../verifica_session.php');
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../../database.php");
if(isset($_GET['concluido_compra'])){
	unset($_SESSION['endereco']);
	unset($_SESSION['lista_produto']);
	unset($_SESSION['ultimo_visto']);
	unset($_SESSION['produto_carrinho']);
	header('location:../../index.php?mensagem_compra=ok');
}
if(isset($_GET['cancela_venda'])){
	$_SESSION['produto_carrinho'] = $_SESSION['lista_produto'];
	unset($_SESSION['endereco']);
	unset($_SESSION['lista_produto']);
	header('location:../../produtos/ver_carrinho.php?mensagem_cancela=ok');
}

if(!empty($_POST['confirma_pix'])){
   $chave_pix="02351055039";
   $beneficiario_pix="JOSIAS SANTOS DE AZEVEDO";
   $cidade_pix="CACHOEIRINHA";
   $identificador="***";
   $descricao="Demo phpQRCodePix";
   $gerar_qrcode=true;

if (is_numeric($_POST["valor"])){
   $valor_pix=preg_replace("/[^0-9.]/","",$_POST["valor"]);
}
else {
   $valor_pix="0.00";
}}
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
<script src="https://kit.fontawesome.com/0f8eed42e7.js" crossorigin="anonymous"></script>
<script>
function copiar() {
  var copyText = document.getElementById("brcodepix");
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */
  document.execCommand("copy");
  document.getElementById("clip_btn").innerHTML='<i class="fas fa-clipboard-check"></i> - Copiado';
}
function reais(v){
    v=v.replace(/\D/g,"");
    v=v/100;
    v=v.toFixed(2);
    return v;
}
function mascara(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1);
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E6M96X7Y2Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-E6M96X7Y2Y');
</script>
<?php

if ($gerar_qrcode){
   include "phpqrcode/qrlib.php"; 
   include "funcoes_pix.php";
   $px[00]="01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
   // Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
   //$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez. 
   $px[26][00]="br.gov.bcb.pix"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
   $px[26][01]=$chave_pix;
   if (!empty($descricao)) {
      /* 
      Não é possível que a chave pix e infoAdicionais cheguem simultaneamente a seus tamanhos máximos potenciais.
      Conforme página 15 do Anexo I - Padrões para Iniciação do PIX  versão 1.2.006.
      */
      $tam_max_descr=99-(4+4+4+14+strlen($chave_pix));
      if (strlen($descricao) > $tam_max_descr) {
         $descricao=substr($descricao,0,$tam_max_descr);
      }
      $px[26][02]=$descricao;
   }
   $px[52]="0000"; //Merchant Category Code “0000” ou MCC ISO18245
   $px[53]="986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
   if ($valor_pix > 0) {
      // Na versão 1.2.006 do Anexo I - Padrões para Iniciação do PIX estabelece o campo valor (54) como um campo opcional.
      $px[54]=$valor_pix;
   }
   $px[58]="BR"; //“BR” – Código de país ISO3166-1 alpha 2
   $px[59]=$beneficiario_pix; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
   $px[60]=$cidade_pix; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
   $px[62][05]=$identificador;
//   $px[62][50][00]="BR.GOV.BCB.BRCODE"; //Payment system specific template - GUI
//   $px[62][50][01]="1.2.006"; //Payment system specific template - versão
   $pix=montaPix($px);
   $pix.="6304"; //Adiciona o campo do CRC no fim da linha do pix.
   $pix.=crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.
   $linhas=round(strlen($pix)/120)+1;
}?>

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
                <td><img style="width:100px "src="../../img/produtos/'.$foto_pr.'"> </td>
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

<h3 class="text-info">Confirmação da compra via pix</h3><hr/>
<h3>OBSERVAÇÕES</h3>
<h5>Confirmação de pagamento</h5>
<p>Salientamos que devido à necessidade de confirmação do meio de pagamento via pix junto ao finaceiro, 
sua compra fica em modo de espera para conclusão, tendo uma espera máxima de 24 horas a partir do momento de efetuação
da compra, após a confirmação do pagamento, seu pedido é passado para a área de logística da empresa, 
ficando responsável pela entrega do produto. </p>
<h5>Tempo de entrega</h5>
<p>O prazo médio de entrega para toda a região metropolitana é de aproximadamente 24 horas, a partir da confirmação de pagamento, podendo se estender no máximo até 48 horas.
Caso a entrega não seja concluida dentro do prazo máximo da empresa, o cliente pode estar requerendo o estorno de pagamento dos produtos.</p>
<h5>Conclusão da compra</h5>
<p> Ao clicar em "concluir compra", você receberá em sua tela o código pix para copiar, ou ler o QRCode. Após isso você terá a opção de retorno a tela principal, ou de visualizar
as suas compras.</p>

<form action="" method="POST" align="center" class="mb-5">
<input type="hidden" name="confirma_qrcode" value="true">
<input type="hidden" name="valor" value="<?php $_POST['valor'] ?>">
<input type="hidden" name="confirma_pix" value="ok">
<a href="?cancela_venda=1" class="btn btn-secondary">Cancelar a Compra</a>
<input type="submit" class="btn btn-success" value="Concluir Compra">
</form>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>   
 <?php
 if(isset($_POST['confirma_qrcode'])){
	 echo '
 <div class="modal fade modal-lg" data-bs-backdrop="static" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">   
      </div>
   <div class="card" style="height: 200px">
   <h3>Linha do Pix (copia e cola):</h3>
   <div class="row">
      <div class="col">
      <textarea class="form-control ms-3" id="brcodepix" rows="4" onclick="copiar()">'. $pix.'</textarea>
      </div>
      <div class="col-sm-4">
      <p><button type="button" id="clip_btn" class="btn btn-primary ms-3"  data-toggle="tooltip" data-placement="top" title="Copiar código pix" onclick="copiar()"><i class="fas fa-clipboard"> - Copiar</i></button></p>
      </div>
   </div>
   </div>
    <div>
   <h3>Imagem de QRCode do Pix:</h3>
   <h2 style="text-align: center">R$ '.number_format($total_somado,2,',','.').'</2>
   <p style="text-align: center">';
   ob_start();
   QRCode::png($pix, null,'M',5);
   $imageString = base64_encode( ob_get_contents() );
   ob_end_clean();
   // Exibe a imagem diretamente no navegador codificada em base64.
   echo '<img src="data:image/png;base64,' . $imageString . '"><br><br><br><img src="logo_pix.png"></p>';
echo '

      <div class="modal-footer bg-light">
			<a href="?concluido_compra=ok" class="btn btn-secondary">INICIO</a>
			<a href="#" class="btn btn-secondary">Minhas Compras</a>
      </div>
    </div>
  </div>
</div>';       
       
 }

?>      
    </div>
    </div>
</body>