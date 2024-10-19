<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once('../database.php');
$rdir = str_replace("\\", "/", __DIR__);                    //Root Dir
require $rdir.'/email/src/Exception.php';
require $rdir.'/email/src/PHPMailer.php';
require $rdir.'/email/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(!empty($_POST['email_usuario'])){
    $email = $_POST['email_usuario'];
    $sql = 'SELECT * FROM usuarios WHERE email=?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($email));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);
    $res = $consulta->rowCount();

if($res == 1){    
$mail = new PHPMailer(true);
$_SESSION['id_email'] = $dado['id_usuario'];
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
   $randomString = '';
   for($i = 0; $i < 6; $i = $i+1){
      $randomString .= $chars[mt_rand(0,60)];
   }
$token = $randomString;;
$id_recuperacao = $dado['id_usuario'];
echo $token.'<br>'.$id_recuperacao;
   
    $sql_recu ='UPDATE usuarios SET token_recupercao=? WHERE id_usuario=?';
    try {
        $insercao = $conexao->prepare($sql_recu);
	$ok1 = $insercao->execute(array ($token,$id_recuperacao));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
        }


 if($ok1){
try {
    //Server settings
    $assunto = 'Recuperação de senha - DLInfotech Soluções em Informática.';
    $mensagem_email = 'Olá, lamentamos que você tenha perdido a sua senha de acesso!<br>
                        Para sua segurança, estamos enviando um código de 6 digitos,<br>
                        para que você possa estar atualizando a sua senha e recuperar<br>
                        o seu acesso a plataforma.<br><br><br>
                        Caso você não tenha tentado acessar a sua conta e recebeu essa<br>
                        mensagem, fique atento à uma tentativa de acesso indevido!<br>
                        <br>
                        Seu token de acesso é: '.$token.'.<br>
                        <br><br>
                        Equipe DLInfotech.' ;
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'email da loja';                     //SMTP username
    $mail->Password   = 'senha de aplicativo da loja';            //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('digo8432@gmail.com', 'Digo');
    $mail->addAddress($email, 'Usuario');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Para anexar arquivos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $assunto;
    $mail->Body    = $mensagem_email;
    //$mail->AltBody = 'Testando oque é Altbody in plain text for non-HTML mail clients';

    $mail->send();
    $msg_enviada = 'Mensagem enviada com sucesso.';
    header('location:Inserir_token.php?mens='.$msg_enviada);

} catch (Exception $e) {
    $msg_enviada = 'Mensagem enviada com sucesso.';
    header("location:recupera_senha.php?mens=Mensagem não enviada . Mailer Error: {$mail->ErrorInfo}");
}
 }else{
        header('location:recupera_senha.php?mens=Houve um erro ao salvar o Token em nosso banco de dados!');

} 
}else{
    header('location:recupera_senha.php?mens=O E-mail utilizado não consta em nosso banco de dados!');
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
        . '<h3 style="margin-top: 10px ;">Desculpa, '.$msg.'</h3></div>';
    }
    ?>

<div class="box" style="justify-content: center;">
<div class="img-box">
            <img src="../img/recupera.png">
        </div>
<div class="form-box">
<form action="recupera_senha.php" method="post">
				<h2 align="center">Recuperação de Senha</h2>
                <div class="input-group">
                    <label style="color: black">Digite seu E-mail para receber o token de recuperação da senha.</label>
                    <label for="nome">E-mail</label>
                    <input type="text" name="email_usuario" placeholder="Digite o seu E-mail..." required>
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
</form>
</div>
</div>
</body>