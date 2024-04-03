<?php
require_once("cabecalho.php");

if(!empty($_SESSION['id_usuario'])){
    $id_usuario = $_SESSION['id_usuario'];
    $sql= 'SELECT * FROM usuarios WHERE id_usuario= ?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($id_usuario));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);

}?>
<div class="accordion" id="accordionExample" style="margin-top:95px;">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
          <div style="width: 50%;margin:auto;">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Dados do usuário
        </button>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
        </svg>
      </h5>
    </div>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
<?php
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
?>
</div>
</div>
</div>

<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingtwo">
      <h5 class="mb-0">
          <div style="width: 50%;margin:auto;">
        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
          Cartões Cadastrados
        </button>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
        </svg>
      </h5>
    
    </div>
    </div>

    <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">
      <div class="card-body">    
        <div style="width: 50%;margin:auto;">
           <?php
           
            if(!empty($_SESSION['id_usuario'])){
                $id_usuario = $_SESSION['id_usuario'];
                $sql= 'SELECT * FROM cartao_usuario WHERE id_usuario= ?';
                $consulta = $conexao->prepare($sql);
                $consulta->execute(array($id_usuario));
                $dado = $consulta->fetch(PDO::FETCH_ASSOC);
                $data = DateTime::createFromFormat('Y-m-d',$dado['vencimento'] );
                $data1 = $data->format('d/m/Y');
            if(!empty($dado['id_cartao'])){
                echo '<div class="mb-3 mt-3">
            <label class="form-label">Nome: '.$dado['nome'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">N° do cartão: '.$dado['numero'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Vencimento: '. $data1 .'</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">N° de CCV: ***</label>
            </div>
            <div class="d-flex justify-content-end">
                <a href="adiciona_cartao.php">
                    <button class="btn btn-secondary me-2">Adicionar</button>
                </a>
                <a href="edita_cartao.php">
                <button class="btn btn-primary">Editar</button></a>
                </div>';
            }else{
       echo '<div class="mb-3 mt-3">
            <label class="form-label">Nome: ------- ------ ------</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">N° do cartão: -------------</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">Vencimento:------</label>
            </div>
            <div class="mb-3 mt-3">
            <label class="form-label">N° de CCV: ***</label>
            </div>
            <div class="d-flex justify-content-end">
                <a href="edita_cartao.php">
                    <button class="btn btn-secondary me-2">Adicionar</button>
                </a>
                    <button class="btn btn-primary">Editar</button>
                </div>';}
            }
            ?>
        </div>
</div>
</div>
</div>
    
    
<?php 

require_once('rodape.php');
?>
