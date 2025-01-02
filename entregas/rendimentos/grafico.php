<?php
require_once '../../database.php';
require_once '../verifica_session.php';
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['ano_gr'])){
    $ano = $_GET['ano_gr'];
}else{
    $ano = 2024;
}
$sql = "SELECT id_entregador,hora_chegada FROM entregas WHERE id_entregador = '".$id_entregador."' AND hora_chegada >= '".$ano."-01-01' AND hora_chegada <= '".$ano."-12-31'";
$consulta = $conexao->query($sql);
$a = $consulta->fetchALL(PDO::FETCH_ASSOC);
$data = array();
foreach ($a as $b){
    $sqlent = "SELECT * FROM entregador_us WHERE id_entregador = '".$b['id_entregador']."'";
    $consultaent = $conexao->query($sqlent);
    $c = $consultaent->fetch(PDO::FETCH_ASSOC);
    
    $data[] = array($c['nome'] => $b['hora_chegada']);
    print_r($data);
    echo '<br>';
}
echo json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<canvas id="myChart" ></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    
      // unica diferença é que você receberá o json dinamicamente
      // valor que chegará da requisição            
      let json = JSON.parse('{ "jose":3 , "maria":2, "joão":3 , "pedro":4}')

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
              label: '# of Votes',
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