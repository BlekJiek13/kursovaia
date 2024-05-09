
<?php
include  '/www/wwwroot/boostrap.local/app/db.php';

$sum_order = sum_orders_on_month('"2022.04.01"','"2023.04.08"');
$kolvo_reg_users_on_week = kolvo_reg_users_on_week('"2022.04.01"','"2023.04.08"');
$kolvo_orders_on_week = kolvo_orders_on_week('"2022.04.01"','"2023.04.08"');


$month = [
	"1" => 'Январь',"2" => 'Февраль',"3" => 'Март',"4" => 'Апрель',
	"5" => 'Май',"6" => 'Июнь',"7" => 'Июль',"8"=>'Август',
	"9"=> 'Сентябрь',"10"=> 'Октябрь',"11"=>'Ноябрь',"12"=>'Декабрь'
	];

$date_m=$month[$sum_order[0]['month']];

$test = [];
$test1 = [];
$test2= [];










function analyz_gipotez($gipotiza,$count){
	$n=0;
	$nMAX=1;
	$v=0;
	for ($i=0; $i < count($gipotiza); $i++) { 

			if($i==0){	
				$n++;
				$v++;
			}else{
				if($gipotiza[$i]==$gipotiza[$i-1]){
					$n++;
					if($n>$nMAX){
							$nMAX = $n;
					}
				}
				else{
					$n=1;
					$v++;
				}
			}
	}
	$n = $nMAX;
	$temp = '';
	$temp .= '
	<h2>Анализ полученной последовательности знаков позволил установить:</h2>
	<h3>Число серий V(' . $count . ' ) =' . $v . '</h3>
	<h3>Протяженность самой длинной серии τmax('. $count .') = '. $n  . '</h3>';
	$temp .= '<h3>τ0(' . $count . ') = 5</h3>
	<div class="d-flex"  style="display: flex; justify-content: center; align-items: center;">
		<img src="../../../assets/image/other/gipot.png" alt="">
	</div>
	<h3>В соответствием с 3.5 делаем проверку. Для этого сначала определим значение для правой части первого неравенства:</h3>';
	
	$a= round(1/3*(2*$count-1)-1.96* sqrt((16*$count-29)/90),1);

	if($v<$a && $n>5){	
		$temp .= '<h3>[1/3*(2*'.$count.'-1)-1.96* sqrt((16*'.$count.'-29)/90)] =' . 
		floor($a) . '</h3>
		<h3>Проверка выполнения условий 3.5 показывает, что оба неравенства не выполняются. Следовательно
			,нулевая гепотеза отвергается, динамика временного ряда характеризуется наличием систематической составляющей.
		</h3>';	
	}elseif ($v<$a || $n>5) {
		$temp .= '<h3>[1/3*(2*'.$count.'-1)-1.96* sqrt((16*'.$count.'-29)/90)] =' . 
		floor($a) . '</h3>
		<h3>Проверка выполнения условий 3.5 показывает, что одно из неравенств не выполняется.';
		if($n<$a){
			$temp .= 'А именно V(' . $count . ' ) =' . $v . ' < ' . $a . ' (1 неравенство)';
		}else{
			$temp .= 'А именно τmax('. $count .') = '. $n  .  ' >  τ0(' . $count . ') = 5.  (2-ое неравенство)';
		}
		$temp .=' Следовательно
			,нулевая гепотеза отвергается, динамика временного ряда характеризуется наличием систематической составляющей.
		</h3>';	
	}else{
		$temp .= '<h3>[1/3*(2*'.$count.'-1)-1.96* sqrt((16*'.$count.'-29)/90)] =' .
		floor($a) . '</h3>
		<h3>Проверка выполнения условий 3.5 показывает, что оба неравенства выполняются. Следовательно
			,нулевая гепотеза подтверждается.
		</h3>';
	}
	echo $temp;
}
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
	<link rel="stylesheet" href="../../../assets/css/style.css">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
	
	<link rel="shortcut icon" type="image/png" href="../../../assets/image/favicon1.png">

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


			var options = {
				'title': 'График выручки по месяцам за <?php echo($_SESSION['mindate']);?>  -  <?php echo($_SESSION['maxdate']);?>',
				// 'curveType': 'function',
				'width': 650,
				'height': 500,
				'backgroundColor': {
					// 'strokeWidth': 5,
					'fill': ''
				}
			};

			var chart = new google.visualization.PieChart(document.getElementById('chart_div_pie'));
			chart.draw(data, options);
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
							<a href="../../../logout.php">Выход</a>
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
						</div>
						
					<?php endif;?>
					<div  class="выручка по месяцам">
						<h1 style="color: red;"><b>Выручка по месяцам</b></h1>
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

						<div class="d-flex">
							<div class="wrap">
								<table>
									<tbody>
										<tr>
											<th>Месяц</th>
											<?php for($i=0;$i<count($sum_order)-1;$i++):?>
												<th style="width: 100px;"><?=$month[$sum_order[$i]['month']]?>, <?=$sum_order[$i]['year']?></th>

											<?php endfor;?>	
										</tr>
										<tr>
											<th>β</th>
											<?php $gipot=[]; $n=0;  $v=0;?>
											<?php for($i=0;$i<count($sum_order)-1;$i++):?>
												<?php if($sum_order[$i]['sum']<$sum_order[$i+1]['sum']){
													$gipot[$i] = '+';
												}else{
													$gipot[$i] = '-';
												}?> 
												<th><?=$gipot[$i];?></th>
											<?php endfor;?>	
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
						<!-- Вывод гипотезы -->
					
						<?=analyz_gipotez($gipot,count($sum_order));?>
						
					</div>


					<div style="margin-top:50px ;" class="Регистрация пользователей по неделям">
						<h1 style="color: red;"><b>Регистрация пользователей по неделям </b></h1>
						<div class="d-flex">
							<div class="wrap">
								<table>
									<tbody>
										<tr>
											<th>Неделя</th>
											<?php $year = $kolvo_reg_users_on_week[0]['year']; ?>
											<?php foreach($kolvo_reg_users_on_week  as $reg_users):?>
												<?php if($reg_users['year']==$year):?>
													<th style="width: 100px;"><?=$reg_users['year']?> , <?=$reg_users['week']?></th>
													<?php $year++;?>
												<?php else:?>
												    <th style="width: 100px;"><?=$reg_users['week']?></th>
												<?php endif;?>

											<?php endforeach;?>	
										</tr>
										<tr>
											<th>Кол-во пользователей</th>
											<?php foreach($kolvo_reg_users_on_week  as $reg_users):?>
										
												<th> <?=$reg_users['count'] ?></th>

											<?php endforeach;?>	
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						<div class="d-flex">
							<div class="wrap">
								<table>
									<tbody>
										<tr>
											<th>Неделя</th>
											<?php $year = $kolvo_reg_users_on_week[0]['year']; ?>
											<?php for($i=0;$i<count($kolvo_reg_users_on_week)-1;$i++):?>
												<?php if($kolvo_reg_users_on_week['year']==$year):?>
													<th style="width: 100px;"><?=$kolvo_reg_users_on_week[$i]['year']?> , <?=$kolvo_reg_users_on_week[$i]['week']?></th>
													<?php $year++;?>
												<?php else:?>
												    <th style="width: 100px;"><?=$kolvo_reg_users_on_week[$i]['week']?></th>
												<?php endif;?>

											<?php endfor;?>	
										</tr>
										<tr>
											<th>β</th>
											<?php $gipot=[]; $n=0;  $v=0;?>
											<?php for($i=0;$i<count($kolvo_reg_users_on_week)-1;$i++):?>
												<?php if($kolvo_reg_users_on_week[$i]['count']<$kolvo_reg_users_on_week[$i+1]['count']){
													$gipot[$i] = '+';
												}else{
													$gipot[$i] = '-';
												}?> 
												<th><?=$gipot[$i];?></th>
											<?php endfor;?>	
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>


						<!-- Анализ гипотезы -->
						<?=analyz_gipotez($gipot,count($kolvo_reg_users_on_week))?>
						
					</div>
					
					<div style="margin-top:50px ;" class="Заказы по неделям">
						<h1 style="color: red;"><b>Заказы по неделям </b></h1>

						<div class="d-flex">
							<div class="wrap">
								<table>
									<tbody>
										<tr>
											<th>Неделя</th>
											<?php $year = $kolvo_orders_on_week[0]['year']; ?>
											<?php foreach($kolvo_orders_on_week  as $order_w):?>
												<?php if($order_w['year']==$year):?>
													<th style="width: 100px;"><?=$order_w['year']?> , <?=$order_w['week']?></th>
													<?php $year++;?>
												<?php else:?>
												    <th style="width: 100px;"><?=$order_w['week']?></th>
												<?php endif;?>

											<?php endforeach;?>	
										</tr>
										<tr>
											<th>Кол-во заказов</th>
											<?php foreach($kolvo_orders_on_week  as $order_w):?>
										
												<th> <?=$order_w['count'] ?></th>

											<?php endforeach;?>	
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						<div class="d-flex">
							<div class="wrap">
								<table>
									<tbody>
										<tr>
											<th>Неделя</th>
											<?php $year = $kolvo_orders_on_week[0]['year']; ?>
											<?php for($i=0;$i<count($kolvo_orders_on_week)-1;$i++):?>
												<?php if($kolvo_orders_on_week[$i]['year']==$year):?>
													<th style="width: 100px;"><?=$kolvo_orders_on_week[$i]['year']?> , <?=$kolvo_orders_on_week[$i]['week']?></th>
													<?php $year++;?>
												<?php else:?>
												    <th style="width: 100px;"><?=$kolvo_orders_on_week[$i]['week']?></th>
												<?php endif;?>

											<?php endfor;?>	
										</tr>
										<tr>
											<th>β</th>
											<?php $gipot=[]; $n=0;  $v=0;?>
											<?php for($i=0;$i<count($kolvo_orders_on_week)-1;$i++):?>
												<?php if($kolvo_orders_on_week[$i]['count']<$kolvo_orders_on_week[$i+1]['count']){
													$gipot[$i] = '+';
												}else{
													$gipot[$i] = '-';
												}?> 
												<th><?=$gipot[$i];?></th>
											<?php endfor;?>	
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>


						<!-- Анализ гипотезы -->
						<?=analyz_gipotez($gipot,count($kolvo_orders_on_week))?>
						
					</div>

			</div>

		
			
			
						
					
					
		</div>
	</section>




	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>