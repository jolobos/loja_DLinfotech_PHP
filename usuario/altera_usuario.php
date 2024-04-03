<?php
require_once("cabecalho.php");

if(!empty($_SESSION['id_usuario'])){
	$id_usuario = $_SESSION['id_usuario'];
	$sql= 'SELECT * FROM usuarios WHERE id_usuario= ?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($id_usuario));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);

}
echo '<div style="width: 50%;margin:auto;">
    
        <form action="altera_usuario.php"  method="post" class="">
            <div class="row">
            <div class="col" >            
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">Nome:</label>
            <input class="form-control " placeholder="Digite o seu nome" name="nome" value="'.$dado['nome'].'">
            </div>
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" placeholder="Digite o seu email" name="email" value="'.$dado['email'].'">
            </div>
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">CPF/CNPJ:</label>
            <input class="form-control" placeholder="Digite o seu CPF/CNPJ" name="CPF" value="'.$dado['CPF'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Telefone:</label>
            <input class="form-control" placeholder="Digite o seu telefone" name="telefone" value="'.$dado['telefone'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Celular:</label>
            <input class="form-control"  placeholder="Digite o seu celular" name="celular" value="'.$dado['celular'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">CEP:</label>
            <input class="form-control" placeholder="Digite o seu CEP" name="CEP" value="'.$dado['CEP'].'">
            </div>
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label class="form-label">UF:</label>
            <input  class="form-control" placeholder="Digite o seu estado" name="UF" value="'.$dado['UF'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Cidade:</label>
            <input class="form-control" placeholder="Digite a sua cidade" name="cidade" value="'.$dado['cidade'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Bairro:</label>
            <input  class="form-control" placeholder="Digite o seu bairro" name="bairro" value="'.$dado['bairro'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Logradouro:</label>
            <input class="form-control"  placeholder="Digite o seu endereço" name="logradouro" value="'.$dado['logradouro'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Complemento:</label>
            <input class="form-control"  placeholder="Ex:casa,sitio,fundos..." name="complemento" value="'.$dado['complemento'].'">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Apelido</label>
            <input class="form-control"  placeholder="Digite um nick-apelido" name="apelido" value="'.$dado['apelido'].'">
            </div>
            </div>
            </div>
            <div class="mb-3 mt-3" align="center">
            <input type="hidden" name="id_usuario" value="'.$dado['id_usuario'].'"/>
            <button type="submit" class="btn btn-primary ">Salvar as configurações</button>
            </div>
        </form>
    
    
</div>';


require_once('rodape.php');
?>
