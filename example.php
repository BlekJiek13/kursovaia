<?php 
include  '/www/wwwroot/boostrap.local/app/db.php';

?>


<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
	rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>


	<style>
		body{
			font-family: DejaVu Sans, sans-serif;
		}

		
	table {
		width: 100%; /* Ширина таблицы */
		background: white; /* Цвет фона таблицы */
		color: white; /* Цвет текста */
		border-spacing: 2px; /* Расстояние между ячейками */
	}
	td, th {
		background: rgb(172, 142, 255); /* Цвет фона ячеек */
		padding: 5px; /* Поля вокруг текста */
	}
	h1{
		text-align: center;
		margin-top: 1px;
	}
  

	</style>
</head>
<body>
	<h1>Прайс Лист MyCourse</h1>
	<table>
		<tr>
			<th>№</th>
			<th>Название</th>
			<td>Количество часов</td>
			<td>Стоимость $</td>
		</tr>
		<tr>
			
			<td>Ячейка 4</td>
		</tr>
    </table>


	<div style ="margin-left:100px" class="d-flex flex-row bd-highlight mb-3">
		<div class="p-2 bd-highlight">Flex item 1</div>
		<div class="p-2 bd-highlight">Flex item 2</div>
		<div class="p-2 bd-highlight">Flex item 3</div>
	</div>

</body>
</html>