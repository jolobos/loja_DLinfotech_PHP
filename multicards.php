<script type="text/javascript" src="js/multicards.js"></script>
<link rel="stylesheet" href="css/multicards.css">
<!------ Include the above in your HEAD tag ---------->

<div style="width:90%;margin:auto;">
    <div class="row" >
	<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel" >
            <div class="MultiCarousel-inner" style="width:100%;">
             
                <?php
                    $contagem_ids = 0;
                    while($contagem_ids < 16){
                        $contagem_ids +=1;
                        $id_car_prod = $d['id_car_prod_'.$contagem_ids];
                        $sql6 = "SELECT * FROM produtos WHERE id_produto = '".$id_car_prod."'";
                        $consulta6 = $conexao->query($sql6);
                        $dados6 = $consulta6->fetch(PDO::FETCH_ASSOC);

                        echo '<a href="produtos/pagina_produto.php?id_produto='.$id_car_prod.'"> 
                            <div class="item">
                                <div class="pad15" style="width:250px;height:450px">
                                    <img src="img/produtos/'.$dados6['foto'].'" style="width:200px;height:200px"/>
                                    <h4>'.$dados6['nome'].'</h4>
                                    </br>
                                    <h5 style="position: absolute;bottom: 20px;width: 230px;margin:auto">R$ '. number_format($dados6['valor'],2,',','.').'</h5>
                                </div>          
                            </div></a>';

                    }

                ?>
                        
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	</div>
	
</div>

