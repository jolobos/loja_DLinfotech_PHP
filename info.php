<?php

require_once("cabecalho.php");
?>
<div id="demo" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
		<button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
		<button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
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
		  <img src="img/img3.jpg" alt="Carregadores" class="d-block w-100" style="height: 500px">
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
<div class="btn btn-button" style="background: black; width: 100%; height:80px">



</div>
<section class="secao4" id="sobre">
    <div class="secao4-div row">
        <!-- Card 1 -->
        <div class="secao4-div-card col">
            <img decoding="async" src="img/card1.png" alt="imagem do card 1 html e css">
			<h5 class="card-title">Carregadores</h5>
			<p class="card-text">Encontre carregadores para todas as marcas e modelos em celulares, notebooks e computadores.</p>
			<a href="#" class="btn btn-primary">Visitar</a>
		</div>

        <!-- Card 2 -->
        <div class="secao4-div-card col">
            <img decoding="async" src="img/card2.png" alt="imagem do card 2 html e css">
			<h5 class="card-title">Computadores</h5>
			<p class="card-text">Querendo efetuar um upgrade na carroça? click e veja as opções e valores.</p>
			</br>
			<a href="#" class="btn btn-primary">Visitar</a>
		</div>

        <!-- Card 3 -->
        <div class="secao4-div-card col">
            <img decoding="async" src="img/card3.png" alt="imagem do card 3 html e css">
			<h5 class="card-title">Capinhas e Peliculas</h5>
			<p class="card-text">Temos capinhas e peliculas para inumeros modelos e marcas, com o melhor preço.</p>
			</br>
			<a href="#" class="btn btn-primary">Visitar</a>

        </div>
		<div class="secao4-div-card col">
            <img decoding="async" src="img/card4.png" alt="imagem do card 3 html e css">
            <h5 class="card-title">Troca de display</h5>
			<p class="card-text">Consulte nossos valores e marcas disponiveis. </p></br>
			<a href="#" class="btn btn-primary">Visitar</a>
        </div>
		<div class="secao4-div-card col">
            <img decoding="async" src="img/card5.png" alt="imagem do card 3 html e css">
            <h5 class="card-title">Acessórios</h5>
			<p class="card-text">Temos inumeros acessórios para toda area de informatica e smartphones.</p>
			</br>
			<a href="#" class="btn btn-primary">Visitar</a>
        </div>
    </div>
</section>


</body>
</html>