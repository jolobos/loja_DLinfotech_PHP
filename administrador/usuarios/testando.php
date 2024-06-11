<?php 
$date1=date_create($_GET['data_person_temp_com_des']);
	$date2=date_create(date('Y-m-d'));
	$diff=date_diff($date1,$date2);
	$compras = $diff->format("%a");
	echo $compras;
?>