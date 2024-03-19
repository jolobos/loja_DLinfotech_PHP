<?php
$nivel = 0;
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("cabecalho.php");

session_start();
if(empty($_SESSION['usuario'])){
	$logado = 0;
	session_destroy();
	}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INICIO - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">

	<!-- esse script libera os botoes de compartilhamento -->
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>

  </head>
  <body>
  
<div class="bg-dark">
					<nav class="navbar navbar-expand-lg  " >
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0 "><a href="index.php"><img src="img/logo.png" alt="logo image" style="height: 70px">
					
	<?php
			if($logado == 0){
					echo '<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="img/user_null.png" style="border-radius: 50%;width:50px;height:50px;align=left;">
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					  <a class="dropdown-item" href="#">Conta</a>
					  <a class="dropdown-item" href="#">Compras</a>
					  <a class="dropdown-item" href="#">Log Out</a>
					</div>
				  </li>
					<li><a href="#" class="btn btn-secondary m-2">Registro</a></li>
					<li><a href="#" class="btn btn-secondary m-2">Conecte-se</a></li>
					';
				}
	?>
	</ul></nav></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark"></a>
   <div class="container collapse navbar-collapse" id="navbarTogglerDemo02">
<div class="container" >
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Produtos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Serviços</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Endereço</a>
      </li>
    </ul>
   </div></div>
   
   <form class="form-inline my-2 my-lg-0 w-75 p-1 " >
   <div class=" row  " >
   <div class="col" >
      <input class="form-control" type="search"  placeholder="Pesquisars">
	  </div>
	     <div class="col-sm-4"   >
      <button class="btn btn-outline-success" type="submit">Pesquisar</button>
	  </div>
	  </div>
    </form>
	
</nav>