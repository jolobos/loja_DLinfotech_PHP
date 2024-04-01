<?php
require_once("cabecalho.php");

if(!empty($_GET)){
 $msg = $_GET['mensagem'];
 echo '</br><P class="alert alert-success text-center">'.$msg.' </P>';
}

?>

<div class="container">
    <div class="form-box">
        <form action="#"  method="post" class="">
            <div class="row">
            <div class="col-md-4">            
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">nome:</label>
            <input class="form-control" placeholder="Digite o seu nome" name="nome">
            </div>
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" placeholder="Digite o seu email" name="email">
            </div>
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">CPF/CNPJ:</label>
            <input class="form-control" placeholder="Digite o seu CPF/CNPJ" name="CPF">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Telefone:</label>
            <input type="email" class="form-control" placeholder="Digite o seu telefone" name="telefone">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Celular:</label>
            <input class="form-control"  placeholder="Digite o seu celular" name="celular">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">CEP:</label>
            <input class="form-control" placeholder="Digite o seu CEP" name="CEP">
            </div>
            </div>
            <div class="col-md-4">            
            <div class="mb-3 mt-3">
            <label class="form-label">UF:</label>
            <input  class="form-control" placeholder="Digite o seu estado" name="UF">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Cidade:</label>
            <input class="form-control" placeholder="Digite a sua cidade" name="cidade">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Bairro:</label>
            <input  class="form-control" placeholder="Digite o seu bairro" name="bairro">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Logradouro:</label>
            <input class="form-control"  placeholder="Digite o seu endereço" name="logradouro">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Complemento:</label>
            <input class="form-control"  placeholder="Ex:casa,sitio,fundos..." name="complemento">
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Apelido</label>
            <input class="form-control"  placeholder="Digite um nick-apelido" name="apelido">
            </div>
            </div>
            </div>
            <div class="mb-3 mt-3 text-center">
            <input type="hidden" value=""/>
            <button type="submit" class="btn btn-primary ">Salvar as configurações</button>
            </div>
        </form>
        </div>
    
    
</div>


<?php
require_once('rodape.php');
?>
