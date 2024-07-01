<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_GET['id_prod'])){
		$quantidade = $_GET['atualiza_quant'];
		$id_compra = $_GET['alterar_compra'];
		$id_produto = $_GET['id_prod'];
		$sql ='UPDATE itens_da_compra SET quantidade=? WHERE id_compra = '.$id_compra.' AND id_produto = '.$id_produto.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($quantidade));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
    
    if($ok){
        $total = 0;
        $sql1 = "SELECT * FROM itens_da_compra WHERE id_compra=".$id_compra."";
        $consulta1 = $conexao->query($sql1);
        $dados1 = $consulta1->fetchALL(PDO::FETCH_ASSOC);
        
        foreach($dados1 as $d1){
            $sql2 = "SELECT * FROM produtos WHERE id_produto=".$d1['id_produto']."";
            $consulta2 = $conexao->query($sql2);
            $dados2 = $consulta2->fetch(PDO::FETCH_ASSOC);
            $total += $dados2['valor'] * $d1['quantidade']; 
        }
        
     $sql ='UPDATE compras SET total=? WHERE id_compra=?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok1 = $insercao->execute(array ($total,$id_compra));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
        }}
	
	if($ok1){
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=OK! atualizado com sucesso");
	}else{
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=ERRO! Nao rolou...");

	}
}

if(isset($_GET['quitar'])){
		$id_compra = $_GET['alterar_compra'];
		$valor = 1;
		$sql ='UPDATE compras SET autorizado=? WHERE id_compra = '.$id_compra.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($valor));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	
	if($ok){
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=OK! atualizado com sucesso");
	}else{
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=ERRO! Nao rolou...");

	}
}
if(isset($_GET['entregar'])){
		$id_compra = $_GET['alterar_compra'];
		$valor = 1;
		$sql ='UPDATE compras SET entregue=? WHERE id_compra = '.$id_compra.'';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($valor));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	
	if($ok){
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=OK! atualizado com sucesso");
	}else{
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=ERRO! Nao rolou...");

	}
}

