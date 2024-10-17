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
    if(!empty($dados['link_azul'])){
        $lista_cores[] = $dados['link_azul'];
    }
    
    if(!empty($dados['link_vermelho'])){
        $lista_cores[] = $dados['link_vermelho'];
    }
    
    if(!empty($dados['link_preto'])){
        $lista_cores[] = $dados['link_preto'];
    }
    
    if(!empty($dados['link_branco'])){
        $lista_cores[] = $dados['link_branco'];
    }
    
    if(!empty($dados['link_amarelo'])){
        $lista_cores[] = $dados['link_amarelo'];
    }
    
    if(!empty($dados['link_verde'])){
        $lista_cores[] = $dados['link_verde'];
    }
    
    if(!empty($dados['link_laranja'])){
        $lista_cores[] = $dados['link_laranja'];
    }
    
    if(!empty($dados['link_cinza'])){
        $lista_cores[] = $dados['link_cinza'];
    }
    
    if(!empty($dados['link_rosa'])){
        $lista_cores[] = $dados['link_rosa'];
    }
    
    if(!empty($dados['link_marrom'])){
        $lista_cores [] = $dados['link_marrom'];
    }
    
    if(!empty($dados['link_roxo'])){
        $lista_cores[] = $dados['link_roxo'];
    }
    
    if(!empty($dados['link_prata'])){
        $lista_cores[] = $dados['link_prata'];
    }
    
    if(!empty($dados['link_dourado'])){
        $lista_cores[] = $dados['link_dourado'];
    }
    
    foreach($lista_cores as $f){
        $sql_a ='UPDATE produtos SET link_azul=?,link_vermelho=?,link_preto=?,link_branco=?,link_amarelo=?,link_verde=?,link_laranja=?,link_cinza=?,link_rosa=?,link_marrom=?,link_roxo=?,link_prata=?,link_dourado=? WHERE cod_produto = '.$f.'';
    try {$insercao = $conexao->prepare($sql_a);
	$ok = $insercao->execute(array($dados['link_azul'],$dados['link_vermelho'],$dados['link_preto'],$dados['link_branco'],$dados['link_amarelo'],$dados['link_verde'],$dados['link_laranja'],$dados['link_cinza'],$dados['link_rosa'],$dados['link_marrom'],$dados['link_roxo'],$dados['link_prata'],$dados['link_dourado']));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    }
    
    if($ok){
       foreach($lista_cores as $fa){
        $sql_ab ='UPDATE produtos SET azul=?,vermelho=?,preto=?,branco=?,amarelo=?,verde=?,laranja=?,cinza=?,rosa=?,marrom=?,roxo=?,prata=?,dourado=? WHERE cod_produto = '.$fa.'';
        try {$insercao = $conexao->prepare($sql_ab);
            $ok1 = $insercao->execute(array($dados['azul'],$dados['vermelho'],$dados['preto'],$dados['branco'],$dados['amarelo'],$dados['verde'],$dados['laranja'],$dados['cinza'],$dados['rosa'],$dados['marrom'],$dados['roxo'],$dados['prata'],$dados['dourado']));
        }catch(PDOException $r){
    //$msg= 'Problemas com o SGBD.'.$r->getMessage();
            $ok1 = False;
        }catch (Exception $r){//todos as exceções
            $ok1= False; 
        }
        } 
    }
    if($ok1){header('location:linkar_produto.php?msg=produtos com cores regularizadas');}
}