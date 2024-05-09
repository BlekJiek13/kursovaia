
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
$abc=[];



for ($i=0; $i <count($sum_order) ; $i++) { 
	$sum_ord[0][$i] = $month[$sum_order[$i]['month']] . ',' . $sum_order[$i]['year'];
	$sum_ord[1][$i] = $sum_order[$i]['sum'];
}

$temp_year = $kolvo_reg_users_on_week[0]['year'];
for ($i=0; $i <count($kolvo_reg_users_on_week) ; $i++) { 
	if($kolvo_reg_users_on_week[$i]['year'] == $temp_year){
		$kolvo_reg[0][$i] = $kolvo_reg_users_on_week[$i]['week'] . ',' . $kolvo_reg_users_on_week[$i]['year'];
		$temp_year++;
	}
	else{
		$kolvo_reg[0][$i] = $kolvo_reg_users_on_week[$i]['week'] ;
	}
	
	$kolvo_reg[1][$i] = $kolvo_reg_users_on_week[$i]['count'];
}


$temp_year_2 = $kolvo_orders_on_week[0]['year'];
for ($i=0; $i <count($kolvo_orders_on_week) ; $i++) { 
	if($kolvo_orders_on_week[$i]['year'] == $temp_year_2){
		$kolvo_ord[0][$i] = $kolvo_orders_on_week[$i]['week'] . ',' . $kolvo_orders_on_week[$i]['year'];
		$temp_year_2++;
	}
	else{
		$kolvo_ord[0][$i] = $kolvo_orders_on_week[$i]['week'] ;
	}
	
	$kolvo_ord[1][$i] = $kolvo_orders_on_week[$i]['count'];
}




function rachet_parametrov($mas){
	$temp = [];
	$position_null=0;
	$start = -ceil((count($mas[0])-1)/2);

	for ($i=0; $i < count($mas[0]); $i++) { 
		$temp[0][$i+1] = $mas[0][$i];
		$temp[1][$i+1] = $mas[1][$i];
		if($start==0){
			$position_null = $i+1;
		}
		$temp[2][$i+1] = $start;
		$start++;
		$temp[3][$i+1] = $temp[2][$i+1] * $temp[1][$i+1];
		$temp[4][$i+1] = pow($temp[2][$i+1],2);
		$temp[5][$i+1] = $temp[4][$i+1] * $temp[1][$i+1];
		$temp[6][$i+1] = pow($temp[2][$i+1],4);
		$temp[7][$i+1] = round(log($temp[1][$i+1]),4);
		$temp[8][$i+1] = $temp[7][$i+1] * $temp[2][$i+1];
	}

	for ($i=1; $i < 9; $i++) { 
		if($i!=2){
			$sum=0;
			for ($j=1; $j <count($temp[0])+1 ; $j++) { 
				$sum+= $temp[$i][$j];	
			}
			$temp[$i][count($temp[0])+1] = $sum;
			$sum=0;
		}
	}
	// линейная модель
	$a0 = round( $temp[1][count($temp[0])+1]/count($temp[0]),3);
	$a1 = round( $temp[3][count($temp[0])+1] / $temp[4][count($temp[0])+1],3);
	$temp[9][1] = $a0 . ' + (' . $a1 . ')t';
	$temp[9][2] = $a0;
	$temp[9][3] = $a1;
	//прогноз
	$temp[9][4] = $a0 + $a1*$position_null;
	$temp[9][5] = $position_null;

	//параболическая модель
	$a2 = round(((count($temp[0]) * $temp[5][count($temp[0])+1]) - ($temp[4][count($temp[0])+1] * $temp[1][count($temp[0])+1])) / (count($temp[0]) * $temp[6][count($temp[0])+1] - pow($temp[4][count($temp[0])+1],2)),3);                             
	$a0 = round($a0 - ($temp[4][count($temp[0])+1]/count($temp[0]) * $a2),3);
	$temp[10][1] = $a0 . ' + ('. $a1.')t + ('. $a2.')t^2';
	$temp[10][2] = $a0;
	$temp[10][3] = $a2;
	//прогноз
	$temp[10][4] = round($a0 + $a1*$position_null + $a2 * pow($position_null,2),3);

	//показательная модель
	$temp[11][1] = round($temp[7][count($temp[0])+1] / count($temp[0]),4);
	$temp[11][2] = round($temp[8][count($temp[0])+1] / $temp[4][count($temp[0])+1],4);
	$temp[11][3] = round(exp($temp[11][1]),3);
	$temp[11][4] = round(exp($temp[11][2]),2);
	$temp[11][5] = $temp[11][3] .' * '.$temp[11][4] . '^t';
	$temp[11][6] = round($temp[11][3] * pow($temp[11][4],$position_null),3);

	return $temp;
}


