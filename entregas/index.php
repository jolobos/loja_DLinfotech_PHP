<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once('../database.php');
if(!empty($_POST)){
	if($_POST['CPF']!='' and $_POST['senha']!='' and isset($_POST['CPF']) and isset($_POST['senha'])){
		$CPF = $_POST['CPF'];
		$sql = 'SELECT * FROM entregador_us WHERE CPF=?';
			$consulta = $conexao->prepare($sql);
			$consulta->execute(array($CPF));
			$dado = $consulta->fetch(PDO::FETCH_ASSOC);
			$res = $consulta->rowCount();
			$senha = md5($_POST['senha']);
			
			if($res==1){
				if($senha==$dado['senha_ent']){
				$msg= 'Bem vindo';
				$_SESSION['CPF'] = $dado['CPF'];
				$_SESSION['id_entregador'] = $dado['id_entregador'];
				$_SESSION['nivel'] = $dado['nivel'];
				$_SESSION['foto'] = $dado['foto_ent'];
				$_SESSION['nome'] = $dado['nome_ent'];
				$_SESSION['vida'] = 1000; //segundos
				$_SESSION['decorrido'] = time();
				header('location:home.php?mens='.$msg);
				}else{
					$msg='Senha invalida para o CPF digitado. '.$dado['senha_ent'];
				header('location:index.php?mens='.$msg);

					}
			}else{
				$msg= 'CPF do entregador ou senha são invalidos.';
			header('location:index.php?mens='.$msg);
			
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
    <title>Entre e inicie suas entregas...</title>
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
            <img src="../img/login_entrega.svg">
        </div>
<div class="form-box">
<form action="index.php" method="post">
				<h2 align="center">Login</h2>
                <div class="input-group">
                    <label for="CPF">CPF</label>
                    <input type="text" name="CPF" placeholder="Digite o seu CPF..." required>
                </div>

                <div class="input-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite a sua senha..." required>
                    <a href="recupera_senha.php" style="color: #000000;" >Esqueceu a senha?Click Aqui.</button>
				</div>
				<div align="right" class="input-group" style="margin-top:80px;">
                    <button type="submit" style="width:100px;">Iniciar</button>
                </div>
</form>
</div>
</div>
</body>