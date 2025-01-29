<?php
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once("../database.php");

  $msg = false;

  if(isset($_FILES['arquivo'])){
    $arq = '../../img/foto_usuario/'.$foto;
    unlink($arq);
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
    $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
    $diretorio = "../img/foto_usuario/"; //define o diretorio para onde enviaremos o arquivo

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); //efetua o upload

	$sql ='UPDATE usuarios SET foto=? WHERE id_usuario=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array($novo_nome,$id_usuario));
		}catch(PDOException $r){
			$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= 'Foto alterada com sucesso!.';
				$_SESSION['foto'] = $novo_nome;
				}else{
					$msg='Lamento, não foi possivel alterar sua foto!'.$r->getMessage().'';
			}
		header('location:perfil.php?mensagem='.$msg);

  }

require_once('cabecalho.php');

?>
<?php if(isset($msg) && $msg != false) echo "<p>'.$msg.'</p>"; ?>
<form action="altera_foto_us.php" method="POST" enctype="multipart/form-data" >
	<div class="container">
            <h1 style="margin-top:95px;">Upload de imagem</h1>
           <?php 
           if(!empty($foto)){$foto_usuario = $foto;}else{$foto_usuario ="user_null.png" ;}
           echo '<img src="../img/foto_usuario/'.$foto_usuario.'" width="300px" height="300px"/>'; 
           
           
           ?>
				
                <div class="col-sm-3 mt-3">
			<input class="form-control" type="file" required name="arquivo">
			<input class="btn btn-secondary mt-3" type="submit" value="Salvar">
                        <a class="btn btn-danger mt-3" href="altera_usuario.php">Cancelar</a>
		</div>
		</div>
</form>

<div class= "bg-dark" style="position: fixed;bottom:0;left:0;width: 100%;background: #ffffff" >
        </br>
        <P align= 'center' class="text-info">&copy; 2024 -Josias Santos de Azevedo </P>
    </div>
</body>
</html>