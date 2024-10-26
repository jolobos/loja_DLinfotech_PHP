<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!isset($_SESSION['produto_escolhido'])){
        header('location:linkar_produto.php');
}else{
    $sql = "SELECT * FROM produtos WHERE id_produto = ".$_SESSION['produto_escolhido']."";
    $consulta = $conexao->query($sql);
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);
    $lista_cores = array();
    if(!empty($dados['link_110'])){
        $lista_cores[] = $dados['link_110'];
    }
    
    if(!empty($dados['link_220'])){
        $lista_cores[] = $dados['link_220'];
    }
    
    if(!empty($dados['link_bivolt'])){
        $lista_cores[] = $dados['link_bivolt'];
    }
    
    foreach($lista_cores as $f){
        $sql_a ='UPDATE produtos SET link_110=?,link_220=?,link_bivolt=? WHERE cod_produto = '.$f.'';
    try {$insercao = $conexao->prepare($sql_a);
	$ok = $insercao->execute(array($dados['link_110'],$dados['link_220'],$dados['link_bivol']));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    }
    
    if($ok){
       foreach($lista_cores as $fa){
        $sql_ab ='UPDATE produtos SET v_110=?,v_220=?,v_bivolt=? WHERE cod_produto = '.$fa.'';
        try {$insercao = $conexao->prepare($sql_ab);
            $ok1 = $insercao->execute(array($dados['v_110'],$dados['v_220'],$dados['v_bivolt']));
        }catch(PDOException $r){
    //$msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok1 = False;
        }catch (Exception $r){//todos as exceções
            $ok1= False; 
        }
        } 
    }
    if($ok1){header('location:linkar_voltagem.php?msg=produtos com cores regularizadas');} else {
    header('location:linkar_voltagem.php?msg=produtos com cores nao regularizadas');
}
}