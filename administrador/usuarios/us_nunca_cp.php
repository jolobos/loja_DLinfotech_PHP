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
    <script type="text/javascript" src="func_us.js"></script>
	<link rel="stylesheet" href="../../css/modal.css">

</head>
  <body style="background: #778899">
  <div class="container">
				<div class="bg-dark"><h1 class="text-success">
					Opções para Usuários
				</h1>
				<button type="button" class="btn btn-info m-2" data-toggle="modal" data-target="#exampleModal">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
				<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
			</svg>MENU
				</button>
				<?php echo '<a class="btn btn-secondary border-danger m-2" href="usuarios.php">Voltar</a>'; ?>
				<a class="btn btn-secondary border-info m-2" href="../menu_admin.php">Administração</a>
				<a href="../../sair.php" class="btn btn-secondary border-info m-2">Sair</a>

				</div>
			    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
				<a class="btn btn-secondary border-danger m-2" href="usuarios.php">Usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="novos_usuarios.php">Novos usuários</a></br>
				<a class="btn btn-secondary border-warning m-2" href="des_usuarios.php">Usuários desativados</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_mais_cp.php">Usuários que mais compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_menos_cp.php">Usuários que menos compram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="us_nunca_cp.php">Usuários que nunca compraram</a></br>
				<a class="btn btn-secondary border-warning m-2" href="ex_auto.php">Exclusão automática</a></br>
				
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
				</div>
				</div>
				</div>
	<div class="card mt-2">
	<div class="card-header">
	<h3>Lista de usuários que nunca compraram</h3>
	</div>
	<div class="card-body">
<?php
$quantidade_us = 20; 
$pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio     = ($quantidade_us * $pagina) - $quantidade_us;
        $sql_a = "SELECT id_usuario FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC LIMIT ".$inicio.",".$quantidade_us."";
	$consulta_a = $conexao->query($sql_a);
	$dados = $consulta_a->fetchALL(PDO::FETCH_ASSOC);
	
	
    echo '<div class="card m-3">
          <div class="card-header">
              <h4>Lista</h4>
          </div>
          <div class="card-body">';
          if(!empty($dados)){


          echo '<table  border="3" class="border-secondary" style="table-layout: fixed;width:1113px">';
          echo '<thead style="display: block;position: relative;" class="border">';
          echo '<tr>';

          echo '<th width=275>Nome</th><th width=130>CPF</th><th width=142>Telefone</th><th width=285>E-mail</th><th width=125>status</th><th>Açoes</th>';

          echo '</tr>';
          echo '</thead>';
          echo '<tbody style="display: block;  overflow: auto;width: 100%;max-height: 400px;overflow-y: scroll;overflow-x: hidden;">';

           foreach($dados as $d){
                $sql_b = "SELECT * FROM usuarios WHERE id_usuario = '".$d['id_usuario']."'";
		$consulta_b = $conexao->query($sql_b);
		$d_b = $consulta_b->fetch(PDO::FETCH_ASSOC);
	  if($d_b['status'] > 0){ $status = 'ativo'; }else{ $status = 'desativado';}
	  echo '<tr><td width=275>'.$d_b['nome'].'</td><td width=130>'.$d_b['CPF'].'</td><td width=142>'. $d_b['telefone'].'</td><td width=285>'.$d_b['email'].'</td>
	  <td width=125>'.$status.'</td><td><a class="btn btn-dark border-success me-2" href = "us_opcoes.php?id_usuario='.$d_b['id_usuario'].'">Selecionar</a>
	  </td></tr>';
 }

          echo '</tbody>';
           echo '</table>';
          }else{

                 echo '<div class="col-sm-8 mx-auto"><h3 class="alert alert-secondary">Nenhum usuario encontrado...</h3></div>';


          }
            
    echo '</div>
        
    ';

$sqlTotal = "SELECT COUNT(id_usuario) AS id FROM usuarios AS u WHERE NOT EXISTS (SELECT id_usuario FROM compras AS cp WHERE cp.id_usuario = u.id_usuario) ORDER BY nome ASC";
  //Executa o SQL
$consulta_c = $conexao->query($sqlTotal);
$qrTotal = $consulta_c->fetch(PDO::FETCH_ASSOC);
   
  //O calculo do Total de página ser exibido
  $totalPagina= ceil($qrTotal['id']/$quantidade_us);
   /**
    * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
    */
   $exibir = 3;
   /**
    * Aqui montará o link que voltará uma pagina
    * Caso o valor seja zero, por padrão ficará o valor 1
    */
   $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
   /**
    * Aqui montará o link que ir para proxima pagina
    * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
    * caso contrario, ele pegar o valor da página + 1
    */
   $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
   /**
    * Agora monta o Link paar Primeira Página
    * Depois O link para voltar uma página
    */
  /**
    * Agora monta o Link para Próxima Página
    * Depois O link para Última Página
    */
   
   echo '<div id="navegacao" align="center">';
     
        echo '<a  class="btn btn-primary mb-2" href="?pagina=1">primeira</a> | ';
        echo "<a  class='btn btn-primary mb-2' href=\"?pagina=$anterior\">anterior</a> | ";
    
     
         /**
    * O loop para exibir os valores à esquerda
    */
   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0)
        echo '<a  class="btn btn-primary mb-2 " href="?pagina='.$i.'"> '.$i.' </a>';
  }

  echo '<a  class="btn btn-primary mb-2 ms-1" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';

  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo '<a class="btn btn-primary mb-2 ms-1" href="?pagina='.$i.'"> '.$i.' </a>';
  }

   /**
    * Depois o link da página atual
    */
   /**
    * O loop para exibir os valores à direita
    */

  
     echo " | <a class='btn btn-primary mb-2' href=\"?pagina=$posterior\">próxima</a> | ";
    echo "  <a class='btn btn-primary mb-2' href=\"?pagina=$totalPagina\">última</a>";
   

        
      
        
        
  ?>     
         </div>   
        </div>
</div>