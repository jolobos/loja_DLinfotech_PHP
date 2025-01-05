<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(isset($_POST['ano_gr'])){
    $ano = $_POST['ano_gr'];
}else{
    $ano = date('Y');
}
$meses = 1;
while($meses <= 12){
    $sql = "SELECT COUNT(id_entregador) AS valor,hora_chegada FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-".$meses."-01' AND hora_chegada <= '".$ano."-".$meses."-31' AND status = 1";
    $consulta = $conexao->query($sql);
    $a = $consulta->fetch(PDO::FETCH_ASSOC);
    if($meses==1){$cal = 'janeiro';}elseif($meses==2) {$cal = 'fevereiro';}elseif($meses==3) {$cal = 'marco';}
    elseif($meses==4) {$cal = 'abril';}elseif($meses==5) {$cal = 'maio';}elseif($meses==6) {$cal = 'junho';}
    elseif($meses==7) {$cal = 'julho';}elseif($meses==8) {$cal = 'agosto';}elseif($meses==9) {$cal = 'setembro';}
    elseif($meses==10) {$cal = 'outubro';}elseif($meses==11) {$cal = 'novembro';}else{$cal = 'dezembro';}
    $data[] = array('mes_arr' => $a['valor'],'valor' => $cal);
    $meses++;
    }
    $new_data = array_column($data,'mes_arr','valor');
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
                <h5 class="text-secondary">Quantidade total de entregas:
            <?php
            $sqls = "SELECT COUNT(id_entregador) AS valor FROM entregas WHERE id_entregador = '".$id_entregador."' AND status = 1";
            $consultas = $conexao->query($sqls);
            $as = $consultas->fetch(PDO::FETCH_ASSOC);
            echo $as['valor'];
            ?></h5>
            </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST">
        <div class="row">
        <div class="col-sm-1">
        <select name="ano_gr" class="form-control">
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
        </select>
        </div>
            <div class="col">
                <input type="submit" class="btn btn-success" value="Selecionar">
            </div>
            </div>
    </form>
        <canvas id="myChart" width="1600" height="300"></canvas>
        <div class="row">
            <div class="col">
                <h5>Mês de Menor rendimento</h5>
                    <?php
                    $vy = min($new_data);
                    $vw = array_search($vy,$new_data);
                    echo $vw.' - '.$vy.' entregas <a href="ver_rend_mes_m.php?mes='.$vw.'&ano='.$ano.'" class="btn btn-secondary">Ver entregas</a>';
                    ?>
            
            </div>
            <div class="col">
                <h5>Mês de maior rendimento</h5>
                    <?php
                    $vy = max($new_data);
                    $vw = array_search($vy,$new_data);
                    echo $vw.' - '.$vy.' entregas <a href="ver_rend_mes_m.php?mes='.$vw.'&ano='.$ano.'" class="btn btn-secondary">Ver entregas</a>';
                    ?>
            </div>
            
            <div class="col-sm-5">
                <h5>Opções de rendimentos</h5>
                <a href="ver_rend_mes.php" class="btn btn-secondary">rendimentos por mês</a>
                <a href="ver_rend_periodo.php" class="btn btn-secondary">rendimentos por periodo</a>

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
              label: 'Quantidade de entregas no ano de '.concat(ano2),
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