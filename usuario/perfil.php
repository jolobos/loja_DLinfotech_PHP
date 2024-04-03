<?php
require_once("cabecalho.php");
if(!empty($_GET['mensagem'])){
echo '<h3 class="alert alert-secondary text-center">'.$_GET['mensagem'].'</h3>';
}
?>

