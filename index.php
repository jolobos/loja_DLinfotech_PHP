<?php
require_once 'database.php';
$sql = "SELECT * FROM tela_principal ORDER BY id_tela DESC LIMIT 0,1";
$consulta = $conexao->query($sql);
$d = $consulta->fetch(PDO::FETCH_ASSOC);
require_once("cabecalho.php");
if(isset($_GET['mensagem_compra'])){
	  echo  '<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	  <script type="text/javascript">
$(window).load(function() {
    $("#exemplomodal").modal("show");
});
</script>
	  <div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">';
        if($_GET['mensagem_compra'] == 'ok'){
        echo '<div class="modal-header bg-info">
          <h3 class="modal-title">Tudo certo...</h3>
      </div>
      <div class="modal-body bg-light">
        <h5>Sua compra foi realizada com sucesso.</h5>
	<p> Voce pode visualizar as informações da sua compra, e das suas compras anteriores, acessando a página de "COMPRAS" 
	no menu do usuário.</p>
      </div>';
        
        }else{    
                    echo '<div class="modal-header bg-danger">
                   <h3 class="modal-title">Vishhh...</h3>
                    </div>
                    <div class="modal-body bg-light">
                      <h5>Sua compra não pode ser realizada.</h5>
                              <p> Nosso sistema deve estar apresentando alguma inconsistencia momentânea, tente realizar o seu pedido mais tarde. Obrigado!</p>
                   </div> ';}
      echo '<div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';

}
?>
  <?php echo '
<div id="troca" class="carousel slide" data-ride="carousel" style="margin-top: 85px;">
 <div class="carousel-indicators">
    <button type="button" data-bs-target="#troca" data-bs-slide-to="0" class="active"></button>';
  if(!empty($d['banner_2'])){
      echo '<button type="button" data-bs-target="#troca" data-bs-slide-to="1"></button>';      
  }if(!empty($d['banner_3'])){
      echo '<button type="button" data-bs-target="#troca" data-bs-slide-to="2"></button>';      
  }if(!empty($d['banner_4'])){
      echo '<button type="button" data-bs-target="#troca" data-bs-slide-to="3"></button>';      
  }
  if(!empty($d['banner_5'])){
      echo '<button type="button" data-bs-target="#troca" data-bs-slide-to="4"></button>';      
  }
  echo '</div>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="d-block w-100" src="img/banner/'.$d['banner_1'].'" alt="Primeiro Slide" style="height: 500px">
    
		  <div class="carousel-caption">
			<h3 class="text-secondary">'.$d['titulo_banner_1'].'</h3>
			<a class="btn btn-danger text-dark" href="'.$d['link_banner_1'].'">Click no botão e saiba mais</a>
		  </div>
		</div>';
    if(!empty($d['banner_2'])){
     echo '<div class="carousel-item">
      <img class="d-block w-100" src="img/banner/'.$d['banner_2'].'" alt="Quarto Slide" style="height: 500px">
    
		  <div class="carousel-caption">
			<h3 class="text-secondary">'.$d['titulo_banner_2'].'</h3>
			<a class="btn btn-danger text-dark" href="'.$d['link_banner_2'].'">Click no botão e saiba mais</a>
		  </div>
		</div>
  ';
  }
     if(!empty($d['banner_3'])){
     echo '<div class="carousel-item">
      <img class="d-block w-100" src="img/banner/'.$d['banner_3'].'" alt="Quarto Slide" style="height: 500px">
    
		  <div class="carousel-caption">
			<h3 class="text-secondary">'.$d['titulo_banner_3'].'</h3>
			<a class="btn btn-danger text-dark" href="'.$d['link_banner_3'].'">Click no botão e saiba mais</a>
		  </div>
		</div>
  ';
  }
  if(!empty($d['banner_4'])){
     echo '<div class="carousel-item">
      <img class="d-block w-100" src="img/banner/'.$d['banner_4'].'" alt="Quarto Slide" style="height: 500px">
    
		  <div class="carousel-caption">
			<h3 class="text-secondary">'.$d['titulo_banner_4'].'</h3>
			<a class="btn btn-danger text-dark" href="'.$d['link_banner_4'].'">Click no botão e saiba mais</a>
		  </div>
		</div>
  ';
  }
  if(!empty($d['banner_5'])){
     echo '<div class="carousel-item">
      <img class="d-block w-100" src="img/banner/'.$d['banner_5'].'" alt="Quinto Slide" style="height: 500px">
    
		  <div class="carousel-caption">
			<h3 class="text-secondary">'.$d['titulo_banner_5'].'</h3>
			<a class="btn btn-danger text-dark" href="'.$d['link_banner_5'].'">Click no botão e saiba mais</a>
		  </div>
		</div>
  ';
  }
  
 echo '</div><button class="carousel-control-prev" type="button" data-bs-target="#troca" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark" style="border-radius:50%; width: 70px; height: 70px;"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#troca" data-bs-slide="next">
    <span class="carousel-control-next-icon  bg-dark" style="border-radius:50%; width: 70px; height: 70px;"></span>
  </button>
</div>

'; ?>
</br>

<div style="background: black; width: 100%; height:80px">
</div>
<section class="secao4" id="sobre">
    <div class="secao4-div row">
        <!-- Card 1 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
             <?php	echo '<img decoding="async" src="img/box/'.$d['ft_box_1'].'" alt="imagem do card 5 html e css">
                        <h5 class="card-title">'.$d['titulo_box_1'].'</h5> 
			<p class="card-text">'.$d['descricao_box_1'].'</p>
			<a href="produtos/procura_produto.php?categoria='.$d['categoria_box_1'].'" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>';?>
		</div>

        <!-- Card 2 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
                         <?php	echo '<img decoding="async" src="img/box/'.$d['ft_box_2'].'" alt="imagem do card 5 html e css">
                        <h5 class="card-title">'.$d['titulo_box_2'].'</h5> 
			<p class="card-text">'.$d['descricao_box_2'].'</p>
			<a href="produtos/procura_produto.php?categoria='.$d['categoria_box_2'].'" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>';?>
		</div>

        <!-- Card 3 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
             <?php	echo '<img decoding="async" src="img/box/'.$d['ft_box_3'].'" alt="imagem do card 5 html e css">
                        <h5 class="card-title">'.$d['titulo_box_3'].'</h5> 
			<p class="card-text">'.$d['descricao_box_3'].'</p>
			<a href="produtos/procura_produto.php?categoria='.$d['categoria_box_3'].'" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>';?>
		</div>
		<div class="secao4-div-card col d-flex flex-column align-items-center">
                         <?php	echo '<img decoding="async" src="img/box/'.$d['ft_box_4'].'" alt="imagem do card 5 html e css">
                        <h5 class="card-title">'.$d['titulo_box_4'].'</h5> 
			<p class="card-text">'.$d['descricao_box_4'].'</p>
			<a href="produtos/procura_produto.php?categoria='.$d['categoria_box_4'].'" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>';?>
		</div>
		<div class="secao4-div-card col d-flex flex-column align-items-center">
             <?php	echo '<img decoding="async" src="img/box/'.$d['ft_box_5'].'" alt="imagem do card 5 html e css">
                        <h5 class="card-title">'.$d['titulo_box_5'].'</h5> 
			<p class="card-text">'.$d['descricao_box_5'].'</p>
			<a href="produtos/procura_produto.php?categoria='.$d['categoria_box_5'].'" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>';?>
		</div>	
    </div>
</section>
<div  style="background: black; width: 100%; height:80px">
<h3 class="pt-4 text-center text-info" > Ofertas da Semana </h3>

</div>
<section>
<?php

$id_produto1 = $d['id_oferta_1'];
$sql1 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto1."'";
$consulta1 = $conexao->query($sql1);
$dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);

