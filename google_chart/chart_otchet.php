
<?php
include  '/www/wwwroot/boostrap.local/app/db.php';

$sum_order = sum_orders_on_month($_SESSION['mindate'],$_SESSION['maxdate']);
$kolvo_reg_users_on_week = kolvo_reg_users_on_week($_SESSION['mindate'],$_SESSION['maxdate']);
$kolvo_orders_on_week = kolvo_orders_on_week($_SESSION['mindate'],$_SESSION['maxdate']);


$month = [
	"1" => 'Январь',"2" => 'Февраль',"3" => 'Март',"4" => 'Апрель',
	"5" => 'Май',"6" => 'Июнь',"7" => 'Июль',"8"=>'Август',
	"9"=> 'Сентябрь',"10"=> 'Октябрь',"11"=>'Ноябрь',"12"=>'Декабрь'
	];

$date_m=$month[$sum_order[0]['month']];

$test = [];
$test1 = [];
$test2= [];

?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Blog</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
	
	<link rel="shortcut icon" type="image/png" href="/assets/image/favicon1.png">

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<script>
		type = "text/javascript" >

		google.charts.load('current', { 'packages': ['corechart'] });
	
		google.charts.setOnLoadCallback(drawChart);


		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Месяц','Сумма'],
				<?php 
				foreach($sum_order as $ord){
					$str = "['". $month[$ord['month']]." ". $ord['year']."' , ".$ord['sum']."],";
					echo $str;
				}

				?>
			]);

			var data2 = new google.visualization.arrayToDataTable([
				['Недели','Рег.польз'],
				<?php 
					$year = $kolvo_reg_users_on_week[0]['year'];
					foreach($kolvo_reg_users_on_week as $users_on_month){
						if($users_on_month['year']==$year){
							$str = "['". $users_on_month['week']. " ". $users_on_month['year'] ."',".$users_on_month['count']."],";
							$year++;}
						else
							$str = "['". $users_on_month['week'] ."',".$users_on_month['count']."],";
						echo $str;
					}
					
				?>
			]);

		
			var orders_week = new google.visualization.DataTable(
				<?php	$orders_week = '{
				"cols": [
						{"label":"Недели","type":"string"},
						{"label":"Заказы","type":"number"}
					],
				"rows": [';
				$year = $kolvo_orders_on_week[0]['year'];
				foreach($kolvo_orders_on_week as $order){
					$orders_week.= '{"c":[{"v":"';
						if($order['year']==$year){
							$orders_week.=  $order['week'] .' ' . $order['year']. 'г' ;
							$year++;
						}
						else{
							$orders_week.=  $order['week'];
						}
						
						$orders_week.=' "},{"v":';
						$orders_week.= $order['count'];
						$orders_week.= '  }]},';
				}
				$orders_week = rtrim($orders_week, ',');
				$orders_week.=']}';
					echo $orders_week;
				?>
			);

			//Расчет скользящих средних "Выручка по месяцам"
			<?php $monthly_revenue = [];
				
			for($i=0;$i<count($sum_order);$i++){

				$a = $month[$sum_order[$i]['month']] ." ". $sum_order[$i]['year'];
				
				$b = $sum_order[$i]['sum'];

				if($i<1 || $i==count($sum_order)-1){
					if($i==0){
						$c = round((5*$sum_order[0]['sum']+2*$sum_order[1]['sum']-$sum_order[2]['sum'])/6,2);
					}
					else{
						$c = round((-1*$sum_order[$i-2]['sum']+2*$sum_order[$i-1]['sum']+5*$sum_order[$i]['sum'])/6,2);
					}
					
				}
				else
					$c = round(($sum_order[$i+1]['sum']+$sum_order[$i]['sum']+$sum_order[$i-1]['sum'])/3,2);
				

				if($i<3 || $i>count($sum_order)-4){
					if($i==0)
						$d = round((39 * $sum_order[0]['sum'] + 8 * $sum_order[1]['sum'] - 4 * $sum_order[2]['sum'] - 4 * $sum_order[3]['sum'] + $sum_order[4]['sum'] + 4 * $sum_order[5]['sum'] - 2 * $sum_order[6]['sum'])/42,2);
					if($i==1)
						$d = round((8 * $sum_order[0]['sum'] + 19 * $sum_order[1]['sum'] + 16 * $sum_order[2]['sum'] + 6 * $sum_order[3]['sum'] - 4* $sum_order[4]['sum'] - 7 * $sum_order[5]['sum'] + 4 * $sum_order[6]['sum'])/42,2);
					if($i==2)
						$d = round((-4 * $sum_order[0]['sum'] + 16 * $sum_order[1]['sum'] + 19 * $sum_order[2]['sum'] + 12 * $sum_order[3]['sum'] + 2 * $sum_order[4]['sum'] - 4 * $sum_order[5]['sum'] + 1 * $sum_order[6]['sum'])/42,2);
					if($i==count($sum_order)-3){
						$d = round((1 * $sum_order[$i+2]['sum'] - 4 * $sum_order[$i+1]['sum'] + 2 * $sum_order[$i]['sum'] + 12 * $sum_order[$i-1]['sum'] + 19 * $sum_order[$i-2]['sum'] + 16 * $sum_order[$i-3]['sum'] - 4 * $sum_order[$i-4]['sum'])/42,2);
					}
					if($i==count($sum_order)-2){
						$d = round((4 * $sum_order[$i+1]['sum'] - 7 * $sum_order[$i]['sum'] - 4 * $sum_order[$i-1]['sum'] + 6 * $sum_order[$i-2]['sum'] + 16 * $sum_order[$i-3]['sum'] + 19 * $sum_order[$i-4]['sum'] + 8 * $sum_order[$i-5]['sum'])/42,2);
					}
					if($i==count($sum_order)-1){
						$d = round((2 * $sum_order[$i]['sum'] + 4 * $sum_order[$i-1]['sum'] + 1 * $sum_order[$i-2]['sum'] - 4 * $sum_order[$i-3]['sum'] - 4 * $sum_order[$i-4]['sum'] + 4 * $sum_order[$i-5]['sum'] + 39 * $sum_order[$i-6]['sum'])/42,2);
					}
				}
				else
					$d = round(($sum_order[$i-3]['sum']+$sum_order[$i-2]['sum']+$sum_order[$i-1]['sum']+$sum_order[$i]['sum']+$sum_order[$i+1]['sum']+$sum_order[$i+2]['sum']+$sum_order[$i+3]['sum'])/7,2);
	

				if($i<2 || $i>count($sum_order)-3){
				if($i==0)
					$e = round((1/35)*($sum_order[0]['sum']*(31) + $sum_order[1]['sum'] * 9 + $sum_order[2]['sum'] * (-3) + $sum_order[3]['sum'] * (-5) + $sum_order[4]['sum']*(3)),2);
				if($i==1)
					$e = round((1/35)*($sum_order[0]['sum']*(9) + $sum_order[1]['sum']*13 + $sum_order[2]['sum']*12 + $sum_order[3]['sum']*6 + $sum_order[4]['sum']*(-5)),2);
				if($i==count($sum_order)-2)
					$e = round((1/35)*($sum_order[$i+1]['sum']*(-5) + $sum_order[$i]['sum']* 6 + $sum_order[$i-1]['sum']* 12 + $sum_order[$i-2]['sum']* 13 + $sum_order[$i-3]['sum']*(-9)),2);
				if($i==count($sum_order)-1)
					$e = round((1/35)*($sum_order[$i]['sum']*(3) + $sum_order[$i-1]['sum']* (-5) + $sum_order[$i-2]['sum']* (-3) + $sum_order[$i-3]['sum']* 9 + $sum_order[$i-4]['sum']*(31)),2);
				
				}else
					$e = round((1/35)*($sum_order[$i-2]['sum']*(-3) + $sum_order[$i-1]['sum']*12 + $sum_order[$i]['sum']*17 + $sum_order[$i+1]['sum']*12 + $sum_order[$i+2]['sum']*(-3)),2);
				
				array_push($monthly_revenue , [$a,$b,$c,$d,$e]);
			
			}
			$a = "Прогноз";
			$b = null;
			$c =  round(1/3 * ($monthly_revenue[count($monthly_revenue)-1][2] + $monthly_revenue[count($monthly_revenue)-2][2] + $monthly_revenue[count($monthly_revenue)-3][2]),2);
			$d =  round(1/7 * ($monthly_revenue[count($monthly_revenue)-1][3] + $monthly_revenue[count($monthly_revenue)-2][3] + $monthly_revenue[count($monthly_revenue)-3][3] + $monthly_revenue[count($monthly_revenue)-4][3] + $monthly_revenue[count($monthly_revenue)-5][3] + $monthly_revenue[count($monthly_revenue)-6][3] + $monthly_revenue[count($monthly_revenue)-7][3]),2);
			$e =  round(1/5 * ($monthly_revenue[count($monthly_revenue)-1][4] + $monthly_revenue[count($monthly_revenue)-2][4] + $monthly_revenue[count($monthly_revenue)-3][4] + $monthly_revenue[count($monthly_revenue)-4][4] + $monthly_revenue[count($monthly_revenue)-5][4]),2);
			array_push($monthly_revenue , [$a,$b,$c,$d,$e]);

			$monthly_revenue_v2 = $monthly_revenue;
			array_pop($monthly_revenue_v2);

			$monthly_revenue_v1 = [];
			array_push($monthly_revenue_v1,[$month[$sum_order[0]['month']] ." ". $sum_order[0]['year'],$sum_order[0]['sum'],null,null,null]);
			for($i=1;$i<count($sum_order);$i++){
				$a = $month[$sum_order[$i]['month']] ." ". $sum_order[$i]['year'];
				$b = $sum_order[$i]['sum'];

				if($i==count($sum_order)-1)
					$c = null;
				else
					$c = round(($sum_order[$i+1]['sum']+$sum_order[$i]['sum']+$sum_order[$i-1]['sum'])/3,2);
				

				if($i<3 || $i>count($sum_order)-4)
					$d = null;
				else
					$d = round(($sum_order[$i-3]['sum']+$sum_order[$i-2]['sum']+$sum_order[$i-1]['sum']+$sum_order[$i]['sum']+$sum_order[$i+1]['sum']+$sum_order[$i+2]['sum']+$sum_order[$i+3]['sum'])/7,2);
	

				if($i<2 || $i>count($sum_order)-3)
					$e = null;
				else
					$e = round((1/35)*($sum_order[$i-2]['sum']*(-3) + $sum_order[$i-1]['sum']*12 + $sum_order[$i]['sum']*17 + $sum_order[$i+1]['sum']*12 + $sum_order[$i+2]['sum']*(-3)),2);
				
				array_push($monthly_revenue_v1 , [$a,$b,$c,$d,$e]);
				
			}



			?>
			var monthly_rev = google.visualization.arrayToDataTable([
				[ 'Месяц', 'Выручка', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($monthly_revenue as $key => $dat) {
					$st = "['$dat[0]', ". $dat[1] .", ". $dat[2] .", ". $dat[3] .", ". $dat[4] ."],";
				    echo($st);
			
				
				}				?>
			]);

			var monthly_rev_v1 = google.visualization.arrayToDataTable([
				[ 'Месяц', 'Выручка', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($monthly_revenue_v1 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					    echo($st);
				
				
				}				?>
			]);

			var monthly_rev_v2 = google.visualization.arrayToDataTable([
				[ 'Месяц', 'Выручка', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($monthly_revenue_v2 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					    echo($st);
			
				
				}				?>
			]);
			var options_monthly_rev = {
				title: 'Расчет скользящих средних "Выручка по месяцам"',
				// hAxis: {title: 'Месяцы'},
				curveType: 'function',
				'width': 1550,
				'height': 800,
				legend: { position: 'bottom' },
				backgroundColor: {
				
					'fill': ''
				}
			};

			//Расчет скользящих средних "Регистрация пользователей по неделям"
			<?php $reg_users_on_week = [];
			$year =  $kolvo_reg_users_on_week[0]['year'];
		
			for($i=0;$i<count($kolvo_reg_users_on_week);$i++){

				if( $kolvo_reg_users_on_week[$i]['year']==$year){
					$a = $kolvo_reg_users_on_week[$i]['week'] ." ". $kolvo_reg_users_on_week[$i]['year'];
					$year++;
				}else{
					$a = $kolvo_reg_users_on_week[$i]['week'];
				}
				
				$b = $kolvo_reg_users_on_week[$i]['count'];

				if($i<1 || $i==count($kolvo_reg_users_on_week)-1){

					if($i==0){
						$c = round((5 * $kolvo_reg_users_on_week[0]['count']+2 * $kolvo_reg_users_on_week[1]['count'] - $kolvo_reg_users_on_week[2]['count'])/6,2);
					}
					else{
						$c = round((-1*$kolvo_reg_users_on_week[$i-2]['count']+2*$kolvo_reg_users_on_week[$i-1]['count']+5*$kolvo_reg_users_on_week[$i]['count'])/6,2);
					}
					
				}
				else
					$c = round(($kolvo_reg_users_on_week[$i+1]['count']+$kolvo_reg_users_on_week[$i]['count']+$kolvo_reg_users_on_week[$i-1]['count'])/3,2);
				

				if($i<3 || $i>count($kolvo_reg_users_on_week)-4){
					if($i==0)
						$d = round((39 * $kolvo_reg_users_on_week[0]['count'] + 8 * $kolvo_reg_users_on_week[1]['count'] - 4 * $kolvo_reg_users_on_week[2]['count'] - 4 * $kolvo_reg_users_on_week[3]['count'] + $kolvo_reg_users_on_week[4]['count'] + 4 * $kolvo_reg_users_on_week[5]['count'] - 2 * $kolvo_reg_users_on_week[6]['count'])/42,2);
					if($i==1)
						$d = round((8 * $kolvo_reg_users_on_week[0]['count'] + 19 * $kolvo_reg_users_on_week[1]['count'] + 16 * $kolvo_reg_users_on_week[2]['count'] + 6 * $kolvo_reg_users_on_week[3]['count'] - 4* $kolvo_reg_users_on_week[4]['count'] - 7 * $kolvo_reg_users_on_week[5]['count'] + 4 * $kolvo_reg_users_on_week[6]['count'])/42,2);
					if($i==2)
						$d = round((-4 * $kolvo_reg_users_on_week[0]['count'] + 16 * $kolvo_reg_users_on_week[1]['count'] + 19 * $kolvo_reg_users_on_week[2]['count'] + 12 * $kolvo_reg_users_on_week[3]['count'] + 2 * $kolvo_reg_users_on_week[4]['count'] - 4 * $kolvo_reg_users_on_week[5]['count'] + 1 * $kolvo_reg_users_on_week[6]['count'])/42,2);
					if($i==count($kolvo_reg_users_on_week)-3){
						$d = round((1 * $kolvo_reg_users_on_week[$i+2]['count'] - 4 * $kolvo_reg_users_on_week[$i+1]['count'] + 2 * $kolvo_reg_users_on_week[$i]['count'] + 12 * $kolvo_reg_users_on_week[$i-1]['count'] + 19 * $kolvo_reg_users_on_week[$i-2]['count'] + 16 * $kolvo_reg_users_on_week[$i-3]['count'] - 4 * $kolvo_reg_users_on_week[$i-4]['count'])/42,2);
					}
					if($i==count($kolvo_reg_users_on_week)-2){
						$d = round((4 * $kolvo_reg_users_on_week[$i+1]['count'] - 7 * $kolvo_reg_users_on_week[$i]['count'] - 4 * $kolvo_reg_users_on_week[$i-1]['count'] + 6 * $kolvo_reg_users_on_week[$i-2]['count'] + 16 * $kolvo_reg_users_on_week[$i-3]['count'] + 19 * $kolvo_reg_users_on_week[$i-4]['count'] + 8 * $kolvo_reg_users_on_week[$i-5]['count'])/42,2);
					}
					if($i==count($kolvo_reg_users_on_week)-1){
						$d = round((2 * $kolvo_reg_users_on_week[$i]['count'] + 4 * $kolvo_reg_users_on_week[$i-1]['count'] + 1 * $kolvo_reg_users_on_week[$i-2]['count'] - 4 * $kolvo_reg_users_on_week[$i-3]['count'] - 4 * $kolvo_reg_users_on_week[$i-4]['count'] + 4 * $kolvo_reg_users_on_week[$i-5]['count'] + 39 * $kolvo_reg_users_on_week[$i-6]['count'])/42,2);
					}
				}
				else
					$d = round(($kolvo_reg_users_on_week[$i-3]['count']+$kolvo_reg_users_on_week[$i-2]['count']+$kolvo_reg_users_on_week[$i-1]['count']+$kolvo_reg_users_on_week[$i]['count']+$kolvo_reg_users_on_week[$i+1]['count']+$kolvo_reg_users_on_week[$i+2]['count']+$kolvo_reg_users_on_week[$i+3]['count'])/7,2);
	

				if($i<2 || $i>count($kolvo_reg_users_on_week)-3){
				if($i==0)
					$e = round((1/35)*($kolvo_reg_users_on_week[0]['count']*(31) + $kolvo_reg_users_on_week[1]['count'] * 9 + $kolvo_reg_users_on_week[2]['count'] * (-3) + $kolvo_reg_users_on_week[3]['count'] * (-5) + $kolvo_reg_users_on_week[4]['count']*(3)),2);
				if($i==1)
					$e = round((1/35)*($kolvo_reg_users_on_week[0]['count']*(9) + $kolvo_reg_users_on_week[1]['count']*13 + $kolvo_reg_users_on_week[2]['count']*12 + $kolvo_reg_users_on_week[3]['count']*6 + $kolvo_reg_users_on_week[4]['count']*(-5)),2);
				if($i==count($kolvo_reg_users_on_week)-2)
					$e = round((1/35)*($kolvo_reg_users_on_week[$i+1]['count']*(-5) + $kolvo_reg_users_on_week[$i]['count']* 6 + $kolvo_reg_users_on_week[$i-1]['count']* 12 + $kolvo_reg_users_on_week[$i-2]['count']* 13 + $kolvo_reg_users_on_week[$i-3]['count']*(-9)),2);
				if($i==count($kolvo_reg_users_on_week)-1)
					$e = round((1/35)*($kolvo_reg_users_on_week[$i]['count']*(3) + $kolvo_reg_users_on_week[$i-1]['count']* (-5) + $kolvo_reg_users_on_week[$i-2]['count']* (-3) + $kolvo_reg_users_on_week[$i-3]['count']* 9 + $kolvo_reg_users_on_week[$i-4]['count']*(31)),2);
				
				}else
					$e = round((1/35)*($kolvo_reg_users_on_week[$i-2]['count']*(-3) + $kolvo_reg_users_on_week[$i-1]['count']*12 + $kolvo_reg_users_on_week[$i]['count']*17 + $kolvo_reg_users_on_week[$i+1]['count']*12 + $kolvo_reg_users_on_week[$i+2]['count']*(-3)),2);
				
				array_push($reg_users_on_week , [$a,$b,$c,$d,$e]);

				
			}
			$a = "Прогноз";
			$b = null;
			$c =  round(1/3 * ($reg_users_on_week[count($reg_users_on_week)-1][2] + $reg_users_on_week[count($reg_users_on_week)-2][2] + $reg_users_on_week[count($reg_users_on_week)-3][2]),2);
			$d =  round(1/7 * ($reg_users_on_week[count($reg_users_on_week)-1][3] + $reg_users_on_week[count($reg_users_on_week)-2][3] + $reg_users_on_week[count($reg_users_on_week)-3][3] + $reg_users_on_week[count($reg_users_on_week)-4][3] + $reg_users_on_week[count($reg_users_on_week)-5][3] + $reg_users_on_week[count($reg_users_on_week)-6][3] + $reg_users_on_week[count($reg_users_on_week)-7][3]),2);
			$e =  round(1/5 * ($reg_users_on_week[count($reg_users_on_week)-1][4] + $reg_users_on_week[count($reg_users_on_week)-2][4] + $reg_users_on_week[count($reg_users_on_week)-3][4] + $reg_users_on_week[count($reg_users_on_week)-4][4] + $reg_users_on_week[count($reg_users_on_week)-5][4]),2);
			array_push($reg_users_on_week , [$a,$b,$c,$d,$e]);

			$reg_users_on_week_v1 = [];
			$year =  $kolvo_reg_users_on_week[0]['year'];
			
			array_push($reg_users_on_week_v1,[$kolvo_reg_users_on_week[0]['week'] ." ". $kolvo_reg_users_on_week[0]['year'],$kolvo_reg_users_on_week[0]['count'],null,null,null]);
			for($i=1;$i<count($kolvo_reg_users_on_week);$i++){

				if( $kolvo_reg_users_on_week[$i]['year']==$year){
					$a = $kolvo_reg_users_on_week[$i]['week'] ." ". $kolvo_reg_users_on_week[$i]['year'];
					$year++;
				}else{
					$a = $kolvo_reg_users_on_week[$i]['week'];
				}
				
				
				$b = $kolvo_reg_users_on_week[$i]['count'];

				if($i==count($kolvo_reg_users_on_week)-1)
					$c = null;
				else
					$c = round(($kolvo_reg_users_on_week[$i+1]['count']+$kolvo_reg_users_on_week[$i]['count']+$kolvo_reg_users_on_week[$i-1]['count'])/3,2);
				

				if($i<3 || $i>count($kolvo_reg_users_on_week)-4)
					$d = null;
				else
					$d = round(($kolvo_reg_users_on_week[$i-3]['count']+$kolvo_reg_users_on_week[$i-2]['count']+$kolvo_reg_users_on_week[$i-1]['count']+$kolvo_reg_users_on_week[$i]['count']+$kolvo_reg_users_on_week[$i+1]['count']+$kolvo_reg_users_on_week[$i+2]['count']+$kolvo_reg_users_on_week[$i+3]['count'])/7,2);
	

				if($i<2 || $i>count($kolvo_reg_users_on_week)-3)
					$e = null;
				else
					$e = round((1/35)*($kolvo_reg_users_on_week[$i-2]['count']*(-3) + $kolvo_reg_users_on_week[$i-1]['count']*12 + $kolvo_reg_users_on_week[$i]['count']*17 + $kolvo_reg_users_on_week[$i+1]['count']*12 + $kolvo_reg_users_on_week[$i+2]['count']*(-3)),2);
				
				array_push($reg_users_on_week_v1 , [$a,$b,$c,$d,$e]);
				
			}
			?>
		
			var reg_user = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Количество', 'l=3', 'l=7', 'l=5'],
				<?php 
					
				foreach ($reg_users_on_week as $key => $dat) {
					$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					echo($st);
					
				
				}				?>
			]);
			var reg_user_v1 = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Количество', 'l=3', 'l=7', 'l=5'],
				<?php 
					
				foreach ($reg_users_on_week_v1 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					
					echo($st);
					
				
				}				?>
			]);
			var reg_user_v2 = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Количество', 'l=3', 'l=7', 'l=5'],
				<?php 
				$reg_users_on_week_v2 = $reg_users_on_week;
				array_pop($reg_users_on_week_v2);	
				foreach ($reg_users_on_week_v2 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					
					echo($st);
					
				
				}				?>
			]);

			var option_reg_user = {
				title: 'Расчет скользящих средних "Регистрация пользователей по неделям"',
				// hAxis: {title: 'Месяцы'},
				curveType: 'function',
				'width': 1550,
				'height': 800,
				legend: { position: 'bottom' },
				backgroundColor: {
				
					'fill': ''
				}
			};

			//Расчет скользящих средних "Заказов по неделям"
			<?php $order_on_week = [];
			$year =  $kolvo_orders_on_week[0]['year'];

			for($i=0;$i<count($kolvo_orders_on_week);$i++){

				if( $kolvo_orders_on_week[$i]['year']==$year){
					$a = $kolvo_orders_on_week[$i]['week'] ." ". $kolvo_orders_on_week[$i]['year'];
					$year++;
				}else{
					$a = $kolvo_orders_on_week[$i]['week'];
				}
					
					
					$b = $kolvo_orders_on_week[$i]['count'];

				if($i<1 || $i==count($kolvo_orders_on_week)-1){
					if($i==0){
						$c = round((5*$kolvo_orders_on_week[0]['count']+2*$kolvo_orders_on_week[1]['count']-$kolvo_orders_on_week[2]['count'])/6,2);
					}
					else{
						$c = round((-1*$kolvo_orders_on_week[$i-2]['count']+2*$kolvo_orders_on_week[$i-1]['count']+5*$kolvo_orders_on_week[$i]['count'])/6,2);
					}
					
				}
				else
					$c = round(($kolvo_orders_on_week[$i+1]['count']+$kolvo_orders_on_week[$i]['count']+$kolvo_orders_on_week[$i-1]['count'])/3,2);
				

				if($i<3 || $i>count($kolvo_orders_on_week)-4){
					if($i==0)
						$d = round((39 * $kolvo_orders_on_week[0]['count'] + 8 * $kolvo_orders_on_week[1]['count'] - 4 * $kolvo_orders_on_week[2]['count'] - 4 * $kolvo_orders_on_week[3]['count'] + $kolvo_orders_on_week[4]['count'] + 4 * $kolvo_orders_on_week[5]['count'] - 2 * $kolvo_orders_on_week[6]['count'])/42,2);
					if($i==1)
						$d = round((8 * $kolvo_orders_on_week[0]['count'] + 19 * $kolvo_orders_on_week[1]['count'] + 16 * $kolvo_orders_on_week[2]['count'] + 6 * $kolvo_orders_on_week[3]['count'] - 4* $kolvo_orders_on_week[4]['count'] - 7 * $kolvo_orders_on_week[5]['count'] + 4 * $kolvo_orders_on_week[6]['count'])/42,2);
					if($i==2)
						$d = round((-4 * $kolvo_orders_on_week[0]['count'] + 16 * $kolvo_orders_on_week[1]['count'] + 19 * $kolvo_orders_on_week[2]['count'] + 12 * $kolvo_orders_on_week[3]['count'] + 2 * $kolvo_orders_on_week[4]['count'] - 4 * $kolvo_orders_on_week[5]['count'] + 1 * $kolvo_orders_on_week[6]['count'])/42,2);
					if($i==count($kolvo_orders_on_week)-3){
						$d = round((1 * $kolvo_orders_on_week[$i+2]['count'] - 4 * $kolvo_orders_on_week[$i+1]['count'] + 2 * $kolvo_orders_on_week[$i]['count'] + 12 * $kolvo_orders_on_week[$i-1]['count'] + 19 * $kolvo_orders_on_week[$i-2]['count'] + 16 * $kolvo_orders_on_week[$i-3]['count'] - 4 * $kolvo_orders_on_week[$i-4]['count'])/42,2);
					}
					if($i==count($kolvo_orders_on_week)-2){
						$d = round((4 * $kolvo_orders_on_week[$i+1]['count'] - 7 * $kolvo_orders_on_week[$i]['count'] - 4 * $kolvo_orders_on_week[$i-1]['count'] + 6 * $kolvo_orders_on_week[$i-2]['count'] + 16 * $kolvo_orders_on_week[$i-3]['count'] + 19 * $kolvo_orders_on_week[$i-4]['count'] + 8 * $kolvo_orders_on_week[$i-5]['count'])/42,2);
					}
					if($i==count($kolvo_orders_on_week)-1){
						$d = round((2 * $kolvo_orders_on_week[$i]['count'] + 4 * $kolvo_orders_on_week[$i-1]['count'] + 1 * $kolvo_orders_on_week[$i-2]['count'] - 4 * $kolvo_orders_on_week[$i-3]['count'] - 4 * $kolvo_orders_on_week[$i-4]['count'] + 4 * $kolvo_orders_on_week[$i-5]['count'] + 39 * $kolvo_orders_on_week[$i-6]['count'])/42,2);
					}
				}
				else
					$d = round(($kolvo_orders_on_week[$i-3]['count']+$kolvo_orders_on_week[$i-2]['count']+$kolvo_orders_on_week[$i-1]['count']+$kolvo_orders_on_week[$i]['count']+$kolvo_orders_on_week[$i+1]['count']+$kolvo_orders_on_week[$i+2]['count']+$kolvo_orders_on_week[$i+3]['count'])/7,2);
	

				if($i<2 || $i>count($kolvo_orders_on_week)-3){
				if($i==0)
					$e = round((1/35)*($kolvo_orders_on_week[0]['count']*(31) + $kolvo_orders_on_week[1]['count'] * 9 + $kolvo_orders_on_week[2]['count'] * (-3) + $kolvo_orders_on_week[3]['count'] * (-5) + $kolvo_orders_on_week[4]['count']*(3)),2);
				if($i==1)
					$e = round((1/35)*($kolvo_orders_on_week[0]['count']*(9) + $kolvo_orders_on_week[1]['count']*13 + $kolvo_orders_on_week[2]['count']*12 + $kolvo_orders_on_week[3]['count']*6 + $kolvo_orders_on_week[4]['count']*(-5)),2);
				if($i==count($kolvo_orders_on_week)-2)
					$e = round((1/35)*($kolvo_orders_on_week[$i+1]['count']*(-5) + $kolvo_orders_on_week[$i]['count']* 6 + $kolvo_orders_on_week[$i-1]['count']* 12 + $kolvo_orders_on_week[$i-2]['count']* 13 + $kolvo_orders_on_week[$i-3]['count']*(-9)),2);
				if($i==count($kolvo_orders_on_week)-1)
					$e = round((1/35)*($kolvo_orders_on_week[$i]['count']*(3) + $kolvo_orders_on_week[$i-1]['count']* (-5) + $kolvo_orders_on_week[$i-2]['count']* (-3) + $kolvo_orders_on_week[$i-3]['count']* 9 + $kolvo_orders_on_week[$i-4]['count']*(31)),2);
				
				}else
					$e = round((1/35)*($kolvo_orders_on_week[$i-2]['count']*(-3) + $kolvo_orders_on_week[$i-1]['count']*12 +$kolvo_orders_on_week[$i]['count']*17 + $kolvo_orders_on_week[$i+1]['count']*12 + $kolvo_orders_on_week[$i+2]['count']*(-3)),2);
				
				array_push($order_on_week , [$a,$b,$c,$d,$e]);
			
			}

			$a = "Прогноз";
			$b = null;
			$c =  round(1/3 * ($order_on_week[count($order_on_week)-1][2] + $order_on_week[count($order_on_week)-2][2] + $order_on_week[count($order_on_week)-3][2]),2);
			$d =  round(1/7 * ($order_on_week[count($order_on_week)-1][3] + $order_on_week[count($order_on_week)-2][3] + $order_on_week[count($order_on_week)-3][3] + $order_on_week[count($order_on_week)-4][3] + $order_on_week[count($order_on_week)-5][3] + $order_on_week[count($order_on_week)-6][3] + $order_on_week[count($order_on_week)-7][3]),2);
			$e =  round(1/5 * ($order_on_week[count($order_on_week)-1][4] + $order_on_week[count($order_on_week)-2][4] + $order_on_week[count($order_on_week)-3][4] + $order_on_week[count($order_on_week)-4][4] + $order_on_week[count($order_on_week)-5][4]),2);
			array_push($order_on_week , [$a,$b,$c,$d,$e]);

			$order_on_week_v2 = $order_on_week;
			array_pop($order_on_week_v2);
			
			$order_on_week_v1 = [];
			$year =  $kolvo_orders_on_week[0]['year'];
			$year++;
			array_push($order_on_week_v1,[$kolvo_orders_on_week[0]['week'] ." ". $kolvo_orders_on_week[0]['year'],$kolvo_orders_on_week[0]['count'],null,null,null]);
			for($i=1;$i<count($kolvo_orders_on_week);$i++){

				if( $kolvo_orders_on_week[$i]['year']==$year){
					$a = $kolvo_orders_on_week[$i]['week'] ." ". $kolvo_orders_on_week[$i]['year'];
					$year++;
				}else{
					$a = $kolvo_orders_on_week[$i]['week'];
				}
				
				
				$b = $kolvo_orders_on_week[$i]['count'];

				if($i==count($kolvo_orders_on_week)-1)
					$c = null;
				else
					$c = round(($kolvo_orders_on_week[$i+1]['count']+$kolvo_orders_on_week[$i]['count']+$kolvo_orders_on_week[$i-1]['count'])/3,2);
				

				if($i<3 || $i>count($kolvo_orders_on_week)-4)
					$d = null;
				else
					$d = round(($kolvo_orders_on_week[$i-3]['count']+$kolvo_orders_on_week[$i-2]['count']+$kolvo_orders_on_week[$i-1]['count']+$kolvo_orders_on_week[$i]['count']+$kolvo_orders_on_week[$i+1]['count']+$kolvo_orders_on_week[$i+2]['count']+$kolvo_orders_on_week[$i+3]['count'])/7,2);
	

				if($i<2 || $i>count($kolvo_orders_on_week)-3)
					$e = null;
				else
					$e = round((1/35)*($kolvo_orders_on_week[$i-2]['count']*(-3) + $kolvo_orders_on_week[$i-1]['count']*12 + $kolvo_orders_on_week[$i]['count']*17 + $kolvo_orders_on_week[$i+1]['count']*12 + $kolvo_orders_on_week[$i+2]['count']*(-3)),2);
				
				array_push($order_on_week_v1 , [$a,$b,$c,$d,$e]);
			
			}
			?>

			var order_week = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Заказы', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($order_on_week as $key => $dat) {

					$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					echo($st);
				
					
				}	?>
			]);
			var order_week_v1 = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Заказы', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($order_on_week_v1 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					echo($st);
				
				}				?>
			]);
			var order_week_v2 = google.visualization.arrayToDataTable([
				[ 'Неделя', 'Заказы', 'l=3', 'l=7', 'l=5'],
				<?php 
				foreach ($order_on_week_v2 as $key => $dat) {
					if($dat[4]==null){
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , null ],";
					}else{
						$st = "[ '$dat[0]' , ". $dat[1] ." , ". $dat[2] ." , ". $dat[3] ." , ". $dat[4]  ."],";
					}
					echo($st);
				
				}				?>
			]);
			var option_order_week = {
				title: 'Расчет скользящих средних "Заказов по неделям"',
				// hAxis: {title: 'Месяцы'},
				curveType: 'function',
				'width': 1550,
				'height': 800,
				legend: { position: 'bottom' },
				backgroundColor: {
				
					'fill': ''
				}
			};

			var options = {
				'title': 'График выручки по месяцам за <?php echo($_SESSION['mindate']);?>  -  <?php echo($_SESSION['maxdate']);?>',
				 'curveType': 'function',
				'width': 650,
				'height': 500,
				'backgroundColor': {
					// 'strokeWidth': 5,
					'fill': ''
				}
			};

			var options2 = {
				'title': 'График регистрации пользователей по неделям',
				'hAxis':{title: 'Недели'},
				'vAxis':{title: 'Количество зарег пользователей'},
				'width': 1000,
				'height': 700,
			
				// 'slices': {
				// 	0: { offset: 0.2 }
				// },
				'legend': 'left',
				'backgroundColor': {
					// 'strokeWidth': 5,
					'fill': ''
				}
				// colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
			};

			var options3 = {
				'title': 'График заказов по неделям',
				'curveType': 'function',
				'hAxis':{title: 'Недели'},
				'vAxis':{title: 'Количество заказов'},
				'width': 1000,
				'height': 700,
		
				'is3D': true,
				'legend': 'left',
				'pieStartAngle': 20,
				'backgroundColor': {
					// 'strokeWidth': 5,
					'fill': ''
				}
				// colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
			};

			var options4 = {
				'title': 'График выручки по месяцам за <?php echo($_SESSION['mindate']);?>  -  <?php echo($_SESSION['maxdate']);?>',
				'curveType': 'function',
				'width': 1000,
				'height': 700,
			};

			//  unset($_SESSION['mindate']); unset($_SESSION['maxdate']); ?>
			var chart = new google.visualization.PieChart(document.getElementById('chart_div_pie'));
			chart.draw(data, options);

			var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div_col'));
			chart2.draw(data, options);

			// var chart3 = new google.visualization.AreaChart(document.getElementById('chart_div_area'));
			// chart3.draw(data2, options2);

			 var chart4 = new google.visualization.LineChart(document.getElementById('chart_div_area2'));
			chart4.draw(data, options);

			// var chart5 = new google.visualization.ComboChart(document.getElementById('chart_div_line'));
			// chart5.draw(data, options);
			
			var chart_monthly_rev = new google.visualization.LineChart(document.getElementById('chart_div_monthly_rev'));
  			chart_monthly_rev.draw(monthly_rev, options_monthly_rev);
			var chart_monthly_rev_v1 = new google.visualization.LineChart(document.getElementById('chart_div_monthly_rev_v1'));
  			chart_monthly_rev_v1.draw(monthly_rev_v1, options_monthly_rev);
			var chart_monthly_rev_v2 = new google.visualization.LineChart(document.getElementById('chart_div_monthly_rev_v2'));
  			chart_monthly_rev_v2.draw(monthly_rev_v2, options_monthly_rev);


			var chart_reg_user = new google.visualization.LineChart(document.getElementById('chart_div_reg_users'));
  			chart_reg_user.draw(reg_user, option_reg_user);

			var chart_reg_user_v1 = new google.visualization.LineChart(document.getElementById('chart_div_reg_users_v1'));
  			chart_reg_user_v1.draw(reg_user_v1, option_reg_user);

			var chart_reg_user_v2 = new google.visualization.LineChart(document.getElementById('chart_div_reg_users_v2'));
  			chart_reg_user_v2.draw(reg_user_v2, option_reg_user);


			var chart_order_week = new google.visualization.LineChart(document.getElementById('chart_div_order_week'));
  			chart_order_week.draw(order_week, option_order_week);

			var chart_order_week_v1 = new google.visualization.LineChart(document.getElementById('chart_div_order_week_v1'));
  			chart_order_week_v1.draw(order_week_v1, option_order_week);

			var chart_order_week_v2 = new google.visualization.LineChart(document.getElementById('chart_div_order_week_v2'));
  			chart_order_week_v2.draw(order_week_v2, option_order_week);
		
			

		}
	</script>
	<style>
		.wrap{
			position: relative;
			overflow-x: auto;
			overflow-y: auto;
			width: 100%;
			max-width: 100%;
			margin-bottom: 20px;
		}
		table{
			width: 100%;
	
			
		}
		table, th, td {
			border: 1px solid;

		}
		th,td{
			text-align: center;

		}
		th,td{
			padding: 5px 7px;
		}

		th{
			font-weight: 900;
			font-size: 25px;
			width: 55px;
			
		}
		td{
			font-size: 20px;
		
		}
	</style>

