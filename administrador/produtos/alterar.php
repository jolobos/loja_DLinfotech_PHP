<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

// inserindo a foto do produto na pasta de produtos
if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    if($extensao == '.png' || $extensao == '.jpg' || $extensao == '.svg' || $extensao == '.gif'){
    $novo_nome = md5(microtime()) . $extensao; //define o nome do arquivo
    $diretorio = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); //efetua o upload
    $foto_pr = $novo_nome;
}else{
    if(!empty($_POST['foto_pr'])){
        $foto_pr = $_POST['foto_pr'];
    } else {
    $foto_pr = 'produto_null.png'; }}}

if(isset($_FILES['arquivo1'])){
    $extensao1 = strtolower(substr($_FILES['arquivo1']['name'], -4)); //pega a extensao do arquivo
    if($extensao1 == '.png' || $extensao1 == '.jpg' || $extensao1 == '.svg' || $extensao1 == '.gif'){
    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo
    $diretorio1 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo1']['tmp_name'], $diretorio1.$novo_nome1); //efetua o upload
    $foto_1 = $novo_nome1;
}else{
    if(!empty($_POST['foto_1'])){
        $foto_1 = $_POST['foto_1'];
} else {$foto_1 = ''; }}}
if(isset($_FILES['arquivo2'])){
    $extensao2 = strtolower(substr($_FILES['arquivo2']['name'], -4)); //pega a extensao do arquivo
    if($extensao2 == '.png' || $extensao2 == '.jpg' || $extensao2 == '.svg' || $extensao2 == '.gif'){
    $novo_nome2 = md5(microtime()) . $extensao2; //define o nome do arquivo
    $diretorio2 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo2']['tmp_name'], $diretorio2.$novo_nome2); //efetua o upload
    $foto_2 = $novo_nome2;
}else{
        if(!empty($_POST['foto_2'])){
        $foto_2 = $_POST['foto_2'];
    } else {    
$foto_2 = ''; }}}
if(isset($_FILES['arquivo3'])){
    $extensao3 = strtolower(substr($_FILES['arquivo3']['name'], -4)); //pega a extensao do arquivo
    if($extensao3 == '.png' || $extensao3 == '.jpg' || $extensao3 == '.svg' || $extensao3 == '.gif'){
    $novo_nome3 = md5(microtime()) . $extensao3; //define o nome do arquivo
    $diretorio3 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo3']['tmp_name'], $diretorio3.$novo_nome3); //efetua o upload
    $foto_3 = $novo_nome3;
}else{
    if(!empty($_POST['foto_3'])){
        $foto_3 = $_POST['foto_3'];
    } else {    
    
    $foto_3 = ''; }}}
if(isset($_FILES['arquivo4'])){
    $extensao4 = strtolower(substr($_FILES['arquivo4']['name'], -4)); //pega a extensao do arquivo
     if($extensao4 == '.png' || $extensao4 == '.jpg' || $extensao4 == '.svg' || $extensao4 == '.gif'){
   $novo_nome4 = md5(microtime()) . $extensao4; //define o nome do arquivo
    $diretorio4 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo4']['tmp_name'], $diretorio4.$novo_nome4); //efetua o upload
    $foto_4 = $novo_nome4;
}else{
    if(!empty($_POST['foto_4'])){
        $foto_4 = $_POST['foto_4'];
    } else {    
    
$foto_4 = ''; }}}
if(isset($_FILES['arquivo5'])){
    $extensao5 = strtolower(substr($_FILES['arquivo5']['name'], -4)); //pega a extensao do arquivo
    if($extensao5 == '.png' || $extensao5 == '.jpg' || $extensao5 == '.svg' || $extensao5 == '.gif'){
    $novo_nome5 = md5(microtime()) . $extensao5; //define o nome do arquivo
    $diretorio5 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo5']['tmp_name'], $diretorio5.$novo_nome5); //efetua o upload
    $foto_5 = $novo_nome5;
}else{
    if(!empty($_POST['foto_5'])){
        $foto_5 = $_POST['foto_5'];
    } else {    
$foto_5 = ''; }}}
if(isset($_FILES['arquivo6'])){
    $extensao6 = strtolower(substr($_FILES['arquivo6']['name'], -4)); //pega a extensao do arquivo
    if($extensao6 == '.png' || $extensao6 == '.jpg' || $extensao6 == '.svg' || $extensao6 == '.gif'){
    $novo_nome6 = md5(microtime()) . $extensao6; //define o nome do arquivo
    $diretorio6 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo6']['tmp_name'], $diretorio6.$novo_nome6); //efetua o upload
    $foto_6 = $novo_nome6;
}else{
    if(!empty($_POST['foto_6'])){
        $foto_6 = $_POST['foto_6'];
    } else {    
$foto_6 = ''; }}}

