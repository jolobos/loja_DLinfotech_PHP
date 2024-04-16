<?php
require_once 'cabecalho.php';

if(!isset($_SESSION['produto_carrinho'])){
	$_SESSION['produto_carrinho'] = array();
	}



if(!empty($_GET['id_produto'])){
$_SESSION['ultimo_visto'] = $_GET['id_produto'];
if(isset($_GET['id_produto'])){
    $id = intval($_GET['id_produto']);
    if(!isset($_SESSION['produto_carrinho'][$id])){
        $_SESSION['produto_carrinho'][$id]=1;
    }else{
       $_SESSION['produto_carrinho'][$id] +=1;
       $sql = "SELECT * FROM produtos WHERE id_produto='".$id."'";
       $consulta = $conexao->query($sql);
       $dados = $consulta->fetch(PDO::FETCH_ASSOC);
       $quantidadea = $dados['quantidade'];
       if($_SESSION['produto_carrinho'][$id] > $quantidadea){
                     $_SESSION['produto_carrinho'][$id] -=1;

                }
}
}

}

if(isset($_GET['destroi_produto'])){
    $id = intval($_GET['destroi_produto']);
    if(isset($_SESSION['produto_carrinho'][$id])){
    unset($_SESSION['produto_carrinho'][$id]);
    }
}

?>

<div class="container" style="margin-top: 100px">
    
            <h4 align="center" class="alert alert-dark">PRODUTOS DO CARRINHO</h4>
            <?php
                if(count($_SESSION['produto_carrinho'])==0){
                echo '<h4 align="center" class="alert alert-info">Nenhum Produto No Carrinho</h4>';
                echo '<h5>Escolha uma das opções a seguir: </h5>
                <a class="btn btn-secondary" href="pagina_produto.php?id_produto='.$_SESSION['ultimo_visto'].'">Ultimo Produto Visto</a>
                <a class="btn btn-info" href="../index.php">Voltar ao INICIO</a>';
                }else{
				echo '<div class="row"><div class="col-sm-2 "><a class="btn btn-secondary ms-3" href="pagina_produto.php?id_produto='.$_SESSION['ultimo_visto'].'">Ultimo Produto Visto</a>
                </div><div class="col-sm-2"><a class="btn btn-info" href="../index.php">Voltar ao INICIO</a></div>
                <div class="col me-3" align="right"><form action="endereco.php" method="POST">
				<a class="btn btn-success" href="endereco_compra.php">Fechar o Carrinho</a></div>
				</div>';
                	
                echo '<table class="table table-striped mt-2" border="3">
                <thead>
                    <tr align="center">
                        <th colspan="8">Produtos do Carrinho</th>
                    </tr>
                    <tr>
                        <th>Código do produto</th>
                        <th>Foto do produto </th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Disponível</th>
                        <th>Quantidade</th>
                        <th>valor somado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($_SESSION['produto_carrinho'] as $id => $qtd) {
                $sql = "SELECT * FROM produtos WHERE id_produto = ?";
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id));
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $cod_produto = $dados['cod_produto'];
                $nome = $dados['nome'];
                $valor= $dados['valor'];
                $quantidade= $dados['quantidade'];
                if($qtd > $quantidade){
                     $_SESSION['produto_carrinho'][$id] -=1;

                }
                $somado = $valor * $qtd;
                $foto_pr= $dados['foto'];
                echo '<tr style="height: 110px">
                <td><P style="margin-top: 40px">'.$cod_produto.'</P></td>
                <td><img style="width:100px "src="../img/produtos/'.$foto_pr.'"> </td>
                <td width="400"><P style="margin-top: 40px">'.$nome.'</P></td>
                <td><P style="margin-top: 40px">R$: '. number_format($valor,2,',','.').'</P></td>
                <td><P style="margin-top: 40px">'.$quantidade.' Un</P></td>
                <td><P style="margin-top: 40px">'.$qtd.' Un</P></td>
                <td><P style="margin-top: 40px"> R$: '.number_format($somado,2,',','.').'</P></td>
                <td><a class="btn btn-success w-75" style="margin-top: 10px"href="ver_carrinho.php?id_produto='.$id.'">Adicionar +1</a>
                <a class="btn btn-dark mt-2 w-75" href="ver_carrinho.php?destroi_produto='.$id.'">Remover</a></td></tr>
';
                }
                }
?>
        </tbody>
    </table>

</div>