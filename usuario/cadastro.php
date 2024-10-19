<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
require_once ('../database.php');
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_POST) ){
    $nome_v = $_POST['nome'];
    $email_v = $_POST['email'];
    $sql= 'SELECT nome,email FROM usuarios WHERE nome= ? or email= ?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($nome_v,$email_v));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);

    $nome_ve = $dado['nome'];
    $email_ve = $dado['email'];
    if(!empty($nome_ve || $email_ve)){
        $msg = 'o Nome ou E-mail do usuário já existe em nosso banco de dados';
        header('location:cadastro.php?mensagem='.$msg);
    }else{
    
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$celular = $_POST['telefone'];
$senha1 = md5($_POST['senha1']);
$senha2 = md5($_POST['senha2']);
$data = date("Y-m-d H:i:s");
$status = 1;
if($senha1 == $senha2){
		$sql ='INSERT INTO usuarios(nome,email,celular,telefone,senha,data_entrada,status) values(?,?,?,?,?,?,?)';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($nome,$email,$celular,$telefone,$senha1,$data,$status));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Seja Bem Vindo a DLInfotech.';
                                $sql = 'SELECT * FROM usuarios WHERE email=?';
                                $consulta = $conexao->prepare($sql);
                                $consulta->execute(array($email));
                                $dado = $consulta->fetch(PDO::FETCH_ASSOC);
                                $res = $consulta->rowCount();
                                $senha = md5($_POST['senha1']);

                                if($res==1){
                                        if($senha==$dado['senha']){
                                        $_SESSION['email'] = $dado['email'];
                                        $_SESSION['id_usuario'] = $dado['id_usuario'];
                                        $_SESSION['administrador'] = $dado['administrador'];
                                        $_SESSION['apelido'] = $dado['apelido'];
                                        $_SESSION['foto'] = $dado['foto'];
                                        $_SESSION['nome'] = $dado['nome'];
                                        $_SESSION['vida'] = 1000; //segundos
                                        $_SESSION['decorrido'] = time();
                                        header('location:../index.php?mens='.$msg);
                        }}}else{
					$msg='Lamento, não foi possivel cadastrar o usuario.'.$r->getMessage().'';
			}
			header('location:../index.php?mensagem='.$msg);
                }else{
                 $msg = 'Por favor, digite as senhas corretamente para o cadastro!!!';  
                 header('location:cadastro.php?mensagem='.$msg);
   
                }

}}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Casdatre-se e aproveite nossos produtos</title>
</head>

<body>
  <?php
    if(!empty($_GET)){
        $msg = $_GET['mensagem'];
        
        echo '<div align="center" style=" height: 50px;width: 1000px;position: absolute;top: 8px;margin: auto;border-radius;border: 2px solid #191970;
  border-radius: 25px;background:#FF6347;">
        <h3 style="margin-top: 10px ;">Desculpa, '.$msg.'. </h3></div>';
    }
    ?>
    <div class="box" style="justify-content: center;margin-top: 40px">
        <div class="img-box">
            <img src="../img/img_cadastro.svg">
        </div>
        <div class="form-box">
            <h2>Criar Conta</h2>
            <p> Já é um membro? <a href="login.php"> Login </a> </p>
            <form action="cadastro.php" method="post">
                <div class="input-group">
                    <label for="nome"> Nome Completo</label>
                    <input type="text" name="nome" placeholder="Digite o seu nome completo" required>
                </div>

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Digite o seu email" required>
                </div>

                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" placeholder="Digite o seu telefone" required>
                </div>

                <div class="input-group w50">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha1" placeholder="Digite sua senha" required>
                </div>

                <div class="input-group w50">
                    <label for="Confirmarsenha">Confirmar Senha</label>
                    <input type="password" name="senha2" placeholder="Confirme a senha" required>
                </div>

                <div class="input-group">
                    <button type="submit">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>

