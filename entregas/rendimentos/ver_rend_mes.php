<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['mes']) && isset($_POST['ano'])){
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    if($mes == 'janeiro'){ $meses = 1;}elseif($mes == 'fevereiro'){$meses = 2;}elseif($mes == 'marco'){$meses = 3;}elseif($mes == 'abril'){$meses = 4;}
    elseif($mes == 'maio'){$meses = 5;}elseif($mes == 'junho'){$meses = 6;}elseif($mes == 'julho'){$meses = 7;}elseif($mes == 'agosto'){$meses = 8;}
    elseif($mes == 'setembro'){$meses = 9;}elseif($mes == 'outubro'){$meses = 10;}elseif($mes == 'novembro'){$meses = 11;}else{$meses = 12;}
}else{
    $meses = intval(date('m'));
    $ano = date('Y');
    if($meses == 1){ $mes = 'janeiro';}elseif($meses == 2){$mes = 'fevereiro';}elseif($meses == 3){$mes = 'marco';}elseif($meses == 4){$mes = 'abril';}
    elseif($meses == 5){$mes = 'maio';}elseif($meses == 6){$mes = 'junho';}elseif($meses == 7){$mes = 'julho';}elseif($meses == 8){$mes = 'agosto';}
    elseif($meses == 9){$mes = 'setembro';}elseif($meses == 10){$mes = 'outubro';}elseif($meses == 11){$mes = 'novembro';}else{$mes = 'dezembro';}
    
}
$dia = 1;
if($meses == 1 || $meses == 3 || $meses == 5 || $meses == 7 || $meses == 8 || $meses == 10 || $meses == 12){
    $ctrl_dia = 31;
}elseif($meses == 4 || $meses == 6 || $meses == 9 || $meses == 11){
    $ctrl_dia = 30;
}else{
    if($meses == 2 && $ano % 4 == 0){
    $ctrl_dia = 29;}else{
        $ctrl_dia = 28;
    }
}
while($dia <= $ctrl_dia){
    $sql = "SELECT COUNT(id_entregador) AS valor,hora_chegada FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-".$meses."-".$dia." 00:00:00' AND hora_chegada <= '".$ano."-".$meses."-".$dia." 23:59:59' AND status = 1";
    $consulta = $conexao->query($sql);
    $a = $consulta->fetch(PDO::FETCH_ASSOC);
    $data[] = array('mes_arr' => $a['valor'],'valor' => $dia);
    $dia++;
        }
    $new_data = array_column($data,'mes_arr','valor');
    $legenda = $mes.' de '.$ano;
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
</head>
  <body style="background: #778899">
    <div class="container">
        <div class="bg-dark">
            <div class="row">
                <div class="col" >
                    <h1 class="text-success ms-3">
                        Sistema de entregas DL
                    </h1>
                </div>
                <div class="col" align="right">
                    <a class="btn btn-secondary border-info m-2" href="rendimentos.php">Voltar</a>
                    <a class="btn btn-secondary border-info m-2" href="../home.php">INICIO</a>
                    <a href="../sair.php" class="btn btn-secondary border-info m-2">Sair</a>
                </div>
            </div>
                  
           <?php echo '<img src="../../img/foto_usuario/'.$foto.'" style="border-radius: 50%;width:50px;height:50px;align=left;margin-left:20px;margin-bottom:15px;">';
           echo '<strong class="text-success"> - '.$nome.' </strong>';
           ?>
	</div>
    <div class="card">
        <div class="card-header">
            <div class="row">
            <div class="col">
            <h3 class="text-primary">Performace do entregador</h3>
            </div>
            <div class="col" align="right">  
                <form method="POST">
                <div class="row">
                <div class="col">
                <select name="mes" class="form-control">
                    <option value="janeiro">janeiro</option>
                    <option value="fevereiro">fevereiro</option>
                    <option value="marco">marco</option>
                    <option value="abril">abril</option>
                    <option value="maio">maio</option>
                    <option value="junho">junho</option>
                    <option value="julho">julho</option>
                    <option value="agosto">agosto</option>
                    <option value="setembro">setembro</option>
                    <option value="outubro">outubro</option>
                    <option value="novembro">novembro</option>
                    <option value="dezembro">dezembro</option>
                </select>
                </div>
                <div class="col">
                <select name="ano" class="form-control">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
                </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-success" value="Selecionar">
                    </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <div class="card-body">
            <h5>Entregas no mês de <?php echo $legenda;?></h5>
            <h6 class="text-secondary">Total de entregas no mês: <?php
                $sqly = "SELECT COUNT(id_entregador) AS valor FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-".$meses."-01 00:00:00' AND hora_chegada <= '".$ano."-".$meses."-31 23:59:59' AND status = 1";
                $consultay = $conexao->query($sqly);
                $ay = $consultay->fetch(PDO::FETCH_ASSOC);
                echo $ay['valor'];
                ?></h6>
                 <canvas id="myChart" width="1600" height="300"></canvas>
   
                <div class="row">
            <div class="col">
                <h5>Dia de menor rendimento</h5>
                    <?php
                    $vy = min($new_data);
                    $vw = array_search($vy,$new_data);
                    echo $vw.'° dia - '.$vy.' entregas';
                    ?>
            
            </div>
            <div class="col">
                <h5>Dia de maior rendimento</h5>
                    <?php
                    $vy = max($new_data);
                    $vw = array_search($vy,$new_data);
                    echo $vw.'° dia - '.$vy.' entregas ';
                    ?>
            </div>
            
            <div class="col-sm-5">
                <h5>Opções de rendimentos</h5>
                <?php echo '<a href="verificar.php?mes='.$mes.'&ano='.$ano.'" class="btn btn-secondary">Verificar entregas</a>'; ?>

            </div>
        </div>
            
        </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    
      // unica diferença é que você receberá o json dinamicamente
      // valor que chegará da requisição            
      let json = <?php echo json_encode($new_data); ?>
      //let json = JSON.parse('{ "jose":3 , "maria":2, "joão":3 , "pedro":4}')
      var ano2 = <?php echo $ano; ?>
      // cria uma array para nomes e valore
      let nomes = [];
      let valores = [];

      // percorre o json
      for(let i in json){
         // adiciona na array nomes a key do campo do json
         nomes.push(i);
         // adiciona na array de valore o value do campo do json
         valores.push(json[i]);
      }

      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          //labels são cada uma das barrinhas. Basta adicionar a array abaixo:
          labels: nomes,
          datasets: [{
              label: 'Quantidade de entregas no mes',
              //data serve para adicionar o valor de cada barrinha. Basta adicionar a array abaixo:
              data: valores,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
   

</script>
</body>