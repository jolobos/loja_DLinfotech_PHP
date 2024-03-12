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


<div class="row" >
<div class="col" >
<div class="card mx-auto w-auto p-3">
  <img class="card-img-top "  src="img/card1.png" alt="Imagem de capa do card">
  <div class="card-body">
    <h5 class="card-title">Carregadores</h5>
    <p class="card-text">Encontre carregadores para todas as marcas e modelos em celulares, notebooks e computadores.</p>
    <a href="#" class="btn btn-primary">Visitar</a>
  </div>
</div>
</div>
<div class="col">
<div class="card  mx-auto w-auto p-3">
  <img class="card-img-top" src="img/card2.png" alt="Imagem de capa do card">
  <div class="card-body">
    <h5 class="card-title">Computadores</h5>
    <p class="card-text">Querendo efetuar um upgrade na carroça? click e veja as opções e valores.</p>
    <a href="#" class="btn btn-primary">Visitar</a>
  </div>
</div>
</div>
<div class="col">
<div class="card  mx-auto w-auto p-3">
  <img class="card-img-top" src="img/card3.png" alt="Imagem de capa do card">
  <div class="card-body">
    <h5 class="card-title">Capinhas e Peliculas</h5>
    <p class="card-text">Temos capinhas e peliculas para inumeros modelos e marcas, com o melhor preço.</p>
    <a href="#" class="btn btn-primary">Visitar</a>
  </div>
</div>
</div><div class="col">
<div class="card  mx-auto w-auto p-3" >
  <img class="card-img-top" src="img/card4.png" alt="Imagem de capa do card">
  <div class="card-body">
    <h5 class="card-title">Troca de display</h5>
    <p class="card-text">Consulte nossos valores e marcas disponiveis. </p></br>
    <a href="#" class="btn btn-primary">Visitar</a>
  </div>
</div>
</div><div class="col">
<div class="card  mx-auto w-auto p-3">
  <img class="card-img-top" src="img/card5.png" alt="Imagem de capa do card">
  <div class="card-body">
    <h5 class="card-title">Acessórios</h5>
    <p class="card-text">Temos inumeros acessórios para toda area de informatica e smartphones.</p>
    <a href="#" class="btn btn-primary">Visitar</a>
  </div>
</div>
</div>
</div>
</br>
</br>

	<h1> testando cards diferentes</h1>
	</br>
<div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
     <div class="card-group">
      <div class="card">
       <img src="..." class="card-img-top" alt="...">
       <div class="card-body">
       <h5 class="card-title">Card title</h5>
       <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
       <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>

    </div>
    <div class="carousel-item">
<div class="card-group">
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>

    </div>
    <div class="carousel-item">
  

<div class="card-group">
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>
</html>