//adicionando na sql produtos:
//Para cada checkbox eu tenho que colocar a condição de vazio.
if(!empty($_POST['azul'])){$azul = $_POST['azul'];}else{ $azul = 0;}
if(!empty($_POST['vermelho'])){$vermelho = $_POST['vermelho'];}else{ $vermelho = 0;}
if(!empty($_POST['preto'])){$preto = $_POST['preto'];}else{ $preto = 0;}
if(!empty($_POST['branco'])){$branco = $_POST['branco'];}else{ $branco = 0;}
if(!empty($_POST['amarelo'])){$amarelo = $_POST['amarelo'];}else{ $amarelo = 0;}
if(!empty($_POST['verde'])){$verde = $_POST['verde'];}else{ $verde = 0;}
if(!empty($_POST['laranja'])){$laranja = $_POST['laranja'];}else{ $laranja = 0;}
if(!empty($_POST['cinza'])){$cinza = $_POST['cinza'];}else{ $cinza = 0;}
if(!empty($_POST['rosa'])){$rosa = $_POST['rosa'];}else{ $rosa = 0;}
if(!empty($_POST['marrom'])){$marrom = $_POST['marrom'];}else{ $marrom = 0;}
if(!empty($_POST['roxo'])){$roxo = $_POST['roxo'];}else{ $roxo = 0;}
if(!empty($_POST['prata'])){$prata = $_POST['prata'];}else{ $prata = 0;}
if(!empty($_POST['dourado'])){$dourado = $_POST['dourado'];}else{ $dourado = 0;}
    

if(!empty($_POST['id_produto'])){
        $id_produto = $_POST['id_produto'];
//Lançando o produto no sgbd    
    $cod_produto = $_POST['cod_produto'];		
    $nome= $_POST['nome'];		
    $valor= $_POST['valor'];		
    $quantidade = $_POST['quantidade'];		
    $categoria = $_POST['categoria'];		
    $cor = $_POST['cor'];		
    $voltagem = $_POST['voltagem'];		
    $voltagem_opcoes = $_POST['voltagem_opcoes'];		
    $descricao = $_POST['descricao'];		
    $status = $_POST['status'];		
    $sql ='UPDATE produtos SET cod_produto=?,nome=?,valor=?,quantidade=?,categoria=?,cor=?,voltagem=?,voltagem_opcoes=?,descricao=?,status=?,foto=?,foto_1=?,foto_2=?,foto_3=?,foto_4=?,foto_5=?,foto_6=?,azul=?,vermelho=?,preto=?,branco=?,amarelo=?,verde=?,laranja=?,cinza=?,rosa=?,marrom=?,roxo=?,prata=?,dourado=? WHERE id_produto = '.$id_produto.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($cod_produto,$nome,$valor,$quantidade,$categoria,$cor,$voltagem,$voltagem_opcoes,$descricao,$status,$foto_pr,$foto_1,$foto_2,$foto_3,$foto_4,$foto_5,$foto_6,$azul,$vermelho,$preto,$branco,$amarelo,$verde,$laranja,$cinza,$rosa,$marrom,$roxo,$prata,$dourado));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
