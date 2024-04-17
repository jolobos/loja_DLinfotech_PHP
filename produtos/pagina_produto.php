<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");

if(!empty($_GET['id_produto'])){
$id_produto = $_GET['id_produto'];
$sql = "SELECT * FROM produtos WHERE id_produto = '".$id_produto."'";
$consulta = $conexao->query($sql);
$dados = $consulta->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM ficha_tec_produto WHERE id_produto = '".$id_produto."'";
$consulta2 = $conexao->query($sql2);
$dados2 = $consulta2->fetch(PDO::FETCH_ASSOC);
    
}

require_once 'cabecalho.php';

?>

<div class="container" style="margin-top: 95px;">
    <hr/>
    <h3>Produto</h3>
 
</div>
<?php
echo '<div class="container bg-light" >
    <div class="row">
    <div class="col-sm-1">


        <a data-bs-target="#demo" data-bs-slide-to="0" class="active">
        <img src="../img/produtos/'.$dados['foto'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>';
        if(!empty($dados['foto_1'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="1">
        <img src="../img/produtos/'.$dados['foto_1'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
        if(!empty($dados['foto_2'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="2">
        <img src="../img/produtos/'.$dados['foto_2'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
        if(!empty($dados['foto_3'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="3">
        <img src="../img/produtos/'.$dados['foto_3'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
        if(!empty($dados['foto_4'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="4">
        <img src="../img/produtos/'.$dados['foto_4'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
        if(!empty($dados['foto_5'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="5">
        <img src="../img/produtos/'.$dados['foto_5'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
        if(!empty($dados['foto_6'])){
        echo '<a data-bs-target="#demo" data-bs-slide-to="6">
        <img src="../img/produtos/'.$dados['foto_6'].'" class="d-block w-100 img-thumbnail mt-2" style="height: 100px;"></a>'; }
    
        echo '</div>
          <div class="col-lg-7">
  
<div id="demo" class="carousel " data-bs-ride="carousel" >
        <div class="carousel-inner slide ">';
        if(!empty($dados['foto'])){
        echo '<div class="carousel-item active ">
        <img src="../img/produtos/'.$dados['foto'].'" class="d-block  " style="height: 600px;margin:auto">
        </div>'; }
        if(!empty($dados['foto_1'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_1'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
         if(!empty($dados['foto_2'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_2'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
         if(!empty($dados['foto_3'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_3'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
         if(!empty($dados['foto_4'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_4'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
         if(!empty($dados['foto_5'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_5'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
         if(!empty($dados['foto_6'])){
        echo '<div class="carousel-item">
        <img src="../img/produtos/'.$dados['foto_6'].'" class="d-block " style="height: 600px;margin:auto">
        </div>';}
    
        
echo '</div></div></div>
        <div class="col card" >';

    echo '
    <form action="endereco_compra.php" method="POST">
    <h2>'.$dados['nome'].'</h2>
    <h3 style="top:110px;">R$ '. number_format($dados['valor'],2,'.',',').'</h3>';
     if($dados['valor'] >= 10 && $dados['valor'] <= 24.99 ){
         echo '<p>em 2X de R$ '.number_format(($dados['valor']/2),2,'.',',').'</p>';
     }else if($dados['valor'] >= 25 && $dados['valor'] <= 49.99){
        echo '<p>em 3X de R$ '.number_format(($dados['valor']/3),2,'.',',').'</p>';
     }else if($dados['valor'] >= 50 && $dados['valor'] <= 74.99){
        echo '<p>em 4X de R$ '.number_format(($dados['valor']/4),2,'.',',').'</p>';
     }else if($dados['valor'] >= 75 && $dados['valor'] <= 99.99){
        echo '<p>em 5X de R$ '.number_format(($dados['valor']/5),2,'.',',').'</p>';
     }else if($dados['valor'] >= 100){
        echo '<p>em 6X de R$ '.number_format(($dados['valor']/6),2,'.',',').'</p>';
     }
    if($dados['voltagem_opcoes'] == 'bi-volt'){
        if($dados['voltagem']== '110'){
    echo '<div>
    <a class="btn btn-light active">110V</a>
    <a class="btn btn-light" href="#">220V</a>
    </div>';}else if($dados['voltagem']== '220'){
     echo '<div>
    <a class="btn btn-light" href="#">110V</a>
    <a class="btn btn-light active">220V</a>
    </div>';  
        
    }}else{ echo '</br></br>';}
    
    if($dados['voltagem_opcoes']== '110v'){
       echo '
    <div>
    <a class="btn btn-light active">110V</a>
    </div>';  
    }
    if($dados['voltagem_opcoes']== '220v'){
       echo '
    <div>
    <a class="btn btn-light active">220V</a>
    </div>';  
    }
    
    if(!empty($dados['cor'])){
        
    echo '<div>';
       if($dados['azul']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">azul</a>';}
       if($dados['vermelho']>0){
       echo '<a class="btn btn-light border-danger me-2 mt-2" href="#">vermelho</a>';}
       if($dados['preto']>0){
       echo '<a class="btn btn-light border-dark me-2 mt-2" href="#">preto</a>';}
       if($dados['branco']>0){
       echo '<a class="btn btn-light border-white-50 me-2 mt-2" href="#">branco</a>';}
       if($dados['amarelo']>0){
       echo '<a class="btn btn-light border-warning me-2 mt-2" href="#">amarelo</a>';}
       if($dados['verde']>0){
       echo '<a class="btn btn-light border-success me-2 mt-2" href="#">verde</a>';}
       if($dados['laranja']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">laranja</a>';}
       if($dados['cinza']>0){
       echo '<a class="btn btn-light border-primary  me-2 mt-2" href="#">cinza</a>';}
       if($dados['rosa']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">rosa</a>';}
       if($dados['marrom']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">marrom</a>';}
       if($dados['roxo']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">roxo</a>';}
       if($dados['prata']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">prata</a>';}
       if($dados['dourado']>0){
       echo '<a class="btn btn-light border-primary me-2 mt-2" href="#">dourado</a>';}
      
    echo '</div>';}
    
    echo '<div class="m-2"> 
    <h5>Quantidade</h5>
	<div class="row">
	<div class="col-sm-4 mt-2">
    <input type="range"  name="quantidade_produto" value="1" min="1" max="'.$dados['quantidade'].'"
    oninput="display.value=value" onchange="display.value=value">
	</div>
	<div class="col">
    <input type="text" id="display" class="form-control w-25" name="quantidade_produto" value="1" readonly>
    </div>
    </div>
    <h5>Decrição</h5>
    <p>'.$dados['descricao'].'</p>
    </div>

     <input type="hidden" name="id_produto_POST" value="'.$id_produto.'"/>       
     <input class="btn btn-success "type="submit" Value="Comprar" style="position:absolute;bottom:10px;" >
     <a href="ver_carrinho.php?id_produto='.$id_produto.'"class="btn btn-secondary" style="position:absolute;left:110px;bottom:10px;">Adicionar ao carrinho</a>    
         </form>';
        
?>            
           
        </div> 
        
</div>
</div>
<div class="container">
    <hr/>
<div class="accordion" id="accordionExample" >
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
         Ficha técnica do produto
        </button>
      </h5>
    </div>
    </div>
</div>

<div id="collapseOne1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php       
		if(!empty($dados2['id_produto'])){				
			echo '<div class="row"><div class="col-sm-3">';
			echo '<ul>
						<li><p>Tamanho: '.$dados2['tamanho'].'</p></li>
						<li><p>Altura: '.$dados2['altura'].'</p></li>
						<li><p>Largura: '.$dados2['largura'].'</p></li>
						<li><p>Peso: '.$dados2['peso'].'</p></li>
						<li><p>Potência: '.$dados2['potencia'].'</p></li>
						<li><p>Voltagem: '.$dados2['voltagem'].'</p></li>
						<li><p>Fabricante: '.$dados2['fabricante'].'</p></li>
						<li><p>Marca: '.$dados2['marca'].'</p></li>
						<li><p>Modelo: '.$dados2['modelo'].'</p></li>
						<li><p>Garantia: '.$dados2['garantia'].'</p></li>
			</ul></div>
			<div class="col-sm-3">
			<ul>
						<li><p>Temperatura MAX: '.$dados2['temperatura_max'].'</p></li>
						<li><p>Temperatura MIN: '.$dados2['temperatura_min'].'</p></li>
						<li><p>Armazenamento: '.$dados2['capacidade_armazenamento'].'</p></li>
						<li><p>Durabilidade: '.$dados2['durabilidade'].'</p></li>
						<li><p>Carga/Regarga: '.$dados2['tempo_recarga'].'</p></li>
						<li><p>Prova d´agua: '.$dados2['prova_agua'].'</p></li>
						<li><p>Registencia a água: '.$dados2['resistente_agua'].'</p></li>
						<li><p>Velocidade: '.$dados2['velocidade'].'</p></li>
			</ul>
			';
			echo '</div></div>';
		}
	?>
</div>
<hr/>
<div class="accordion" id="accordionExample" >
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
         Descrição completa do produto
        </button>
      </h5>
    </div>
    </div>
</div>

<div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
    <?php if(!empty($dados2['descricao_longa']))echo '<h5>Descrição: </h5><div class="mx-5"><p>'.$dados2['descricao_longa'].'</p></div>';?>

</div>
<hr/>
<div class="accordion" id="accordionExample" >
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne">
         Condições de devolução e Garantia
        </button>
      </h5>
    </div>
    </div>
</div>

<div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
    <h1>Apenas será usado no momento que for decidido corretamente as Condições de troca, avaria, reembolso, entre outros.....</h1>

</div>



</div>

