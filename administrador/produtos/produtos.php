<?php
require_once '../../database.php';
require_once '../../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
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
    <script type="text/javascript" src="func_pr.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para produtos
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="produtos.php">Produtos</a></br>
				<a class="btn btn-secondary border-danger m-2" href="add_produto.php">Inserir Produto</a></br>
				<a class="btn btn-secondary border-warning m-2" href="linkar_produto.php">Linkar cores de produtos</a></br>
				<a class="btn btn-secondary border-warning m-2" href="linkar_voltagem.php">Linkar voltagem de produtos</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_quantidade.php">Controle de quantidade</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ctrl_saida_produto.php">Controle de saida</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
      <?php if(isset($_GET['mensagem'])){echo $_GET['mensagem'];}?>
<h4 class="mt-3">Pesquisar produto: </h4>
<div class="col-sm-5">
<input type="search" id="busca" style="width:500px" class="form-control" placeholder="Digite o nome do produto..." onKeyUp="buscarprodutos(this.value)"/>
</div>
<h4 class="mt-3">Código do produto: </h4>
<form action="produtos.php" method="POST"><div class="row">
<div class="col-sm-5">
<input type="text"  class="form-control" style="width:500px" name="cod_produto"  placeholder="Digite o código do produto..." autofocus/>
</div>
<div class="col"><button type="submit"  class="btn btn-secondary border-info w-25" >
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>- Buscar
</button>
</div></div>
</form>
</br>
  <div id="resultado">      
<?php
if(empty($_POST['cod_produto'])){
 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Por favor, digite o nome do produto desejado, ou entre com o código do produto...</h3</div>';
}?>
  </div>
<div>
  <?php
 if(!empty($_POST['cod_produto'])){
	$cod_produto = $_POST['cod_produto'];
 
  $sql = "SELECT * FROM produtos WHERE cod_produto ='".$cod_produto."'";
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetch(PDO::FETCH_ASSOC);
		if(empty($dados)){
 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-danger">Lamento! Não há nenhum produto com esse código...</h3</div>';
		}else{
  if($dados['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
  echo '<table  border="3" class="table table-striped border-secondary">
  <thead><tr><th>codigo do produto</th><th>Produto</th><th>Valor</th><th>quantidade</th><th>status</th><th>Açoes</th></tr></thead>';
  echo '<tbody><tr><td>'.$dados['cod_produto'].'</td><td>'.$dados['nome'].'</td>
		<td>$ '. number_format($dados['valor'],2,',','.').'</td><td>'.$dados['quantidade'].'</td>
	  <td>'.$status.'</td><td><a class="btn btn-dark border-success me-2" href = "ver.php?id_produto='.$dados['id_produto'].'">ver</a>
	  <a class="btn btn-dark border-success me-2" href = "alterar.php?id_produto='.$dados['id_produto'].'"> alterar</a>
	  <a class="btn btn-dark border-success" href = "deletar.php?id_produto='.$dados['id_produto'].'"> deletar</a></td></tr>';		
		}
 
                
        
  }
  
  
  $sql_37 = "SELECT * FROM produtos WHERE link_azul = 0 AND
               link_vermelho = 0 AND link_preto = 0 AND link_branco = 0 AND
               link_amarelo = 0 AND link_verde = 0 AND link_laranja = 0 AND
               link_cinza = 0 AND link_rosa = 0 AND link_marrom = 0 AND
               link_roxo = 0 AND link_prata = 0 AND link_dourado = 0";
  $consulta_37 = $conexao->query($sql_37);
  $dados_37 = $consulta_37->fetchALL(PDO::FETCH_ASSOC);
  
  $sql_38 = "SELECT * FROM produtos WHERE link_110 = 0 AND
               link_220 = 0 AND link_bivolt = 0 AND s_volt =0";
  $consulta_38 = $conexao->query($sql_38);
  $dados_38 = $consulta_38->fetchALL(PDO::FETCH_ASSOC);
  
  if(!empty($dados_37)){
      echo '<div class="modal fade modal-lg" id="exemplomodal">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-info">
          <h3 class="modal-title">Fique esperto!!!!</h3>
      </div>
      <div class="modal-body bg-light">';
        if(!empty($dados_37)){
            echo '<h5>Voce Possue produtos que não tem seus links de cores atualizados.</h5>
	<p>Se você deseja atualizar seus links de cores, click no botão abaixo, e você será redirecionado para à pagina de linkar cores.</p>
        <a class="btn btn-primary" href="linkar_produto.php">Linkar Cores</a>
        ';
          
        }
        
        if(!empty($dados_38)){
            echo '<h5>Voce Possue produtos que não tem seus links de voltagem atualizados.</h5>
	<p>Se você deseja atualizar seus links de voltagem, click no botão abaixo, e você será redirecionado para à pagina de linkar voltagens.</p>
        <a class="btn btn-primary" href="linkar_voltagem.php">Linkar Voltagem</a>
        ';}
        
      echo '</div>
      <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>';
  }
?>
</div>

  </body>
  
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	  <script type="text/javascript">
$(window).load(function() {
    $("#exemplomodal").modal("show");
});
</script>