// Lançando ficha técnica no sgbd
if ($ok){
    
    $tamanho = $_POST['tamanho'];
    $altura = $_POST['altura'];
    $largura = $_POST['largura'];
    $peso = $_POST['peso'];
    $potencia = $_POST['potencia'];
    $fabricante = $_POST['fabricante'];
    $garantia = $_POST['garantia'];
    $voltagem = $_POST['voltagem'];
    $temperatura_max = $_POST['temperatura_max'];
    $temperatura_min = $_POST['temperatura_min'];
    $capacidade_armazenamento = $_POST['capacidade_armazenamento'];
    $durabilidade = $_POST['durabilidade'];
    $tempo_recarga = $_POST['tempo_recarga'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $velocidade = $_POST['velocidade'];
    $prova_agua = $_POST['prova_agua'];
    $resistente_agua = $_POST['resistente_agua'];
    $descricao_longa = $_POST['descricao_longa'];
    
    $sql ='UPDATE ficha_tec_produto SET tamanho=?,altura=?,largura=?,peso=?,potencia=?,fabricante=?,garantia=?,voltagem=?,temperatura_max=?,temperatura_min=?,capacidade_armazenamento=?,durabilidade=?,tempo_recarga=?,marca=?,modelo=?,descricao_longa=?,prova_agua=?,resistente_agua=?,velocidade=? WHERE id_produto='.$id_produto.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok1 = $insercao->execute(array ($tamanho,$altura,$largura,$peso,$potencia,$fabricante,$garantia,$voltagem,$temperatura_max,$temperatura_min,$capacidade_armazenamento,$durabilidade,$tempo_recarga,$marca,$modelo,$descricao_longa,$prova_agua,$resistente_agua,$velocidade));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
    }
   
if($ok1){    
    $msg= 'O produto foi alterado no Banco de dados sem problema.';
}else{
    $msg='Lamento, não foi possivel cadastrar o produto.'.$r->getMessage().'---->'.$_POST['tamanho'].'--->'.$_POST['marca'].'';
}}else{
    $msg='Lamento, Não inserido no sgbd ´produtos´.'.$r->getMessage().'';

}
header('location:ver.php?mensagem='.$msg.'&id_produto='.$id_produto);
}

?>




<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos do sistema - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func_pr.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para produtos
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="produtos.php">Produtos</a></br>
				<a class="btn btn-secondary border-danger m-2" href="add_produto.php">Inserir Produto</a></br>
				<a class="btn btn-secondary border-warning m-2" href="linkar_produto.php">Linkar cores de produtos</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_quantidade.php">Controle de quantidade</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_saida_produto.php">Controle de saida</a></br>
				
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
      
