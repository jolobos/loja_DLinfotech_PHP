<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(!empty($_POST['forma_pagamento']) && !empty($_POST['total'])){
	
	if(empty($_SESSION['produto_carrinho'])){
		header("location:select_prod.php?mensagem=Lista de produtos está vazia.");
	}
	if(empty($_SESSION['endereco'])){
		header("location:conf_venda.php?mensagem=Nenhum endereço para a entrega foi adicionado à compra.");
	}
	if(empty($_SESSION['id_usuario_1'])){
		header("location:checkout.php?mensagem=A venda não esta vinculada a nenhum cliente.");
	}
	

	$total_somado = $_POST['total'];
	$data = date('Y-m-d H:i:s');
    $autorizado = 0;
	$entregue = 0;
    $pagamento = $_POST['forma_pagamento'];
    $parcelas = 1;
    $id_endereco = $_SESSION['endereco'];
    $id_usuario_1= $_SESSION['id_usuario_1'];
	
    $sql ='INSERT INTO compras (id_usuario,id_endereco,data,total,autorizado,entregue,pagamento,parcelas)
    values(?,?,?,?,?,?,?,?)';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_usuario_1,$id_endereco,$data,$total_somado,$autorizado,$entregue,$pagamento,$parcelas));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
     
     
    if($ok){
        $sqld = "SELECT id_compra,data FROM compras WHERE id_compra ORDER BY id_compra DESC LIMIT 0,1";
        $consulta = $conexao->query($sqld);
        $dadosd = $consulta->fetch(PDO::FETCH_ASSOC);
        $id_compras = $dadosd['id_compra'];
        $data_item = date('Y-m-d H:i:s');
        foreach ($_SESSION['produto_carrinho'] as $id => $qtd) {
            $sql ='INSERT INTO itens_da_compra (id_compra,id_produto,quantidade,data_item)
            values(?,?,?,?)';
            try {
                $insercao = $conexao->prepare($sql);
                $ok_a = $insercao->execute(array ($id_compras,$id,$qtd,$data_item));
            }catch(PDOException $r){
        //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                $ok_a = False;
            }catch (Exception $r){//todos as exceções
                $ok_a= False; 
            }
 
	}
	}
//diminuir as quantidades dos produtos de estoque.
		if($ok_a){
			$quantidade_nova = 0;
			 foreach ($_SESSION['produto_carrinho'] as $id => $qtd) {
				$sql_p = "SELECT * FROM produtos WHERE id_produto='".$id."'";
				$consulta_p = $conexao->query($sql_p);
				$dados_p = $consulta_p->fetch(PDO::FETCH_ASSOC); 
				$quantidade_nova = $dados_p['quantidade'] - $qtd; 
			$sql_n ='UPDATE produtos SET quantidade=? WHERE id_produto = '.$id.'';
            try {
                $insercao = $conexao->prepare($sql_n);
                $ok_ab = $insercao->execute(array ($quantidade_nova));
            }catch(PDOException $r){
        //$msg= 'Problemas com o SGBD.'.$r->getMessage();
                $ok_ab = False;
            }catch (Exception $r){//todos as exceções
                $ok_ab= False; 
            }
			if($ok_ab){
				$sql_p_status = "SELECT * FROM produtos WHERE id_produto='".$id."'";
				$consulta_p_status = $conexao->query($sql_p_status);
				$dados_p_status = $consulta_p_status->fetch(PDO::FETCH_ASSOC);
				$verifica_status = $dados_p_status['quantidade'];
				if($verifica_status <= 0){
					$status_n = 0;
					$sql_n_n ='UPDATE produtos SET status=? WHERE id_produto = '.$id.'';
					try {
						$insercao = $conexao->prepare($sql_n_n);
						$ok_abc = $insercao->execute(array ($status_n));
					}catch(PDOException $r){
				//$msg= 'Problemas com o SGBD.'.$r->getMessage();
						$ok_abc = False;
					}catch (Exception $r){//todos as exceções
						$ok_abc= False; 
					}
				
				}
			}
			}
			
		}
		
		if($ok_ab){
			unset($_SESSION['endereco']);
			unset($_SESSION['produto_carrinho']);
			unset($_SESSION['id_usuario_1']);
			header("location:checkout.php?mensagem=Venda Concluída.");
		}else{
			header("location:checkout.php?mensagem=Houve um erro ao registrar os dados no sgbd.");

		}
	
	
}else{
	header("location:../../index.php");
}


?>

