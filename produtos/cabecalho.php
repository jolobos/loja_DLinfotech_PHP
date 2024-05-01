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
</head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"  >
		<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
        <li><a href="../index.php"><img src="../img/logo.png" alt="logo image" style="height: 70px"></a></li><?php
			if($logado == 1){
                    $nick = '';
                    if(!empty($apelido)){$nick = $apelido;}else{$nick = $nome;}
                    if(!empty($foto)){$foto_usuario = $foto;}else{$foto_usuario ="user_null.png" ;}
                    if(!empty($_SESSION['produto_carrinho'])){ $img_carrinho = '<img src="../img/img_carrinho.png" style="width:20px">'; }else{ $img_carrinho = '';}
					echo '<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="../img/foto_usuario/'.$foto_usuario.'" style="border-radius: 50%;width:50px;height:50px;align=left;">
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					  <a class="dropdown-item" href="../index.php">Inicio</a>
					  <a class="dropdown-item" href="../usuario/notificacoes.php">Notificações</a>
					  <a class="dropdown-item" href="../usuario/perfil.php">Perfil</a>
					  <a class="dropdown-item" href="compras.php">Compras</a>
					  <a class="dropdown-item" href="../usuario/altera_usuario.php">Configurações</a>
					  <a class="dropdown-item" href="#.php">Suporte</a>
					  <a class="dropdown-item" href="../sair.php">Sair</a>
					  </div><li class="navbar-brand mt-4"><p class="text-info">'.$nick.'</p></li>
				  </li>
				  <li class="navbar-brand mt-2">
					  <form class="form-inline" method="POST" action="../produtos/procura_produto.php">
						<div class="input-group"><input type="search" class="form-control" placeholder="Pesquisar" name="busca_produto" style="width: 400px;" >
						  <div class="input-group-prepend">
							<button class="input-group-text btn btn-outline-success" type="submit">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
								<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
								</svg>
							</button>
						  </div>
						</div>
					  </form>
				  </li>
				  </ul></div>
				  <ul><li><a type="button" class="btn btn-success me-4" href="../produtos/ver_carrinho.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg><span>'.$img_carrinho.'</span>
                                        </a><button type="button" class="btn btn-info me-4" data-toggle="modal" data-target="#exampleModal">
					<span class="navbar-toggler-icon"></span>
					</button></li>
					</ul>';
					}
					?></nav>
    <div class="modal left fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
					<!-- Aqui será a separação de cada opção do menu modal -->
					<ul class="nav nav-pills flex-column"><li class="nav-item">
					<a type="button" href="#" class="btn btn-info mt-2" style="width: 230px;">Categoria de produtos</a>
					<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split mt-2" data-toggle="collapse" data-target="#bta">
					<span class="visually-hidden"></span>
					</button></li>
					<li class="nav-item ">
						<div id="bta" class="collapse mt-2">
							<ul class="nav nav-pills flex-column bg-secondary rounded">
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=acessorios">Acessórios</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=audio">Audio</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=baterias">Baterias</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=cabos">Cabos</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=capinhas">Capinhas</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=celulares">Celulares</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=computadores">Computadores</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=conectores">Conectores</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=CTV">CTV</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=display">Display/Touch</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=eletronicos">Eletrônicos</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=ferramenta_cel">Ferramentas p/ celular</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=ferramenta_CPU">Ferramentas p/ PC's</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=peliculas">Peliculas</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="procura_produto.php?categoria=placa_cel">Placas de celular</a></li>
							</ul>
						</div>
					</li></ul>
					
						<!-- Aqui será a separação de cada opção do menu modal -->
					<ul class="nav nav-pills flex-column"><li class="nav-item">
					<a type="button" href="#" class="btn btn-info mt-2" style="width: 230px;">Serviços</a>
					<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split mt-2" data-toggle="collapse" data-target="#btb">
					<span class="visually-hidden"></span>
					</button></li>
					<li class="nav-item">
						<div id="btb" class="collapse mt-2">
							<ul class="nav nav-pills flex-column bg-secondary rounded">
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">HTML</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">CSS</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">JavaScript</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">PHP</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Python</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">jQuery</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">SQL</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Bootstrap</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Node.js</a></li>
							</ul>
						</div>
					</li></ul>
					
						<!-- Aqui será a separação de cada opção do menu modal -->
					<ul class="nav nav-pills flex-column"><li class="nav-item">
					<a type="button" href="#" class="btn btn-info mt-2 " style="width: 230px;">Endereço</a>
					<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split mt-2" data-toggle="collapse" data-target="#btc">
					<span class="visually-hidden"></span>
					</button></li>
					<li class="nav-item">
						<div id="btc" class="collapse mt-2">
							<ul class="nav nav-pills flex-column bg-secondary rounded">
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">HTML</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">CSS</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">JavaScript</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">PHP</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Python</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">jQuery</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">SQL</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Bootstrap</a></li>
							  <li class="nav-item"><a class="btn btn-secondary" style="width: 100%;" href="#">Node.js</a></li>
							</ul>
						</div>
					</li></ul>
					</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
        </div>