<div class="card mt-2">
        <div class="card-header">
            <h4 class="text-info">Alteração do produto</h4>
		</div>
    <div class="card-body">
        <?php
        if(!empty($_GET['id_produto'])){
        $id = $_GET['id_produto'];
        $sql = "SELECT * FROM produtos WHERE id_produto = '".$id."'";
        $consulta = $conexao->query($sql);
        $dados = $consulta->fetch(PDO::FETCH_ASSOC);

        $sql1 = "SELECT * FROM ficha_tec_produto WHERE id_produto = '".$id."'";
        $consulta1 = $conexao->query($sql1);
        $dados1 = $consulta1->fetch(PDO::FETCH_ASSOC);

        if($dados['status'] > 0){ $status = 'ativo';}else{ $status = 'desativado';}
        if(!empty($dados1)){
        if($dados1['prova_agua'] > 0){ $p_agua= 'sim';}else{ $p_agua = 'nao';}
        if($dados1['resistente_agua'] > 0){ $r_agua = 'sim';}else{ $r_agua= 'nao';}}
        
        
echo '<div style="width: 50%;margin:auto;">
    
        <form action="alterar.php"  method="POST" enctype="multipart/form-data" >
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label class="form-label">Código do produto:</label>
            <input class="form-control " placeholder="Código do produto" name="cod_produto" value="'.$dados['cod_produto'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Nome do produto:</label>
            <input class="form-control" placeholder="Digite o nome do produto" name="nome" value="'.$dados['nome'].'" >
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Valor:</label>
            <input class="form-control" placeholder="Digite o valor" name="valor" value="'.$dados['valor'].'">
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Quantidade:</label>
            <input class="form-control" placeholder="Digite a quantidade " name="quantidade" value="'.$dados['quantidade'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Categoria: '.$dados['categoria'].'</label>
            
            <select class="form-control" name="categoria" >
            <option>Categorias</option>
            <option value="eletronicos">Eletrônicos</option>
            <option value="acessorios">Acessórios</option>
            <option value="capinhas">Capinhas</option>
            <option value="carregadores">Carregadores</option>
            <option value="peliculas">Peliculas</option>
            <option value="CPU">Computadores</option>
            <option value="celular">Celulares</option>
            <option value="CTV">CTV</option>
            <option value="display">Display/Touch</option>
            <option value="conectores">Conectores</option>
            <option value="cabos">Cabos</option>
            <option value="ferramenta_cel">Ferramentas p/ celular</option>
            <option value="ferramenta_CPU">Ferramentas p/ PC´s</option>
            <option value="placa_cel">Placas celular</option>
            <option value="baterias">Baterias</option>
            <option value="audio">Audio/Som</option>
            </select>
            </div>
			
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label class="form-label">Cor:</label>
            <input class="form-control" placeholder="Digite a cor " name="cor" value="'.$dados['cor'].'">
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Voltagem: '.$dados['voltagem'].'</label>
            <select class="form-control" name="voltagem" >
            <option value="110">110 V</option>
            <option value="220">220 V</option>
            <option value="bivolt">Bi-volt</option>
            </select>            
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Opções de voltagem: '.$dados['voltagem_opcoes'].'</label>
            <select class="form-control" name="voltagem_opcoes" >
            <option value="110">110 V</option>
            <option value="220">220 V</option>
            <option value="bivolt">Bi-volt</option>
            </select>
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Descrição:</label>
            <input class="form-control" placeholder="Digite a descrição " name="descricao" value="'.$dados['descricao'].'">
            </div>
			<div class="mb-3 mt-3">
            <label class="form-label">Status:</label>
            <select class="form-control" name="status" >
            <option value="1">Ativo</option>
            <option value="0">Desativado</option>
            </select>
            </div>
            </div>
            </div>
            ';
            if($dados['azul'] > 0){ $check_azul = 'checked';}else{ $check_azul = '';}
            if($dados['vermelho'] > 0){ $check_vermelho = 'checked';}else{ $check_vermelho = '';}
            if($dados['preto'] > 0){ $check_preto = 'checked';}else{ $check_preto = '';}
            if($dados['branco'] > 0){ $check_branco = 'checked';}else{ $check_branco = '';}
            if($dados['amarelo'] > 0){ $check_amarelo = 'checked';}else{ $check_amarelo = '';}
            if($dados['verde'] > 0){ $check_verde = 'checked';}else{ $check_verde = '';}
            if($dados['laranja'] > 0){ $check_laranja = 'checked';}else{ $check_laranja = '';}
            if($dados['cinza'] > 0){ $check_cinza = 'checked';}else{ $check_cinza = '';}
            if($dados['rosa'] > 0){ $check_rosa = 'checked';}else{ $check_rosa = '';}
            if($dados['marrom'] > 0){ $check_marrom = 'checked';}else{ $check_marrom = '';}
            if($dados['roxo'] > 0){ $check_roxo = 'checked';}else{ $check_roxo = '';}
            if($dados['prata'] > 0){ $check_prata = 'checked';}else{ $check_prata = '';}
            if($dados['dourado'] > 0){ $check_dourado = 'checked';}else{ $check_dourado = '';}

            echo '<h5>Variações de cores</h5>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="azul" '.$check_azul.'>
              <label class="form-check-label" for="defaultCheck1">
                Azul
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck2" name="vermelho" '.$check_vermelho.'>
              <label class="form-check-label" for="defaultCheck2">
                Vermelho
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck3" name="preto" '.$check_preto.'>
              <label class="form-check-label" for="defaultCheck3">
                Preto
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck4" name="branco" '.$check_branco.'>
              <label class="form-check-label" for="defaultCheck4">
                Branco
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck5" name="amarelo" '.$check_amarelo.'>
              <label class="form-check-label" for="defaultCheck5">
                Amarelo
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck6" name="verde" '.$check_verde.'>
              <label class="form-check-label" for="defaultCheck6">
                Verde
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck7" name="laranja" '.$check_laranja.'>
              <label class="form-check-label" for="defaultCheck7">
                Laranja
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck8" name="cinza" '.$check_cinza.'>
              <label class="form-check-label" for="defaultCheck8">
                Cinza
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck9" name="rosa" '.$check_rosa.'>
              <label class="form-check-label" for="defaultCheck9">
                Rosa
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck10" name="marrom" '.$check_marrom.'>
              <label class="form-check-label" for="defaultCheck10">
                Marrom
              </label>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck11" name="roxo" '.$check_roxo.'>
              <label class="form-check-label" for="defaultCheck11">
                Roxo
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck12" name="prata" '.$check_prata.'>
              <label class="form-check-label" for="defaultCheck12">
                Prata
              </label>
            </div>
            </div>
            <div class="col" >            
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="defaultCheck13" name="dourado" '.$check_dourado.'>
              <label class="form-check-label" for="defaultCheck13">
                Dourado
              </label>
            </div>
            </div>
            <div class="col" >            
            </div>
            <div class="col" >            
            </div>
            </div>
            
            <div class="mb-3 mt-3" align="center">
            
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmação para alterar produto</h5>
                </div>
                <div class="modal-body">
                  <p class="text-white text-start">Para alterar o seu produto, clique em salvar produto.</p>
                  <p class="text-white text-start">Se não terminou de configurar, clique em fechar.</p>
                </div>
                <div class="modal-footer">
                   <input type="hidden" name="id_produto" value="'.$id.'">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Salvar produto</button>
                </div>
              </div>
            </div>
          </div> 
        </div>';

//Parte para inserir a foto do produto
if($dados['foto'] != ''){ $foto_pr = $dados['foto'] ;}else{ $foto_pr = 'produto_null.png';}
if($dados['foto_1'] != ''){ $foto_1 = $dados['foto_1'] ;}else{ $foto_1 = 'produto_null.png';}
if($dados['foto_2'] != ''){ $foto_2 = $dados['foto_2'] ;}else{ $foto_2 = 'produto_null.png';}
if($dados['foto_3'] != ''){ $foto_3 = $dados['foto_3'] ;}else{ $foto_3 = 'produto_null.png';}
if($dados['foto_4'] != ''){ $foto_4 = $dados['foto_4'] ;}else{ $foto_4 = 'produto_null.png';}
if($dados['foto_5'] != ''){ $foto_5 = $dados['foto_5'] ;}else{ $foto_5 = 'produto_null.png';}
if($dados['foto_6'] != ''){ $foto_6 = $dados['foto_6'] ;}else{ $foto_6 = 'produto_null.png';}

echo '<h1>Foto do produto</h1>';
              echo '<div class="card p-2">
                     <label class="form-check-label">
                        Foto Principal:
                     </label>
                     <img src="../../img/produtos/'.$foto_pr.'" width=15% class="border">
                     <input type="hidden" name="foto_pr" value="'.$foto_pr.'">
                    <input class="form-control mt-1" type="file" name="arquivo">
		</div>
                <div class="row mt-2">
                <div class="col card p-1">
                <label class="form-check-label">
                        Foto 1:
                     </label>
                     <img src="../../img/produtos/'.$foto_1.'" width=100 height=100 class="border">
                     <input type="hidden" name="foto_1" value="'.$foto_1.'">
                    <input class="form-control mt-1" type="file" name="arquivo1">
		</div>
                <div class="col card p-1">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 2:
                     </label>
                     <img src="../../img/produtos/'.$foto_2.'" width=100 height=100 class="border">
                    <input type="hidden" name="foto_2" value="'.$foto_2.'">
                    <input class="form-control mt-1" type="file" name="arquivo2">
		</div>
		</div>
                <div class="row mt-2">
                <div class="col card p-1">
                <label class="form-check-label" for="defaultCheck13">
                        Foto3:
                     </label>
                     <img src="../../img/produtos/'.$foto_3.'" width=100 height=100 class="border">
                    <input type="hidden" name="foto_3" value="'.$foto_3.'">
                    <input class="form-control mt-1" type="file" name="arquivo3">
		</div>
                <div class="col card p-1">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 4:
                     </label>
                     <img src="../../img/produtos/'.$foto_4.'" width=100 height=100 class="border">
                    <input type="hidden" name="foto_4" value="'.$foto_4.'">
                    <input class="form-control mt-1" type="file" name="arquivo4">
		</div>
                </div>
                <div class="row mt-2">
                <div class="col card p-1">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 5:
                     </label>
                     <img src="../../img/produtos/'.$foto_5.'" width=100 height=100 class="border">
                     <input type="hidden" name="foto_5" value="'.$foto_5.'">
                    <input class="form-control mt-1" type="file" name="arquivo5">
		</div>
                <div class="col card p-1">
                <label class="form-check-label" for="defaultCheck13">
                        Foto 6:
                     </label>
                     <img src="../../img/produtos/'.$foto_6.'" width=100 height=100  class="border">
                    <input type="hidden" name="foto_6" value="'.$foto_6.'">
                    <input class="form-control mt-1" type="file" name="arquivo6">
		</div>
		</div>';
              
//parte da ficha técnica
if(!empty($dados1)){              
echo '<h1 class="mt-3">Ficha técnica do produto</h1>		
<div class="row">
    <div class="col" >            
    <div class="mb-3 mt-3">
    <label class="form-label">Tamanho do produto:</label>
    <input class="form-control" placeholder="Digite o tamanho" name="tamanho" value="'.$dados1['tamanho'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Altura:</label>
    <input class="form-control" placeholder="Digite a altura" name="altura" value="'.$dados1['altura'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Largura:</label>
    <input class="form-control" placeholder="Digite a largura" name="largura" value="'.$dados1['largura'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Peso:</label>
    <input class="form-control" placeholder="Digite o peso" name="peso" value="'.$dados1['peso'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Potência:</label>
    <input class="form-control" placeholder="Digite a potência" name="potencia" value="'.$dados1['potencia'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Fabricante:</label>
    <input class="form-control" placeholder="Digite o fabricante " name="fabricante" value="'.$dados1['fabricante'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Garantia:</label>
    <input class="form-control" placeholder="Digite a garantia " name="garantia" value="'.$dados1['garantia'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Temperatura Máxima:</label>
    <input class="form-control" placeholder="Digite a temperatura máxima " name="temperatura_max" value="'.$dados1['temperatura_max'].'">
    </div>
    </div>
    <div class="col">            
    
    <div class="mb-3 mt-3">
    <label class="form-label">Temperatura mínima:</label>
    <input class="form-control" placeholder="Digite a temperatura mínima " name="temperatura_min" value="'.$dados1['temperatura_min'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Armazenamento:</label>
    <input class="form-control" placeholder="Digite o armazenamento" name="capacidade_armazenamento" value="'.$dados1['capacidade_armazenamento'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Durabilidade:</label>
    <input class="form-control" placeholder="Digite a durabilidade" name="durabilidade" value="'.$dados1['durabilidade'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Recarga:</label>
    <input class="form-control" placeholder="Digite o tempo de recarga" name="tempo_recarga" value="'.$dados1['tempo_recarga'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Marca:</label>
    <input class="form-control" placeholder="Digite a marca" name="marca" value="'.$dados1['marca'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Modelo:</label>
    <input class="form-control" placeholder="Digite o modelo" name="modelo" value="'.$dados1['modelo'].'">
    </div>
    <div class="mb-3 mt-3">
    <label class="form-label">Velocidade:</label>
    <input class="form-control" placeholder="Digite a velocidade" name="velocidade" value="'.$dados1['velocidade'].'">
    </div>
    
    <div class="row">
    <div class="col">
    <div>
    <label class="form-label">Prova d´agua:</label>
    <select class="form-control" name="prova_agua" >
    <option value="0">Não</option>
    <option value="1">Sim</option>
    </select>
    </div>
    </div>
    <div class="col">
    <div>
    <label class="form-label">Resistente à agua:</label>
    <select class="form-control" name="resistente_agua" >
    <option value="0">Não</option>
    <option value="1">Sim</option>
    </select>
    </div>
    </div>
    </div>
    

    </div>
    </div>    
    <div class="mb-3 mt-3">
        <label class="form-label">Descrição completa:</label>
        <textarea class="form-control" rows="6" name="descricao_longa">'.$dados1['descricao_longa'].'</textarea>
    </div>    
    
                </div>';
}
echo '<div align="center">    
                <button type="button" class="btn btn-primary mt-3 " data-toggle="modal" data-target="#modalExemplo">
                    Salvar as configurações   
                </button></div></form></div>';

        }

        
        ?>
        
    </div>
    
</div> 
      
</div>    