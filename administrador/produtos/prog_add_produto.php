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
}else{$foto_pr = 'produto_null'; }}

if(isset($_FILES['arquivo1'])){
    $extensao1 = strtolower(substr($_FILES['arquivo1']['name'], -4)); //pega a extensao do arquivo
    if($extensao1 == '.png' || $extensao1 == '.jpg' || $extensao1 == '.svg' || $extensao1 == '.gif'){
    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo
    $diretorio1 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo1']['tmp_name'], $diretorio1.$novo_nome1); //efetua o upload
    $foto_1 = $novo_nome1;
}else{$foto_1 = ''; }}
if(isset($_FILES['arquivo2'])){
    $extensao2 = strtolower(substr($_FILES['arquivo2']['name'], -4)); //pega a extensao do arquivo
    if($extensao2 == '.png' || $extensao2 == '.jpg' || $extensao2 == '.svg' || $extensao2 == '.gif'){
    $novo_nome2 = md5(microtime()) . $extensao2; //define o nome do arquivo
    $diretorio2 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo2']['tmp_name'], $diretorio2.$novo_nome2); //efetua o upload
    $foto_2 = $novo_nome2;
}else{$foto_2 = ''; }}
if(isset($_FILES['arquivo3'])){
    $extensao3 = strtolower(substr($_FILES['arquivo3']['name'], -4)); //pega a extensao do arquivo
    if($extensao3 == '.png' || $extensao3 == '.jpg' || $extensao3 == '.svg' || $extensao3 == '.gif'){
    $novo_nome3 = md5(microtime()) . $extensao3; //define o nome do arquivo
    $diretorio3 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo3']['tmp_name'], $diretorio3.$novo_nome3); //efetua o upload
    $foto_3 = $novo_nome3;
}else{$foto_3 = ''; }}
if(isset($_FILES['arquivo4'])){
    $extensao4 = strtolower(substr($_FILES['arquivo4']['name'], -4)); //pega a extensao do arquivo
     if($extensao4 == '.png' || $extensao4 == '.jpg' || $extensao4 == '.svg' || $extensao4 == '.gif'){
   $novo_nome4 = md5(microtime()) . $extensao4; //define o nome do arquivo
    $diretorio4 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo4']['tmp_name'], $diretorio4.$novo_nome4); //efetua o upload
    $foto_4 = $novo_nome4;
}else{$foto_4 = ''; }}
if(isset($_FILES['arquivo5'])){
    $extensao5 = strtolower(substr($_FILES['arquivo5']['name'], -4)); //pega a extensao do arquivo
    if($extensao5 == '.png' || $extensao5 == '.jpg' || $extensao5 == '.svg' || $extensao5 == '.gif'){
    $novo_nome5 = md5(microtime()) . $extensao5; //define o nome do arquivo
    $diretorio5 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo5']['tmp_name'], $diretorio5.$novo_nome5); //efetua o upload
    $foto_5 = $novo_nome5;
}else{$foto_5 = ''; }}
if(isset($_FILES['arquivo6'])){
    $extensao6 = strtolower(substr($_FILES['arquivo6']['name'], -4)); //pega a extensao do arquivo
    if($extensao6 == '.png' || $extensao6 == '.jpg' || $extensao6 == '.svg' || $extensao6 == '.gif'){
    $novo_nome6 = md5(microtime()) . $extensao6; //define o nome do arquivo
    $diretorio6 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo6']['tmp_name'], $diretorio6.$novo_nome6); //efetua o upload
    $foto_6 = $novo_nome6;
}else{$foto_6 = ''; }}

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
    

if(!empty($_POST['cod_produto']) && !empty($_POST['valor']) && !empty($_POST['quantidade'])){
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
			
    $sql ='INSERT INTO produtos(cod_produto,nome,valor,quantidade,categoria,cor,voltagem,voltagem_opcoes,descricao,status,foto,foto_1,foto_2,foto_3,foto_4,foto_5,foto_6,azul,vermelho,preto,branco,amarelo,verde,laranja,cinza,rosa,marrom,roxo,prata,dourado)
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
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
    $sql = "SELECT id_produto FROM produtos ORDER BY id_produto DESC LIMIT 0,1";
    $consulta = $conexao->query($sql);
    $d = $consulta->fetch(PDO::FETCH_ASSOC);
    
    $id_produto = $d['id_produto'];
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
    
    $sql ='INSERT INTO ficha_tec_produto(id_produto,tamanho,altura,largura,peso,potencia,fabricante,garantia,voltagem,temperatura_max,temperatura_min,capacidade_armazenamento,durabilidade,tempo_recarga,marca,modelo,descricao_longa,prova_agua,resistente_agua,velocidade)
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok1 = $insercao->execute(array ($id_produto,$tamanho,$altura,$largura,$peso,$potencia,$fabricante,$garantia,$voltagem,$temperatura_max,$temperatura_min,$capacidade_armazenamento,$durabilidade,$tempo_recarga,$marca,$modelo,$descricao_longa,$prova_agua,$resistente_agua,$velocidade));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
    }
   
if($ok1){    
    $msg= 'O produto foi inserido no Banco de dados sem problema.';
}else{
    $msg='Lamento, não foi possivel cadastrar o produto.'.$r->getMessage().'---->'.$_POST['tamanho'].'--->'.$_POST['marca'].'';
}}else{
    $msg='Lamento, Não inserido no sgbd ´produtos´.'.$r->getMessage().'';

}
header('location:add_produto.php?mensagem='.$msg);
}else{
$msg = 'Não é possivel inserir produto com campos vazio.';    
header('location:add_produto.php?mensagem='.$msg);

}
echo '<p>'.$_GET['mensagem'].'</p>';

?>