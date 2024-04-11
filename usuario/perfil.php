<?php
require_once("../verifica_session.php");
require_once("cabecalho.php");
if(!empty($_GET['mensagem'])){
echo '<h3 class="alert alert-secondary text-center" style="margin-top:95px">'.$_GET['mensagem'].'</h3>';
 echo '<div class="container" > <div style="width: 70%;margin:auto;"><h3 >Perfil</h3>' ;}else{
   echo '<div class="container" > <div style="width: 70%;margin:auto;"><h3 style="margin-top:95px">Perfil</h3>'; 
}

if(!empty($_SESSION['id_usuario'])){
    $sql= 'SELECT * FROM usuarios WHERE id_usuario= ?';
    $consulta = $conexao->prepare($sql);
    $consulta->execute(array($id_usuario));
    $dado = $consulta->fetch(PDO::FETCH_ASSOC);
    $data = DateTime::createFromFormat('Y-m-d H:i:s',$dado['data_entrada'] );
    $data1 = $data->format('d/m/Y H:i:s');
    if($dado['status'] > 0){
        $status = 'ATIVO';
    }else{
        $status = 'DESATIVADO';
        }
}
?>

    <hr/>
<?php
    echo '<form action="#"  method="post" class="">
            <div class="row">
            <div class="col" >            
            
            <div class="mb-3 mt-3">
            <label  class="form-label">Nome:</label>
            <label class="form-label">'.$dado['nome'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label  class="form-label">CPF/CNPJ:</label>
            <label class="form-label">'.$dado['CPF'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label  class="form-label">Telefone:</label>
            <label  class="form-label">'.$dado['telefone'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label  class="form-label">Celular:</label>
            <label  class="form-label">'.$dado['celular'].'</label>
            </div>
                  <div class="mb-3 mt-3">
            <label  class="form-label">CEP:</label>
            <label  class="form-label">'.$dado['CEP'].'</label>
            </div>
                  <div class="mb-3 mt-3">
            <label  class="form-label">Estado:</label>
            <label  class="form-label">'.$dado['UF'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label  class="form-label">Cidade:</label>
            <label  class="form-label">'.$dado['cidade'].'</label>
            </div> 
            </div>
            <div class="col">            
            <div class="mb-3 mt-3">
            <label  class="form-label">Bairro:</label>
            <label  class="form-label">'.$dado['bairro'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label  class="form-label">Endereço:</label>
            <label  class="form-label">'.$dado['logradouro'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label class="form-label">Complemento:</label>
            <label  class="form-label">'.$dado['complemento'].'</label>
            </div>
                <div class="mb-3 mt-3">
            <label  class="form-label">Email:</label>
            <label  class="form-label">'.$dado['email'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label  class="form-label">Apelido:</label>
            <label  class="form-label">'.$dado['apelido'].'</label>
            </div>
            <div class="mb-3 mt-3">
            <label  class="form-label">Data do cadastro:</label>
            <label  class="form-label">'.$data1.'</label>
            </div>
            <div class="mb-3 mt-3">
            <label  class="form-label">Condição:</label>
            <label  class="form-label">'.$status.'</label>
            </div>
            </div>
            </div>
        </form><hr/>';
		
	
	
	?>
	
     
</div>