function parametr_on_grafic($mas){
	$temp = [];
	for ($i=0; $i < count($mas[0]) ; $i++) { 
		$temp[0][$i] = $mas[0][$i+1];
		$temp[1][$i] = $mas[1][$i+1];
		$temp[2][$i] = $mas[2][$i+1];
		$temp['Line'][$i] = $mas[9][2] + $mas[9][3]* $temp[2][$i];
		$temp['Parabol'][$i] = $mas[10][2] + $mas[9][3]* $temp[2][$i] + $mas[10][3] * pow($temp[2][$i],2);
		$temp['Pokazat'][$i] = round($mas[11][3] * pow($mas[11][4], $temp[2][$i]),3);

	}
	return $temp;
}
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
	}elseif ($v<floor($a) || $n>5) {
		$temp .= '<h3>[1/3*(2*'.$count.'-1)-1.96* sqrt((16*'.$count.'-29)/90)] =' . 
		floor($a) . '</h3>
		<h3>Проверка выполнения условий 3.5 показывает, что одно из неравенств не выполняется.';
		if($n<floor($a)){
			$temp .= 'А именно V(' . $count . ' ) =' . $v . ' > ' . floor($a) . ' (1 неравенство)';
		}else{
			$temp .= 'А именно τmax('. $count .') = '. $n  .  ' <  τ0(' . $count . ') = 5.  (2-ое неравенство)';
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
				<h1 style="color: red; text-align:center"><b>Выручка по месяцам</b></h1>
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
									<th>Выручка, y(t)</th>
									<?php foreach($sum_order as $sorder):?>
								
										<th> <?=$sorder['sum'] ?> $</th>

									<?php endforeach;?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				<h2 style=" max-width: 100%">Расчет параметров линейной и параболистической моделей</h2>
				<div style="height: 700px;"  class="wrap">
				<!-- Расчет параметров -->
					<table>
						<tbody>
							<tr>
								<th >Месяц</th>
								<th>y(t), $</th>
								<th >t</th>
								<th >y(t)t</th>
								<th >t^2</th>
								<th >y(t)t^2</th>
								<th >t^4</th>
								<th >ln(y(t))</th>
								<th >ln(y(t))t</th>
							</tr>
							<?php $revenue= rachet_parametrov($sum_ord);?>
							<?php for($i=1;$i<count($revenue[0])+2;$i++):?>
								<tr>
									<?php if($i==count($revenue[0])+1):?>
										<td>Сумма</td>
									<?php else:?>
										<td><?=$revenue[0][$i]?></td>
									<?php endif;?>
								
									<td><?=$revenue[1][$i]?></td>
									<td><?=$revenue[2][$i]?></td>
									<td><?=$revenue[3][$i]?></td>
									<td><?=$revenue[4][$i]?></td>
									<td><?=$revenue[5][$i]?></td>
									<td><?=$revenue[6][$i]?></td>
									<td><?=$revenue[7][$i]?></td>
									<td><?=$revenue[8][$i]?></td>
								</tr>
							
							<?php endfor;?>

							
							
						</tbody>
					</table>
				</div>

				<p style="font-size: 30px;">Линейная модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t</p>
				<p style="font-size: 20px;">y = <?=$revenue[9][1]?></p>
				<?php $a = parametr_on_grafic($revenue);
				
					$difference = [];
					for ($i=0; $i < count($a[0]); $i++) { 
						$difference[0][$i] = $revenue[1][$i] - $a['Line'][$i];
						$difference[1][$i] = $revenue[1][$i] - $a['Parabol'][$i];
						$difference[2][$i] = $revenue[1][$i] - $a['Pokazat'][$i];
					}
					
				?>
					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Месяц</th>
										<?php for($i=0;$i<count($a[0]);$i++):?>
											
											<th style="width: 100px;"><?=$a[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Выручка, $</th>
										<?php for($i=0;$i<count($difference[0]);$i++):?>
									
											<th> <?=$difference[0][$i] ?> $</th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<th style="width: 100px;"><?=$a[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<?php if($difference[0][$i]<$difference[0][$i+1]){
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
		
				<?=analyz_gipotez($gipot,count($a[0]));?>

				<p style="font-size: 30px;">Параболическая модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t + a2*t^2</p>
				<p style="font-size: 20px;">y = <?=$revenue[10][1]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Месяц</th>
										<?php for($i=0;$i<count($a[0]);$i++):?>
											
											<th style="width: 100px;"><?=$a[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Выручка, $</th>
										<?php for($i=0;$i<count($difference[0]);$i++):?>
									
											<th> <?=$difference[1][$i] ?> $</th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<th style="width: 100px;"><?=$a[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<?php if($difference[1][$i]<$difference[1][$i+1]){
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
			
				<?=analyz_gipotez($gipot,count($a[0]));?>


				<p style="font-size: 30px;">Показательная модель:</p>
				<p style="font-size: 20px;">y = a*b^t</p>
				<p style="font-size: 20px;">y = <?=$revenue[11][5]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Месяц</th>
										<?php for($i=0;$i<count($a[0]);$i++):?>
											
											<th style="width: 100px;"><?=$a[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Выручка, $</th>
										<?php for($i=0;$i<count($difference[0]);$i++):?>
									
											<th> <?=$difference[2][$i] ?> $</th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<th style="width: 100px;"><?=$a[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($difference[0])-1;$i++):?>
											<?php if($difference[2][$i]<$difference[2][$i+1]){
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

				<?=analyz_gipotez($gipot,count($a[0]));?>


			
				
				
				<div class="col-6"><div  id="chart_div_revenue" ></div></div>
		

			
				
			</div>


			<div style="margin-top:50px ;" class="Регистрация пользователей по неделям">
				<h1 style="color: red; text-align:center"><b>Регистрация пользователей по неделям </b></h1>
					<div class="d-flex">
					<div class="wrap">
						<table>
							<tbody>
								<tr>
									<th>Неделя</th>
									<?php for($i=0;$i<count($kolvo_reg[0]);$i++):?>
										
										<th style="width: 100px;"><?=$kolvo_reg[0][$i]?></th>

									<?php endfor;?>	
								</tr>
								<tr>
									<th>Человек, y(t)</th>
									<?php for($i=0;$i<count($kolvo_reg[0]);$i++):?>

										<th> <?=$kolvo_reg[1][$i]?></th>

									<?php endfor;?>	
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				<h2 style=" max-width: 100%">Расчет параметров линейной и параболистической моделей</h2>
				<div class="d-flex">
					<div class="wrap">
						<!-- Расчет параметров -->
						<table>
							<tbody>
								<tr>
									<th >Неделя</th>
									<th>y(t), чел</th>
									<th >t</th>
									<th >y(t)t</th>
									<th >t^2</th>
									<th >y(t)t^2</th>
									<th >t^4</th>
									<th >ln(y(t))</th>
									<th >ln(y(t))t</th>
								</tr>
								
								
								<?php $reg_user= rachet_parametrov($kolvo_reg);?>
								<?php for($i=1;$i<count($reg_user[0])+2;$i++):?>
									<tr>
										<?php if($i==count($reg_user[0])+1):?>
											<td>Сумма</td>
										<?php else:?>
											<td><?=$reg_user[0][$i]?></td>
										<?php endif;?>
									
										<td><?=$reg_user[1][$i]?></td>
										<td><?=$reg_user[2][$i]?></td>
										<td><?=$reg_user[3][$i]?></td>
										<td><?=$reg_user[4][$i]?></td>
										<td><?=$reg_user[5][$i]?></td>
										<td><?=$reg_user[6][$i]?></td>
										<td><?=$reg_user[7][$i]?></td>
										<td><?=$reg_user[8][$i]?></td>
										
									</tr>
								
								<?php endfor;?>

								
								
							</tbody>
						</table>
					</div>
				</div>

				<?php $b = parametr_on_grafic($reg_user);
			
					$diff = [];
					for ($i=0; $i < count($b[0]); $i++) { 
						$diff[0][$i] = $reg_user[1][$i] - $b['Line'][$i];
						$diff[1][$i] = $reg_user[1][$i] - $b['Parabol'][$i];
						$diff[2][$i] = $reg_user[1][$i] - $b['Pokazat'][$i];
						
					}	?>


				<p style="font-size: 30px;">Линейная модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t</p>
				<p style="font-size: 20px;">y = <?=$reg_user[9][1]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($b[0]);$i++):?>
											
											<th style="width: 100px;"><?=$b[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во польз.</th>
										<?php for($i=0;$i<count($diff[0]);$i++):?>
									
											<th> <?=$diff[0][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<th style="width: 100px;"><?=$b[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<?php if($diff[0][$i]<$diff[0][$i+1]){
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

				<?=analyz_gipotez($gipot,count($b[0]));?>



				<p style="font-size: 30px;">Параболическая модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t + a2*t^2</p>
				<p style="font-size: 20px;">y = <?=$reg_user[10][1]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($b[0]);$i++):?>
											
											<th style="width: 100px;"><?=$b[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во польз.</th>
										<?php for($i=0;$i<count($diff[0]);$i++):?>
									
											<th> <?=$diff[1][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<th style="width: 100px;"><?=$b[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<?php if($diff[1][$i]<$diff[1][$i+1]){
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
			
				<?=analyz_gipotez($gipot,count($b[0]));?>

				<p style="font-size: 30px;">Показательная модель:</p>
				<p style="font-size: 20px;">y = a*b^t</p>
				<p style="font-size: 20px;">y = <?=$reg_user[11][5]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($b[0]);$i++):?>
											
											<th style="width: 100px;"><?=$b[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во польз.</th>
										<?php for($i=0;$i<count($diff[2]);$i++):?>
									
											<th> <?=$diff[2][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[2])-1;$i++):?>
											<th style="width: 100px;"><?=$b[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[2])-1;$i++):?>
											<?php if($diff[2][$i]<$diff[2][$i+1]){
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

				<?=analyz_gipotez($gipot,count($b[0]));?>

				

				

			
				<div class="col-6"><div  id="chart_div_reg_user" ></div></div>

				

			


				
			</div>
			
			<div style="margin-top:50px ;" class="Заказы по неделям">
				<h1 style="color: red; text-align:center"><b>Заказы по неделям </b></h1>

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

				<h2 style=" max-width: 100%">Расчет параметров линейной и параболистической моделей</h2>
				<div class="d-flex">
					<div class="wrap">
						<!-- Расчет параметров -->
						<table>
							<tbody>
								<tr>
									<th >Неделя</th>
									<th>y(t), заказы</th>
									<th >t</th>
									<th >y(t)t</th>
									<th >t^2</th>
									<th >y(t)t^2</th>
									<th >t^4</th>
									<th >ln(y(t))</th>
									<th >ln(y(t))t</th>
								</tr>
								
								
								<?php $reg_order= rachet_parametrov($kolvo_ord);?>
								<?php for($i=1;$i<count($reg_order[0])+2;$i++):?>
									<tr>
										<?php if($i==count($reg_order[0])+1):?>
											<td>Сумма</td>
										<?php else:?>
											<td><?=$reg_order[0][$i]?></td>
										<?php endif;?>
									
										<td><?=$reg_order[1][$i]?></td>
										<td><?=$reg_order[2][$i]?></td>
										<td><?=$reg_order[3][$i]?></td>
										<td><?=$reg_order[4][$i]?></td>
										<td><?=$reg_order[5][$i]?></td>
										<td><?=$reg_order[6][$i]?></td>
										<td><?=$reg_order[7][$i]?></td>
										<td><?=$reg_order[8][$i]?></td>
										
									</tr>
								
								<?php endfor;?>

								
								
							</tbody>
						</table>
					</div>
				</div>

				<?php $c = parametr_on_grafic($reg_order);

					$diff = [];
					for ($i=0; $i < count($c[0]); $i++) { 
						$diff[0][$i] = $reg_order[1][$i] - $с['Line'][$i];
						$diff[1][$i] = $reg_order[1][$i] - $с['Parabol'][$i];
						$diff[2][$i] = $reg_order[1][$i] - $с['Pokazat'][$i];
						
					}
					?>



				<p style="font-size: 30px;">Линейная модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t</p>
				<p style="font-size: 20px;">y = <?=$reg_order[9][1]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($c[0]);$i++):?>
											
											<th style="width: 100px;"><?=$c[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во заказов</th>
										<?php for($i=0;$i<count($diff[0]);$i++):?>
									
											<th> <?=$diff[0][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<th style="width: 100px;"><?=$c[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<?php if($diff[0][$i]<$diff[0][$i+1]){
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

				<?=analyz_gipotez($gipot,count($c[0]));?>



				<p style="font-size: 30px;">Параболическая модель:</p>
				<p style="font-size: 20px;">y = a0 + a1*t + a2*t^2</p>
				<p style="font-size: 20px;">y = <?=$reg_order[10][1]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($c[0]);$i++):?>
											
											<th style="width: 100px;"><?=$c[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во заказов</th>
										<?php for($i=0;$i<count($diff[0]);$i++):?>
									
											<th> <?=$diff[1][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<th style="width: 100px;"><?=$c[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[0])-1;$i++):?>
											<?php if($diff[1][$i]<$diff[1][$i+1]){
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
			
				<?=analyz_gipotez($gipot,count($c[0]));?>



				<p style="font-size: 30px;">Показательная модель:</p>
				<p style="font-size: 20px;">y = a*b^t</p>
				<p style="font-size: 20px;">y = <?=$reg_order[11][5]?></p>

					<div class="d-flex">
						<div class="wrap">
							<table>
								<tbody>
									<tr>
										<th>Неделя</th>
										<?php for($i=0;$i<count($c[0]);$i++):?>
											
											<th style="width: 100px;"><?=$c[0][$i]?></th>

										<?php endfor;?>	
									</tr>
									<tr>
										<th>Кол-во заказов</th>
										<?php for($i=0;$i<count($diff[2]);$i++):?>
									
											<th> <?=$diff[2][$i] ?></th>

										<?php endfor;?>	
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
										<?php for($i=0;$i<count($diff[2])-1;$i++):?>
											<th style="width: 100px;"><?=$c[0][$i]?></th>
										<?php endfor;?>	
									</tr>
									<tr>
										<th>β</th>
										<?php $gipot=[]; $n=0;  $v=0;?>

										<?php for($i=0;$i<count($diff[2])-1;$i++):?>
											<?php if($diff[2][$i]<$diff[2][$i+1]){
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

				<?=analyz_gipotez($gipot,count($c[0]));?>

			


		

			
				<div class="col-6"><div  id="chart_div_reg_order" ></div></div>

		

			</div>

			

		
			
			
						
					
					
		</div>
	</section>

		
		<script>
			type = "text/javascript" >

			google.charts.load('current', { 'packages': ['corechart'] });
		
			google.charts.setOnLoadCallback(drawChart);

			
			function drawChart() {

				

				var revenue_on_month = google.visualization.arrayToDataTable([
					['Месяц','Фактическая','Линейная','Параболическая','Показательная'],
					<?php
			
					for($i=0;$i<count($a[0]);$i++){
						
						$str = "['".$a[0][$i]."', ". $a[1][$i]." , ".$a['Line'][$i]." , " . $a['Parabol'][$i].",". $a['Pokazat'][$i]. "],";
						//array_push($abc,$str);
						echo $str;
					}

					?>
				]);

				var reg_user = google.visualization.arrayToDataTable([
					['Неделя','Фактическая','Линейная','Параболическая','Показательная'],
					<?php
			
					for($i=0;$i<count($b[0]);$i++){
					
						$str = "['".$b[0][$i]."', ". $b[1][$i]." , ".$b['Line'][$i]." , " . $b['Parabol'][$i].",". $b['Pokazat'][$i]. "],";
					//	array_push($abc,$str);
						echo $str;
					}

					?>
				]);

				var reg_order = google.visualization.arrayToDataTable([
					['Неделя','Фактическая','Линейная','Параболическая','Показательная'],
					<?php
			
					for($i=0;$i<count($c[0]);$i++){
						
						$str = "['".$c[0][$i]."', ". $c[1][$i]." , ".$c['Line'][$i]." , " . $c['Parabol'][$i].",". $c['Pokazat'][$i]. "],";
						//array_push($abc,$str);
						echo $str;
					}

					?>
				]);


				var options1 = {
					'title': 'График выручки по месяцам',
					'curveType': 'function',
					'width': 950,
					'height': 600,
					'backgroundColor': {
						// 'strokeWidth': 5,
						'fill': ''
					}
				};

				var options2 = {
					'title': 'График регистрации пользователей по неделям',
					'curveType': 'function',
					'width': 950,
					'height': 600,
					'backgroundColor': {
						// 'strokeWidth': 5,
						'fill': ''
					}
				};
				var options3 = {
					'title': 'График регистрации заказов по неделям',
					'curveType': 'function',
					'width': 950,
					'height': 600,
					'backgroundColor': {
						// 'strokeWidth': 5,
						'fill': ''
					}
				};

				

				var chart = new google.visualization.LineChart(document.getElementById('chart_div_revenue'));
				chart.draw(revenue_on_month, options1);

				var chart2 = new google.visualization.LineChart(document.getElementById('chart_div_reg_user'));
				chart2.draw(reg_user, options2);

				var chart3 = new google.visualization.LineChart(document.getElementById('chart_div_reg_order'));
				chart3.draw(reg_order, options3);

				
			}


		</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
		
	
</body>

</html>