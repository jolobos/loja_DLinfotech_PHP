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
    $sql = "SELECT COUNT(id_entregador) AS valor,hora_chegada FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-".$meses."-01' AND hora_chegada <= '".$ano."-".$meses."-31'";
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

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
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
<canvas id="myChart" style="height: 20%"></canvas>
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