$id_produto2 = $d['id_oferta_2'];
$sql2 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto2."'";
$consulta2 = $conexao->query($sql2);
$dados2 = $consulta2->fetch(PDO::FETCH_ASSOC);

$id_produto3 = $d['id_oferta_3'];
$sql3 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto3."'";
$consulta3 = $conexao->query($sql3);
$dados3 = $consulta3->fetch(PDO::FETCH_ASSOC);

$id_produto4 = $d['id_oferta_4'];
$sql4 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto4."'";
$consulta4 = $conexao->query($sql4);
$dados4 = $consulta4->fetch(PDO::FETCH_ASSOC);

$id_produto5 = $d['id_oferta_5'];
$sql5 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto5."'";
$consulta5 = $conexao->query($sql5);
$dados5 = $consulta5->fetch(PDO::FETCH_ASSOC);
/*
echo '<div class="grid_promocao">
        <div class="box1 mt-2 ms-3" style="width: 670px; height: 990px;">
        <div class="card" style="width: 100%; height: 100%;">
			<h3 class="text-info">MEGA PROMOÇÃO DA SEMANA</h3>
			<img class="card-img-top" src="img/produtos/'.$dados1['foto'].'"  alt="Imagem de capa do card" style="width: 100%;">
			<div class="card-body">
			<h5 class="card-title">'.$dados1['nome'].'</h5>
			<p class="card-text">'.$dados1['descricao'].'</p>
			<a href="produtos/pagina_produto.php?id_produto='.$id_produto1.'" class="btn btn-success" style="position:absolute;bottom:20px">preço R$ '. number_format($dados1['valor'],2,',','.').'</a>
			</div>
			</div>
  </div>
  <div class="box2" >
  <div class="card mt-2" style="width: 587px; height: 490px;" >
      <img class="card-img-top" src="img/produtos/'.$dados2['foto'].'" alt="Imagem de capa do card" style="width:  300px;height:300px; display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">'.$dados2['nome'].'</h5>
			<p class="card-text">'.$dados2['descricao'].'</p>
			<a href="produtos/pagina_produto.php?id_produto='.$id_produto2.'" class="btn btn-success" style="position:absolute;bottom:20px">preço R$ '. number_format($dados2['valor'],2,',','.').'</a>
			</div>
			</div>
  </div>
  <div class="box3">
  <div class="card mt-2" style="width: 580px; height: 490px;">
			<img class="card-img-top" src="img/produtos/'.$dados3['foto'].'" alt="Imagem de capa do card" style="width: 300px;height:300px;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">'.$dados3['nome'].'</h5>
			<p class="card-text">'.$dados3['descricao'].'</p>
			<a href="produtos/pagina_produto.php?id_produto='.$id_produto3.'" class="btn btn-success" style="position:absolute;bottom:20px">preço R$ '. number_format($dados3['valor'],2,',','.').'</a>
			</div>
			</div>
  </div>
  <div class="box4">
  <div class="card mt-2" style="width: 587px; height: 490px;">
			<img class="card-img-top" src="img/produtos/'.$dados4['foto'].'" alt="Imagem de capa do card" style="width:  300px;height:300px;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">'.$dados4['nome'].'</h5>
			<p class="card-text">'.$dados4['descricao'].'</p>
			<a href="produtos/pagina_produto.php?id_produto='.$id_produto4.'" class="btn btn-success" style="position:absolute;bottom:20px">preço R$ '. number_format($dados4['valor'],2,',','.').'</a>
			</div>
			</div>
  </div>
  <div class="box5">
  <div class="card mt-2" style="width: 580px; height: 490px;">
			<img class="card-img-top" src="img/produtos/'.$dados5['foto'].'" alt="Imagem de capa do card" style="width:  300px;height:300px;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">'.$dados5['nome'].'</h5>
			<p class="card-text">'.$dados5['descricao'].'</p>
			<a href="produtos/pagina_produto.php?id_produto='.$id_produto5.'" class="btn btn-success" style="position:absolute;bottom:20px">preço R$ '. number_format($dados5['valor'],2,',','.').'</a>
			</div>
			</div>
  </div>
</div>		
</section>';
*/