</head>

<body>
	

<header class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<h1>
						<a href="/">My Course</a>
					</h1>
				</div>
				<nav class="col-8">
					<ul>
						<li>
							
							<a	a href="#">
								<i class="fa-solid fa-user"></i>
								<?php echo $_SESSION['login']; ?>
							</a>
						</li>
						<li>
							<a href="../../logout.php">Выход</a>
						</li>
						
								
							
				
						</li>
					</ul>
				</nav>
			</div>
		</div>
</header>

	<section class="main-content">
		<div class="container">

					<?php if($sum_order):?>			
						<div class="row">
							<div class="col-6" ><div  id="chart_div_pie" ></div></div>
						
							<div class="col-6"><div  id="chart_div_col" ></div></div>

							<div class="col-6"><div  id="chart_div_area2" ></div></div>
						</div>
						
					<?php endif;?>


					<div class="d-flex">
						<div class="wrap">

						
							<table>
								<tbody>
									<tr>
										<th>Месяц</th>
										<?php foreach($sum_order as $order):?>
											<th style="width: 100px;"><?=$month[$order['month']]?>, <?=$order['year']?></th>

										<?php endforeach;?>	
									</tr>
									<tr>
										<th>Выручка, $</th>
										<?php foreach($sum_order as $sorder):?>
									
											<th> <?=$sorder['sum'] ?> $</th>

										<?php endforeach;?>	
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
						<h1 style="padding: 20px;">Статистические показатели динамики</h1>
					<div style="height: 800px;" class="d-flex">
						<div class="wrap">

						
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Абсолютный прирост, $</th>
										<th colspan="2">Темп роста, %</th>
										<th colspan="2">Темп прироста, %</th>

									</tr>
									<tr>
										<th>Цепной</th>
										<th>Базисный</th>
										<th>Цепной</th>
										<th>Базисный</th>
										<th>Цепной</th>
										<th>Базисный</th>
									</tr>
									<tr>
										<td><?=$month[$sum_order[0]['month']]?>, <?=$sum_order[0]['year']?></td>
										<td><?=$sum_order[0]['sum']?></td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>

									</tr>
									<?php for($i=1;$i<count($sum_order);$i++):?>
										<tr>
											<td><?=$month[$sum_order[$i]['month']]?>, <?=$sum_order[$i]['year']?></td>
											<td><?=$sum_order[$i]['sum']?></td>
											<td><?=$sum_order[$i]['sum']?> - <?=$sum_order[$i-1]['sum']?> = <?=$sum_order[$i]['sum']-$sum_order[$i-1]['sum']?></td>
											<td><?=$sum_order[$i]['sum']?> - <?=$sum_order[0]['sum']?> = <?=$sum_order[$i]['sum'] - $sum_order[0]['sum']?></td>
											<?php $temp_rosta_cepnoy = round($sum_order[$i]['sum']/$sum_order[$i-1]['sum']*100,2);?>
											<td> (<?=$sum_order[$i]['sum']?>/<?=$sum_order[$i-1]['sum']?>) * 100 = <?=$temp_rosta_cepnoy?></td>
											<?php $temp_rosta_basis = round($sum_order[$i]['sum']/$sum_order[0]['sum']*100,2);?>
											<td> (<?=$sum_order[$i]['sum']?>/<?=$sum_order[0]['sum']?>) * 100 = <?=$temp_rosta_basis?></td>
											<td><?=$temp_rosta_cepnoy?> - 100 = <?=$temp_rosta_cepnoy-100?></td>
											<td> <?=$temp_rosta_basis?> - 100 = <?=$temp_rosta_basis-100?></td>
										</tr>
									<?php endfor;?>
									
								</tbody>
							</table>
						</div>
					</div>
					


				
				



				<div class="Reg_users_on_week">
					<h1 style="padding: 20px;">Расчет скользящих средних "Регистрации пользователей по неделям"</h1>
					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
									</tr>
								
									<?php for($i=0; $i < count($reg_users_on_week)-1; $i++):?>
										<tr>
											<td><?=$reg_users_on_week[$i][0]?></td>
											<td><?=$reg_users_on_week[$i][1]?></td>

											<?php if($i==0 || $i==count($reg_users_on_week)-2):?>
												<td></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][2]?></td>
											<?php endif;?>

											<?php if($i==0 || $i==1 || $i==2 || $i==count($reg_users_on_week)-2 || $i==count($reg_users_on_week)-3 || $i==count($reg_users_on_week)-4):?>
												<td></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][3]?></td>
											<?php endif;?>


											<?php if($i==0 || $i==1 ||  $i==count($reg_users_on_week)-2 || $i==count($reg_users_on_week)-3):?>
												<td></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][4]?></td>
											<?php endif;?>

										</tr>
									<?php endfor;?>
								</tbody>
							</table>
					</div>

					<div  id="chart_div_reg_users_v1" ></div>

					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
									</tr>
								
									<?php for($i=0; $i < count($reg_users_on_week)-1; $i++):?>
										<tr>
											<td><?=$reg_users_on_week[$i][0]?></td>
											<td><?=$reg_users_on_week[$i][1]?></td>

											<?php if($i==0 || $i==count($reg_users_on_week)-2):?>
												<td><?=$reg_users_on_week[$i][2]?></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][2]?></td>
											<?php endif;?>

											<?php if($i==0 || $i==1 || $i==2 || $i==count($reg_users_on_week)-2 || $i==count($reg_users_on_week)-3 || $i==count($reg_users_on_week)-4):?>
												<td><?=$reg_users_on_week[$i][3]?></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][3]?></td>
											<?php endif;?>


											<?php if($i==0 || $i==1 ||  $i==count($reg_users_on_week)-2 || $i==count($reg_users_on_week)-3):?>
												<td><?=$reg_users_on_week[$i][4]?></td>
											<?php else:?>
												<td><?=$reg_users_on_week[$i][4]?></td>
											<?php endif;?>

										</tr>
									<?php endfor;?>
								</tbody>
							</table>
					</div>
					<div  id="chart_div_reg_users_v2" ></div>
			
					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
									</tr>
									<?php foreach($reg_users_on_week as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
					</div>

					<!-- <div  id="chart_div_area" ></div> -->
					<!-- <h3>На графике приведена динамика объема регистрации пользователей на сайте. Отчетливо 
					прослеживаются резкие скачки графика в некоторые недели месяца. Регистрация пользователей
					возрастает с наступлением учебы после 1 сентября и во время каникул.
					</h3> -->

					<div  id="chart_div_reg_users" ></div>
				</div>
				



				<div class="Order_on_week">
					<h1 style="padding: 20px;">Расчет скользящих средних "Заказы по неделям"</h1>

					<div style="height: 800px;"  class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
										
									</tr>
									
								
									<?php foreach($order_on_week_v1  as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									
									<?php endforeach;?>

									
									
								</tbody>
							</table>
					</div>
					<div  id="chart_div_order_week_v1" ></div>



					<div style="height: 800px;"  class="wrap">
						<table>
							<tbody>
								<tr>
									<th rowspan="2">t   </th>
									<th rowspan="2">y(t), $</th>
									<th colspan="2">Скользящие средние</th>
									<th rowspan="2">Взвешенная скользящая средняя l=5</th>
								</tr>
								<tr>
									<th>l=3</th>
									<th>l=7</th>
									
								</tr>
								
							
								<?php foreach($order_on_week_v2  as $val):?>
									<tr>
										<td><?=$val[0]?></td>
										<td><?=$val[1]?></td>
										<td><?=$val[2]?></td>
										<td><?=$val[3]?></td>
										<td><?=$val[4]?></td>
									</tr>
								
								<?php endforeach;?>

								
								
							</tbody>
						</table>
					</div>
					<div  id="chart_div_order_week_v2" ></div>




					<!-- фулл -->
					<div style="height: 800px;"  class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
										
									</tr>
									
								
									<?php foreach($order_on_week  as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									
									<?php endforeach;?>

									
									
								</tbody>
							</table>
					</div>
					<div  id="chart_div_order_week" ></div>

					<!-- <div  id="chart_div_area2" ></div> -->
						<!-- <h3>На графике приведена динамика объема заказов на сайте.
						Мы видим прослеживаемые скачки графика в некоторые недели месяца.Заказы пользователей
						возрастают с наступлением учебы после 1 сентября и во время каникул, а также после нового года 
						из-за повышенной мотивации к учебе и саморазвитию.
					</h3> -->
					

				</div>
				
		


				<div class="Monthly_rev">
						
					<h1 style="padding: 20px;">Расчет скользящих средних "Выручка по месяцам"</h1>

					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
										
									</tr>
									
								
									<?php foreach($monthly_revenue_v1 as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									
									<?php endforeach;?>

									
									
								</tbody>
							</table>
					</div>
					<div  id="chart_div_monthly_rev_v1" ></div>

					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
										
									</tr>
									
								
									<?php foreach($monthly_revenue_v2 as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									
									<?php endforeach;?>

									
									
								</tbody>
							</table>
					</div>
					<div  id="chart_div_monthly_rev_v2" ></div>

					<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th rowspan="2">t   </th>
										<th rowspan="2">y(t), $</th>
										<th colspan="2">Скользящие средние</th>
										<th rowspan="2">Взвешенная скользящая средняя l=5</th>
									</tr>
									<tr>
										<th>l=3</th>
										<th>l=7</th>
										
									</tr>
									
								
									<?php foreach($monthly_revenue as $val):?>
										<tr>
											<td><?=$val[0]?></td>
											<td><?=$val[1]?></td>
											<td><?=$val[2]?></td>
											<td><?=$val[3]?></td>
											<td><?=$val[4]?></td>
										</tr>
									
									<?php endforeach;?>

									
									
								</tbody>
							</table>
					</div>

					<div   id="chart_div_line" ></div>
						<!-- <h3>На графике приведена динамика объема выручки на сайте. Отчетливо 
						прослеживаются резкие скачки графика в некоторые месяца. Выручка 
						полностью зависит от заказов поэтому графики более менее одинаковые
					</h3> -->
					<div  id="chart_div_monthly_rev" ></div>

				</div>

				
			

			</div>

		
			
			
						
					
					
		</div>
	</section>


	

	<!-- FOOTER -->
		<?php include '../app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>