if(isset($_GET['excluir_prod'])){
		$exc_prod = $_GET['excluir_prod'];
		$id_compra = $_GET['alterar_compra'];
		$sql ='DELETE FROM itens_da_compra WHERE id_compra = ? AND id_produto = ?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok = $insercao->execute(array ($id_compra,$exc_prod));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok = False;
    }catch (Exception $r){//todos as exceções
	$ok= False; 
    }
	if($ok){
        $total = 0;
        $sql1 = "SELECT * FROM itens_da_compra WHERE id_compra=".$id_compra."";
        $consulta1 = $conexao->query($sql1);
        $dados1 = $consulta1->fetchALL(PDO::FETCH_ASSOC);
        
        foreach($dados1 as $d1){
            $sql2 = "SELECT * FROM produtos WHERE id_produto=".$d1['id_produto']."";
            $consulta2 = $conexao->query($sql2);
            $dados2 = $consulta2->fetch(PDO::FETCH_ASSOC);
            $total += $dados2['valor'] * $d1['quantidade']; 
        }
        
     $sql ='UPDATE compras SET total=? WHERE id_compra=?';
    try {
        $insercao = $conexao->prepare($sql);
	$ok1 = $insercao->execute(array ($total,$id_compra));
    }catch(PDOException $r){
//$msg= 'Problemas com o SGBD.'.$r->getMessage();
        $ok1 = False;
    }catch (Exception $r){//todos as exceções
	$ok1= False; 
        }}
	if($ok1){
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=OK! atualizado com sucesso");
	}else{
		header("location:alterar_com.php?alterar_compra=".$id_compra."&mensagem=ERRO! Nao rolou...");

	}
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos do sistema - DL Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func_us.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para Compras
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<?php echo '<a href="compras_usuario.php?opcoes_compra='.$_GET['alterar_compra'].'" class="btn btn-secondary border-danger m-2">voltar</a>'; ?>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="compras.php">Compras do dia</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_usuario.php">Compras por usuário</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_data.php">Compras por data</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_valor.php">Compras por valor</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_pag.php">Compras sem pagamento</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_nao_ent.php">Compras não entregue</a></br>
				<a class="btn btn-secondary border-warning m-2" href="compras_sem_us.php">Compras sem usuários</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
            <div class="card-header">
                <h3 class="text-info">Alteração de compras</h3>
            </div>
            <div class="card-body">
			<h3>Numero de identificação da compra: "<?php echo $_GET['alterar_compra']; ?>"</h3><br>
			<?php
				$id_venda_lista = $_GET['alterar_compra'];
				$sql_10 = "SELECT * FROM itens_da_compra WHERE id_compra = '".$id_venda_lista."'";
				$consulta_10 = $conexao->query($sql_10);
				$dados_ab = $consulta_10->fetchALL(PDO::FETCH_ASSOC);
				
					$sql_11 = "SELECT * FROM compras WHERE id_compra = '".$id_venda_lista."'";
				$consulta_11 = $conexao->query($sql_11);
				$dados_com = $consulta_11->fetch(PDO::FETCH_ASSOC);
				$us_a = $dados_com['id_usuario'];
					
					$sql_12 = "SELECT * FROM usuarios WHERE id_usuario = '".$us_a."'";
				$consulta_12 = $conexao->query($sql_12);
				$dados_usu = $consulta_12->fetch(PDO::FETCH_ASSOC);
				if($dados_com['entregue'] == 0){ $entregue = 'Não'; }else{ $entregue = 'Sim';}
				if($dados_com['autorizado'] == 0){ $pago = 'Não'; }else{ $pago = 'Sim';}
				
				echo '
					<h4>Dados do usuário</h4> 
					<table><thead><tr>
					<th width=120>Id. Usuario</th>
					<th width=200>Nome</th>
					<th  width=120>CPF</th>
					<th  width=120>Telefone</th>
					<th width=230>Opções</th>
					<th width=120>Compra entregue</th>
					<th>compra paga</th>
					</tr>
					</thead><tbody><tr>
					<td>'.$dados_usu['id_usuario'].'</td>
					<td>'.$dados_usu['nome'].'</td>
					<td>'.$dados_usu['CPF'].'</td>
					<td>'.$dados_usu['telefone'].'</td>
					<td><a class="btn btn-secondary" href="../usuarios/us_opcoes.php?id_usuario='.$dados_usu['id_usuario'].'" target=_blank>Visualizar usuário</a></td>    
					<td>'.$entregue.'</td><td>'.$pago.'</td></tr></tbody></table>
					<table class="table table-striped mt-2" border="3">
							<thead>
								<tr align="center">
									<th colspan="8">Produtos da Compra</th>
								</tr>
								<tr>
									<th width=150>Cód. do produto</th>
									<th width=150>Foto do produto </th>
									<th width=350>Produto</th>
									<th width=110>Valor</th>
									<th width=110>Quantidade</th>
									<th width=150>Total</th>
									<th>Opções</th>
									
								</tr>
							</thead>
							<tbody>';
				$total_somado = 0;
				foreach($dados_ab as $d_ab){
				$id_produto_lista = $d_ab['id_produto'];
				$sql_100 = "SELECT * FROM produtos WHERE id_produto = '".$id_produto_lista."'";
				$consulta_100 = $conexao->query($sql_100);
				$dados_abc = $consulta_100->fetch(PDO::FETCH_ASSOC);
				
				$cod_produto = $dados_abc['cod_produto'];
					$nome = $dados_abc['nome'];
					$valor= $dados_abc['valor'];
					$quantidade= $d_ab['quantidade'];
				$foto_pr= $dados_abc['foto'];
				$total = $quantidade * $dados_abc['valor'];
					$total_somado += $total;
				echo '<tr style="height: 110px">
							<td><P style="margin-top: 40px">'.$cod_produto.'</P></td>
							<td><img style="width:100px "src="../../img/produtos/'.$foto_pr.'"> </td>
							<td width="350"><P style="margin-top: 40px">'.$nome.'</P></td>
							<td><P style="margin-top: 40px">R$: '. number_format($valor,2,',','.').'</P></td>
							<td><P style="margin-top:40px ">'.$quantidade.' Un</P></td>
							<td><P style="margin-top: 40px"> R$: '.number_format($total,2,',','.').'</P></td>
							<td><a class="btn btn-dark border-info" href="../../produtos/pagina_produto.php?id_produto='.$id_produto_lista.'" target=_blank>Ver</a>
							<a class="btn btn-dark border-info" href="?quant_prod='.$id_produto_lista.'&alterar_compra='.$id_venda_lista.'">Quantidade</a>
							<a class="btn btn-dark border-info mt-2" href="?excluir_prod='.$id_produto_lista.'&alterar_compra='.$id_venda_lista.'">Excluir</a>
							</td></tr>';
				
				}        
					
				  echo '<tr><td colspan="4" align="right"><a class="btn btn-dark border-info" href="?entregar=ok&alterar_compra='.$id_venda_lista.'">entregar venda</a>
				  <a class="btn btn-dark border-info" href="?quitar=ok&alterar_compra='.$id_venda_lista.'">quitar venda</a></td>
				  <td align="right" colspan="3"><P >Total R$: '.number_format($total_somado,2,',','.').'</P></td></tr>

					  </tbody></table>';
					
					if(isset($_GET['quant_prod'])){
						$id_prod = $_GET['quant_prod'];
						echo  '<div class="modal fade modal-lg" id="exemplomodal">
						  <div class="modal-dialog">
						  <div class="modal-content ">
						  <div class="modal-header bg-info">
							<h3 class="modal-title">Atualizar quantidades da compra de n°: "'.$id_venda_lista.'"</h3>
						  </div>
						  <div class="modal-body bg-light">
						  <form>
						  <div class="row">
						  <div class="col-sm-6">
						  <input type="number" class="form-control" name="atualiza_quant" min="1" value="1">
						  </div>
						  <div class="col">
						  <input type="hidden" name="alterar_compra" value="'.$id_venda_lista.'">
						  <input type="hidden" name="id_prod" value="'.$id_prod.'">
						  <input type="submit" class="btn btn-success" value="Atualizar">
						  </div>
						  </div>
						  </form>
						  </div>
						  <div class="modal-footer bg-light">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
						  </div>
					      </div>
					      </div>
						  </div>
					';
					}
					
			?>
			</div>
    </div>
    </div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#exemplomodal').modal('show');
});
</script>