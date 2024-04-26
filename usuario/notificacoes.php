<?php
require_once 'cabecalho.php';
?>
<div class="container" style="margin-top: 105px;">
    <h3 class="text-info">Notificações</h3>
    <hr>
    <h4>Notificações recebidas</h4>
    <hr>
<?php
    $sql = "SELECT * FROM notificacoes WHERE id_usuario = '".$id_usuario."'";
    $consulta = $conexao->query($sql);
    $dados_a = $consulta->fetchALL(PDO::FETCH_ASSOC);
    
    foreach ($dados_a as $d){
        if($d['condicao'] == 1){ 
            $titulo = $d['titulo'];
            $conteudo = $d['conteudo'];
            $link_1 = $d['link_1'];
            $link_2 = $d['link_2'];
            $link_3 = $d['link_3'];
            $link_4 = $d['link_4'];
            $link_5 = $d['link_5'];
            $data_envio = $d['data_envio'];
        
    
            echo '<div class="card"><div class="card-header">
    <p class="ms-2"><strong>'.$titulo.'</strong> - '. date_format(new DateTime($data_envio),"d/m/Y H:i:s").'</p>
  </div>';
            echo '<p class="ms-2">'.$conteudo.'</p>';
            echo '<p class="ms-2"></p></div>';
        }
    }
?>
    
</div>

