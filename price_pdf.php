<?php 

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


	<h1>Прайс Лист MyCourse</h1>
	<table>
		<tr>
			<th>№</th>
			<th>Название</th>
			<!-- <th>Описание</th> -->
			<th>Количество часов</th>
			<th>Стоимость $</th>
		</tr>

		<?php $coursePublish = selectAll('courses', ['status' => 1]);?>
		<?php foreach($coursePublish as $key=>$course): ?>
			<tr>
				<td><?=$key+1?></td>
				<td><?=$course['name_courses']?></td>
				<!-- <td><?=$course['description']?></td> -->
				<td><?=$course['hours']?></td>
				<td><?=$course['price']?>$</td>
			</tr>
		<?php endforeach; ?>
    </table>




</body>
</html>