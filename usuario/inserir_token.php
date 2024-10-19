<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once('../database.php');
if(!isset($_SESSION['id_email'])){
    header("location:recupera_senha.php?mens=E-mail perdido! Digite seu E-mail novamente.");
}
$res = 0;
if(isset($_SESSION['id_email']) && !empty($_POST['token'])){
    $id = $_SESSION['id_email'];
    $sql = 'SELECT * FROM usuarios WHERE id_usuario=?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($id));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);
    if($dado['token_recupercao'] == $_POST['token']){
        $res = 1;
    }else{
        $_GET['mens'] = 'seu token não esta correto.';
    }
}

if(!empty($_POST['senha1']) && !empty($_POST['senha2'])){
    if($_POST['senha1'] == $_POST['senha2']){
        $id = $_SESSION['id_email'];
        $senha1 = md5($_POST['senha1']);
        $sql_recu ='UPDATE usuarios SET senha=? WHERE id_usuario=?';
        try {
            $insercao = $conexao->prepare($sql_recu);
            $ok1 = $insercao->execute(array ($senha1,$id));
        }catch(PDOException $r){
    //$msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok1 = False;
        }catch (Exception $r){//todos as exceções
            $ok1= False; 
            }
       if($ok1){
        header("location:login.php");
        }else{
            header("location:inserir_token.php?mens=Lamento, houve algum erro ao gravar a nova senha.");
        }
    }else{
        header("location:inserir_token.php?mens=Sua senha e confirmação, não correspondem.");

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
    if(!empty($_GET['mens'])){
        $msg = $_GET['mens'];
        echo '';
        echo '<div align="center"'
        . 'style=" height: 50px;width: 1000px;position: absolute;top: 35px;margin: auto;border-radius;border: 2px solid #191970;
  border-radius: 25px;background:#FF6347;">'
        . '<h3 style="margin-top: 10px ;">'.$msg.'</h3></div>';
    }
    ?>
<div class="box" style="justify-content: center;">
<div class="img-box">
            <img src="../img/recupera.png">
        </div>
<div class="form-box">

                <?php 
                if($res == 0){
                echo '<form action="inserir_token.php" method="post">
			<h2 align="center">Recuperação de Senha</h2>
                        <div class="input-group">
                            <label style="color: black">Digite o token que você recebeu em seu E-mail.</label>
                            <label for="nome">Token</label>
                            <input type="text" name="token" placeholder="Digite o seu token..." required>
                        </div>
                        <div align="right" class="input-group" style="margin-top:80px;">
                        <table><tr><td>
                            <a href="login.php"><input type="button" name="name" value="Voltar" style="width:100px;
                            height: 47px;background: #808080;
                            border-radius: 20px;
                            outline: none;
                            border: none;
                            margin-top: 15px;
                            padding-top: 10px; 
                            color: white;
                            cursor: pointer;
                            font-size: 16px;"></a></td><td>
                            <button type="submit" style="width:100px;">Enviar</button></td></tr></table>
                        </div>
                        </form>';
                }else{
                    echo '<form action="inserir_token.php" method="post">
                            <h2 align="center">Recuperação de Senha</h2>
                            <div class="input-group">
                                <label style="color: black">Digite a sua nova senha.</label>
                                <label for="senha">Senha</label>
                                <input type="password" name="senha1" placeholder="Digite sua senha" required>
                            </div>

                            <div class="input-group">
                                <label for="Confirmarsenha">Confirmar Senha</label>
                                <input type="password" name="senha2" placeholder="Confirme a senha" required>
                            </div>

                            <div class="input-group">
                                <button type="submit">Cadastrar</button>
                            </div>

                    </form>
                    ';
                }
                ?>

</div>
</div>
</body>