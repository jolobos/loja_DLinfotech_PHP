<?php

require_once("cabecalho.php");
?>

<div id="layout" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#layout" data-bs-slide-to="0" class="active"></button>
		<button type="button" data-bs-target="#layout" data-bs-slide-to="1"></button>
		<button type="button" data-bs-target="#layout" data-bs-slide-to="2"></button>
	</div>

	<div class="carousel-inner">
		<div class="carousel-item active">
		  <img src="img/img1.jpg" alt="PC GAMER" class="d-block w-100" style="height: 500px">
		  <div class="carousel-caption">
			<h3 class="text-secondary">Monte seu PC Gamer</h3>
			<a class="btn btn-danger text-dark" href="#">Click no botão e saiba mais</a>
		  </div>
		</div>
		<div class="carousel-item">
		  <img src="img/img7.jpg" alt="Celulares" class="d-block w-100" style="height: 500px">
		  <div class="carousel-caption">
			<h3 class="text-secondary">Consulte nossos preços</h3>
			<a class="btn btn-danger text-dark" href="#">Click no botão e saiba mais</a>
		  </div>
		</div>
		<div class="carousel-item">
		  <img src="img/img3.jpg" alt="Carregadores" class="d-block w-100" style="height: 500px;">
		  <div class="carousel-caption">
			<h3 class="text-secondary">Amplo estoque em Carregadores</h3>
                        <a class="btn btn-danger text-dark" href="#">Click no botão e saiba mais</a>
		  </div>
		</div>
	</div>

	<button class="carousel-control-prev " type="button" data-bs-target="#demo" data-bs-slide="prev">
		<span class="carousel-control-prev-icon bg-dark" style="border-radius: 30%"></span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
	<span class="carousel-control-next-icon bg-dark" style="border-radius: 30%"></span>
	  </button>
</div>
</br>

<div style="background: black; width: 100%; height:80px">
</div>
<section class="secao4" id="sobre">
    <div class="secao4-div row">
        <!-- Card 1 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
            <img decoding="async" src="img/card1.png" alt="imagem do card 1 html e css">
			<h5 class="card-title">Carregadores</h5>
			<p class="card-text">Encontre carregadores para todas as marcas e modelos em celulares, notebooks e computadores.</p>
			<a href="#" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>
		</div>

        <!-- Card 2 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
            <img decoding="async" src="img/card2.png" alt="imagem do card 2 html e css">
			<h5 class="card-title">Computadores</h5>
			<p class="card-text" >Querendo efetuar um upgrade na carroça? click e veja as opções e valores.</p>
			<a href="#" class="btn btn-primary align-self-stretch mt-auto">Visitar</a>
		</div>

        <!-- Card 3 -->
        <div class="secao4-div-card col d-flex flex-column align-items-center">
            <img decoding="async" src="img/card3.png" alt="imagem do card 3 html e css">
			<h5 class="card-title">Capinhas e Peliculas</h5>
			<p class="card-text">Temos capinhas e peliculas para inumeros modelos e marcas, com o melhor preço.</p>
			<a href="#" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>

        </div>
		<div class="secao4-div-card col d-flex flex-column align-items-center">
            <img decoding="async" src="img/card4.png" alt="imagem do card 4 html e css">
            <h5 class="card-title">Troca de display</h5>
			<p class="card-text">Consulte nossos valores e marcas disponiveis. </p>
			<a href="#" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>
        </div>
		<div class="secao4-div-card col d-flex flex-column align-items-center">
            <img decoding="async" src="img/card5.png" alt="imagem do card 5 html e css">
            <h5 class="card-title">Acessórios</h5>
			<p class="card-text">Temos inumeros acessórios para toda area de informatica e smartphones.</p>
			<a href="#" class="btn btn-primary align-self-stretch mt-auto" >Visitar</a>
        </div>	
    </div>
</section>
<div  style="background: black; width: 100%; height:80px">
<h3 class="pt-4 text-center text-info" > Ofertas da Semana </h3>

</div>
<section>

<div class="grid_promocao">
  <div class="box1 m-2" >
  <div class="card" style="width: 100%; height: 100%;">
			<h3 class="text-info">MEGA PROMOÇÃO DA SEMANA</h3>
			<img class="card-img-top" src="img/produtos/produto1.png"  alt="Imagem de capa do card" style="width: 100%;">
			<div class="card-body">
			<h5 class="card-title">Carregador Lehmox</h5>
			<p class="card-text">Carregador bivolt lehmox de 3.1 amperes - compativel com iphone.</p>
			<a href="#" class="btn btn-success">preço R$ ---</a>
			</div>
			</div>
  </div>
  <div class="box2">
  <div class="card m-2" >
      <img class="card-img-top" src="img/produtos/produto2.png" alt="Imagem de capa do card" style="width: 45%; display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">Título do card</h5>
			<p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
			<a href="#" class="btn btn-success">preço R$ ---</a>
			</div>
			</div>
  </div>
  <div class="box3">
  <div class="card m-2" >
			<img class="card-img-top" src="img/produtos/produto3.png" alt="Imagem de capa do card" style="width: 45%;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">Título do card</h5>
			<p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
			<a href="#" class="btn btn-success">preço R$ ---</a>
			</div>
			</div>
  </div>
  <div class="box4">
  <div class="card m-2" >
			<img class="card-img-top" src="img/produtos/produto4.png" alt="Imagem de capa do card" style="width: 45%;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">Título do card</h5>
			<p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
			<a href="#" class="btn btn-success">preço R$ ---</a>
			</div>
			</div>
  </div>
  <div class="box5">
  <div class="card m-2" >
			<img class="card-img-top" src="img/produtos/produto5.png" alt="Imagem de capa do card" style="width: 45%;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-body">
			<h5 class="card-title">Título do card</h5>
			<p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o conteúdo do card.</p>
			<a href="#" class="btn btn-success">preço R$ ---</a>
			</div>
			</div>
  </div>
</div>		
</section>
<section>
<?php
require_once('rodape.php');
?>
</section>
</body>
</html>