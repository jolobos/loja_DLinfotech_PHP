<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

// inserindo a foto do produto na pasta de produtos
 if(isset($_FILES['arquivo'])){
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    $novo_nome = md5(microtime()) . $extensao; //define o nome do arquivo
    $diretorio = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); //efetua o upload
    $foto_pr = $novo_nome;
}
if(isset($_FILES['arquivo1'])){
    $extensao1 = strtolower(substr($_FILES['arquivo1']['name'], -4)); //pega a extensao do arquivo
    $novo_nome1 = md5(microtime()) . $extensao1; //define o nome do arquivo
    $diretorio1 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo1']['tmp_name'], $diretorio1.$novo_nome1); //efetua o upload
    $foto_1 = $novo_nome1;
}
if(isset($_FILES['arquivo2'])){
    $extensao2 = strtolower(substr($_FILES['arquivo2']['name'], -4)); //pega a extensao do arquivo
    $novo_nome2 = md5(microtime()) . $extensao2; //define o nome do arquivo
    $diretorio2 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo2']['tmp_name'], $diretorio2.$novo_nome2); //efetua o upload
    $foto_2 = $novo_nome2;
}
if(isset($_FILES['arquivo3'])){
    $extensao3 = strtolower(substr($_FILES['arquivo3']['name'], -4)); //pega a extensao do arquivo
    $novo_nome3 = md5(microtime()) . $extensao3; //define o nome do arquivo
    $diretorio3 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo3']['tmp_name'], $diretorio3.$novo_nome3); //efetua o upload
    $foto_3 = $novo_nome3;
}
if(isset($_FILES['arquivo4'])){
    $extensao4 = strtolower(substr($_FILES['arquivo4']['name'], -4)); //pega a extensao do arquivo
    $novo_nome4 = md5(microtime()) . $extensao4; //define o nome do arquivo
    $diretorio4 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo4']['tmp_name'], $diretorio4.$novo_nome4); //efetua o upload
    $foto_4 = $novo_nome4;
}
if(isset($_FILES['arquivo5'])){
    $extensao5 = strtolower(substr($_FILES['arquivo5']['name'], -4)); //pega a extensao do arquivo
    $novo_nome5 = md5(microtime()) . $extensao5; //define o nome do arquivo
    $diretorio5 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo5']['tmp_name'], $diretorio5.$novo_nome5); //efetua o upload
    $foto_5 = $novo_nome5;
}
if(isset($_FILES['arquivo6'])){
    $extensao6 = strtolower(substr($_FILES['arquivo6']['name'], -4)); //pega a extensao do arquivo
    $novo_nome6 = md5(microtime()) . $extensao6; //define o nome do arquivo
    $diretorio6 = "../../img/produtos/"; //define o diretorio para onde enviaremos o arquivo
    move_uploaded_file($_FILES['arquivo6']['tmp_name'], $diretorio6.$novo_nome6); //efetua o upload
    $foto_6 = $novo_nome6;
}

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
	$cod_produto = $_POST['cod_produto'];		
	$nome= $_POST['nome'];		
	$valor= $_POST['valor'];		
	$quantidade = $_POST['quantidade'];		
	$categoria = $_POST['categoria'];		
	$cor = $_POST['cor'];		
	$voltagem = $_POST['voltagem'];		
	$voltagem_opcoes = $_POST['voltagem_opcoes'];		
	$descricao = $_POST['voltagem_opcoes'];		
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
			if ($ok){
				$msg= 'Seja Bem Vindo a DLInfotech.';
				}else{
					$msg='Lamento, não foi possivel cadastrar o usuario.'.$r->getMessage().'';
			}
			header('location:prog_add_produto.php?mensagem='.$msg);

}
//valores que chegam no POST
echo '<p>'.$msg.'</p>';
echo '<hr/><div class="container">';
if(!empty($_POST['confirma_post'])){
    echo '<div class=row><div class="col"><h4>Informações:</h4>';
    echo '<p>cod_produto: '.$_POST['cod_produto'].'</p>';
    echo '<p>nome: '.$_POST['nome'].'</p>';
    echo '<p>valor: '.$_POST['valor'].'</p>';
    echo '<p>quantidade: '.$_POST['quantidade'].'</p>';
    echo '<p>categoria: '.$_POST['categoria'].'</p>';
    echo '<p>cor: '.$_POST['cor'].'</p>';
    echo '<p>voltagem: '.$_POST['voltagem'].'</p>';
    echo '<p>voltagem_opcoes: '.$_POST['voltagem_opcoes'].'</p>';
    echo '<p>descricao: '.$_POST['descricao'].'</p>';
    echo '<p>status: '.$_POST['status'].'</p></div>';
    
    echo '<div class="col"> <h4>Cores do checkbox</h4><p>azul: '.$azul.'</p>';
    echo '<p>vermelho: '.$vermelho.'</p>';
    echo '<p>preto: '.$preto.'</p>';
    echo '<p>branco: '.$branco.'</p>';
    echo '<p>amarelo: '.$amarelo.'</p>';
    echo '<p>verde: '.$verde.'</p>';
    echo '<p>laranja: '.$laranja.'</p>';
    echo '<p>cinza: '.$cinza.'</p>';
    echo '<p>rosa: '.$rosa.'</p>';
    echo '<p>marrom: '.$marrom.'</p>';
    echo '<p>roxo: '.$roxo.'</p>';
    echo '<p>prata: '.$prata.'</p>';
    echo '<p>dourado: '.$dourado.'</p></div>';
  
    echo '<div class="col"> <h4>Fotos do produto</h4>';
    echo '<p>foto 1: '.$foto_pr.'</p>';
    echo '<p>foto 2: '.$foto_1.'</p>';
    echo '<p>foto 3: '.$foto_2.'</p>';
    echo '<p>foto 4: '.$foto_3.'</p>';
    echo '<p>foto 5: '.$foto_4.'</p>';
    echo '<p>foto 6: '.$foto_5.'</p>';
    echo '<p>foto 7: '.$foto_6.'</p> </div>';
  
   echo '<div class="col"> <h4>Ficha técnica</h4><p>cod_produto: '.$_POST['cod_produto'].'</p>';
    echo '<p>Tamanho: '.$_POST['tamanho'].'</p>';
    echo '<p>ltura: '.$_POST['altura'].'</p>';
    echo '<p>largura: '.$_POST['largura'].'</p>';
    echo '<p>Peso: '.$_POST['peso'].'</p>';
    echo '<p>Potência: '.$_POST['potencia'].'</p>';
    echo '<p>Fabricante: '.$_POST['fabricante'].'</p>';
    echo '<p>Garantia: '.$_POST['garantia'].'</p>';
    echo '<p>Voltagem: '.$_POST['voltagem'].'</p>';
    echo '<p>Temperatura max: '.$_POST['temperatura_max'].'</p>';
    echo '<p>Temperatura min: '.$_POST['temperatura_min'].'</p>';
    echo '<p>Capacidade: '.$_POST['capacidade_armazenamento'].'</p>';
    echo '<p>Durabilidade: '.$_POST['durabilidade'].'</p>';
    echo '<p>Recarga: '.$_POST['tempo_recarga'].'</p>';
    echo '<p>Marca: '.$_POST['marca'].'</p>';
    echo '<p>Modelo: '.$_POST['modelo'].'</p>';
    echo '<p>Velocidade: '.$_POST['velocidade'].'</p>';
    echo '<p>Prova d´agua: '.$_POST['prova_agua'].'</p>';
    echo '<p>Resistente agua: '.$_POST['resistente_agua'].'</p></div></div></div>';
    echo '<p>descricao: '.$_POST['descricao_longa'].'</p>';
    
    
}

?>