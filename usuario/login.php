<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once('../database.php');
if(!empty($_POST)){
	if($_POST['email']!='' and $_POST['senha']!='' and isset($_POST['email']) and isset($_POST['senha'])){
		$email = $_POST['email'];
		$sql = 'SELECT * FROM usuarios WHERE email=?';
			$consulta = $conexao->prepare($sql);
			$consulta->execute(array($email));
			$dado = $consulta->fetch(PDO::FETCH_ASSOC);
			$res = $consulta->rowCount();
			$senha = md5($_POST['senha']);
			
			if($res==1){
				if($senha==$dado['senha']){
				$msg= 'Bem vindo';
				$_SESSION['email'] = $dado['email'];
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				$_SESSION['administrador'] = $dado['administrador'];
				$_SESSION['apelido'] = $dado['apelido'];
				$_SESSION['foto'] = $dado['foto'];
				$_SESSION['nome'] = $dado['nome'];
				$_SESSION['vida'] = 1000; //segundos
				$_SESSION['decorrido'] = time();
				header('location:../index.php?mens='.$msg);
				}else{
					$msg='E-mail de usuario ou senha invalidos.';
				header('location:../login.php?mens='.$msg);

					}
			}else{
				$msg= 'E-mail de usuario ou senha invalidos.';
			header('location:login.php?mens='.$msg);
			
				}
		
		
	}
}
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
        $msg = $_GET['mens'];
        echo '';
        echo '<div align="center"'
        . 'style=" height: 50px;width: 1000px;position: absolute;top: 35px;margin: auto;border-radius;border: 2px solid #191970;
  border-radius: 25px;background:#FF6347;">'
        . '<h3 style="margin-top: 10px ;">Desculpa, '.$msg.'</h3></div>';
    }
    ?>

<div class="box" style="justify-content: center;">
<div class="img-box">
            <img src="../img/login.svg">
        </div>
<div class="form-box">
<form action="login.php" method="post">
				<h2 align="center">Login</h2>
                <div class="input-group">
                    <label for="nome">E-mail</label>
                    <input type="text" name="email" placeholder="Digite o seu E-mail..." required>
                </div>

                <div class="input-group">
                    <label for="email">Senha</label>
                    <input type="password" name="senha" placeholder="Digite a sua senha..." required>
                    <a href="recupera_senha.php" style="color: #000000;" target="_blank">Esqueceu a senha?Click Aqui.</button>
				</div>
				<div align="right" class="input-group" style="margin-top:80px;">
                    <button type="submit" style="width:100px;">Iniciar</button>
                </div>
</form>
</div>
</div>
</body>