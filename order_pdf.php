<?php 

$orders = selectAll('orders',['id_users'=>$_SESSION['id_users']]);
$sum=0;
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
		h1{
			text-align: center;
			color:#656665;
			margin-top: 1px;
		}
		h3{
			color:#656665;
		}


	</style>
</head>
<body>

	<h1>Заказы пользователя <?=$_SESSION['login']?></h1>

	<table>
		<tr>
			<th>№ заказа</th>
			<th>Название позиции</th>
			<!-- <th>Описание</th> -->
			<th>Стоимость</th>
		</tr>

		<?php foreach($orders as $key=>$ord): ?>
			
			<?php $courses = selectOne('courses',['id_courses'=>$ord['id_courses']]); ?>
	
			<tr>
				<td><?=$ord['id_orders']?></td>
				<td><?=$courses['name_courses']?></td>
				<td><?=$courses['price']?>$</td>
				<?php $sum+=$courses['price']?>
			</tr>
		<?php endforeach; ?>
    </table>

	<h3>Итого сумма всех заказов = <?=$sum?>$</h3>

</body>
</html>