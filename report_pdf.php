<?php 
	
	$mindate = "\"". mb_substr($_POST['date'],6,4). ".". mb_substr($_POST['date'],3,2) .".". mb_substr($_POST['date'],0,2). "\"" ;
	$maxdate = "\"". mb_substr($_POST['date'],19,4). ".". mb_substr($_POST['date'],16,2) .".". mb_substr($_POST['date'],13,2). "\"" ;




	$month = [
	"1" => 'Январь',"2" => 'Февраль',"3" => 'Март',"4" => 'Апрель',
	"5" => 'Май',"6" => 'Июнь',"7" => 'Июль',"8"=>'Август',
	"9"=> 'Сентябрь',"10"=> 'Октябрь',"11"=>'Ноябрь',"12"=>'Декабрь'
	];



	



	


?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
	<style>
		body{
			font-family: DejaVu Sans, sans-serif;
		}

		
		table {
			width: 100%; /* Ширина таблицы */
			background: #ECE9E0; /* Цвет фона таблицы */
			color: #656665; /* Цвет текста */
			border-spacing: 5px; /* Расстояние между ячейками */
			border: 16px solid #ECE9E0;
			border-radius: 20px;
			border-collapse: separate;
		}
		td{
			background: #F5D7BF; /* Цвет фона ячеек */
			padding: 10px; /* Поля вокруг текста */
			text-align: center;
			
		}
		th{
			
			padding: 5px; /* Поля вокруг текста */
			text-align: center;
			
		}
		tr{
			width: 100%;
		}
	

		h1{
			text-align: center;
			color:#656665;
			margin-top: 30px;
		}
		h3{
			color:#656665;
		}
		h2{
			color:#656665;
		}
		caption{
			color:#656665;
			font-size: 35px;
			font-weight:bold;
			
		}


	</style>
</head>
<body>


	<h1>Отчет о выручке MyCourse за <?=$_POST['date']?></h1>
	<table>


<?php 

	$min_year =mb_substr($_POST['date'],6,4);
	$max_year = mb_substr($_POST['date'],19,4);
	$min_month =mb_substr($_POST['date'],3,2);
	$max_month = mb_substr($_POST['date'],16,2);
	$min_month--;
	$min_month++;

	$count_price_itog =0;
	
	for (; $min_year<=$max_year ; $min_year++): 
		$count_month_price=0;
		for (; $min_month!=$max_month+1 ; $min_month++): 
			if($min_month==13){
				$min_month=1;
				$min_year++;
			}
			$order_on_month = OutPut_orders_ByOrder_date($mindate,$maxdate,$min_month,$min_year);
			?>
			<tr>
				<th colspan="5"><h1><?=$month[$min_month]?>  <?=$min_year?></h1></th>
			</tr>
		
		
			<?php if($order_on_month):?> 
				<tr>
					<th scope="col"><h3>id order</h3></th>
					<th scope="col" ><h3>Название курса</h3></th>
					<th scope="col" ><h3>Логин</h3></th>
					<th scope="col" ><h3>Цена</h3></th>
				</tr>
			<?php else:?>
				
				<tr><th colspan="5"><h2>Нет заказов</h2></tr></th>
				
				<?php $count_month_price=0;?>
			<?php endif;?>

			<?php foreach($order_on_month as $order):
				$price = price_course($order['id_courses']);
				
				$count_month_price += $price['price'];
			
			
				?>
		
				<tr>
					
					<td ><?=$order['id_orders']?></td>
					<td><?=$order['name_courses']?></td>
					<td><?=$order['login']?></td>
					<td><?=$price['price']?>$</td>
					
				</tr>
					
					
			
			<?php endforeach?>
				<?php $count_price_itog+=$count_month_price?>
		
			<td colspan="5" style="background: #ECE9E0;"><h2>Итог за <?=$month[$min_month]?> <?=$count_month_price?>$</h2></td>
			<?php $count_month_price=0; ?>
		
		
		<?php endfor;?>
	<?php endfor;?>
		
    </table>
	<h1>Общий итог  <?=$count_price_itog?>$</h1>




</body>
</html>