//testando o grid com bootstrap
echo '<div class="row mt-2">
        <div class="col">
            <div class="card" style="width: 100%; height: 100%;">
		<h3 class="text-info">MEGA PROMOÇÃO DA SEMANA</h3>
		<img src="img/produtos/'.$dados1['foto'].'"  alt="Imagem de capa do card" style="width:70%;margin:auto;margin-top:0px">
                <div class="card-body" style="position:absolute;bottom:0px">
                    <h5 class="card-title">'.$dados1['nome'].'</h5>
                    <p class="card-text">'.$dados1['descricao'].'</p>
                    <a href="produtos/pagina_produto.php?id_produto='.$id_produto1.'" class="btn btn-success" >preço R$ '. number_format($dados1['valor'],2,',','.').'</a>
		</div>
            </div>		
        </div>
        <div class="col">
        <div class="row">
        <div class="col">
            <div class="card" style="width: 100%; height: 600px;">
                 <img src="img/produtos/'.$dados2['foto'].'" alt="Imagem de capa do card" style="width:65%;height:65%;margin:auto;margin-top:0px">
                    <div class="card-body" style="position:absolute;bottom:0px">
                        <h5 class="card-title">'.$dados2['nome'].'</h5>
                        <p class="card-text">'.$dados2['descricao'].'</p>
                        <a href="produtos/pagina_produto.php?id_produto='.$id_produto2.'" class="btn btn-success" >preço R$ '. number_format($dados2['valor'],2,',','.').'</a>
                    </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 100%; height: 600px;">
                <img src="img/produtos/'.$dados3['foto'].'" alt="Imagem de capa do card" style="width:65%;height:65%;margin:auto;margin-top:0px">
		<div class="card-body" style="position:absolute;bottom:0px">
                    <h5 class="card-title">'.$dados3['nome'].'</h5>
                    <p class="card-text">'.$dados3['descricao'].'</p>
                    <a href="produtos/pagina_produto.php?id_produto='.$id_produto3.'" class="btn btn-success" >preço R$ '. number_format($dados3['valor'],2,',','.').'</a>
		</div>
            </div>
        </div>
        </div>
        <div class="row mt-2">
        <div class="col">
            <div class="card" style="width: 100%; height: 600px;">
                <img src="img/produtos/'.$dados4['foto'].'" alt="Imagem de capa do card" style="width:65%;height:65%;margin:auto;margin-top:0px">
		<div class="card-body" style="position:absolute;bottom:0px">
                    <h5 class="card-title">'.$dados4['nome'].'</h5>
                    <p class="card-text">'.$dados4['descricao'].'</p>
                    <a href="produtos/pagina_produto.php?id_produto='.$id_produto4.'" class="btn btn-success" >preço R$ '. number_format($dados4['valor'],2,',','.').'</a>
		</div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 100%; height: 600px;">
		<img src="img/produtos/'.$dados5['foto'].'" alt="Imagem de capa do card" style="width:65%;height:65%;margin:auto;margin-top:0px">
		<div class="card-body" style="position:absolute;bottom:0px">
                    <h5 class="card-title">'.$dados5['nome'].'</h5>
                    <p class="card-text">'.$dados5['descricao'].'</p>
                    <a href="produtos/pagina_produto.php?id_produto='.$id_produto5.'" class="btn btn-success">preço R$ '. number_format($dados5['valor'],2,',','.').'</a>
                </div>
                
            </div>
        </div>
        </div>
        </div>
    </div>';
?>
<?php
require_once('multicards.php')
?>
<?php
require_once('rodape.php');
?>
