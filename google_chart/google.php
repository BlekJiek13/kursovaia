
<?php
	include "../path.php";
	include "../app/control/courses.php";
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

			

			var data = new google.visualization.DataTable(
				<?php 


				$data = '{


				"cols": [
						{"label":"name_courses","type":"string"},
						{"label":"price","type":"number"}
					],
				"rows": [';

				foreach($course_on_category as $category){
					
					
				
					$data.= '{"c":[{"v":"';
						$data.=  $category['name_courses'];
						$data.=' "},{"v":';
						$data.= $category['price'];
						$data.= '  }]},';
				}

				$data = rtrim($data, ',');

				$data.=']}';

					echo $data;
				?>
		
			);


		
		
		
		
			// 
				
						
			// data.addRows();
			
			// Set chart options
			var options = {
				'title': 'График по категории "<?=$name_category['name_category']?>"',
				'width': 800,
				'height': 500,
				'pieHole': 0.2,
				// 'slices': {
				// 	0: { offset: 0.2 }
				// },
				'is3D': true,
				'legend': 'left',
				'pieStartAngle': 20,
				'backgroundColor': {
					// 'strokeWidth': 5,
					'fill': ''
				}
				// colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
			};

			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_col'));
			chart.draw(data, options);

			var chart2 = new google.visualization.PieChart(document.getElementById('chart_div_pie'));
			chart2.draw(data, options);
		}
	</script>


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
						<li><a href="/">Главная</a></li>
						<!-- <li><a href="#">О нас</a></li> -->
						<li><a href="../../courses.php">Курсы</a></li>
						<li><a href="../../chat.php">Чат</a></li>
						<li>
							<?php if(isset($_SESSION['id_users'])): ?>
								<a	a href="#">
									<i class="fa-solid fa-user"></i>
									<?php echo $_SESSION['login']; ?>
								</a>
								<ul>
									<?php if($_SESSION['admin']): ?>
										<li><a href="../../admin/posts/index.php">Админ панель</a></li>
									<?php else: ?>
										<li><a href="../../personal.php">Кабинет</a></li>
									<?php endif; ?>

									<li><a href="../logout.php">Выход</a></li>
									
								</ul>
							<?php else: ?>
								<a	a href="log.php">
									<i class="fa-solid fa-user"></i> Войти
								</a>
								<ul>
									<li><a href="reg.php">Регистрация</a></li>
									
								</ul>
							<?php endif; ?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
</header>

	<section class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 order-first" >
							
					<?php if($course_on_category):?>
						<div class="row">
						<div  id="chart_div_col" ></div>
						<div  id="chart_div_pie" ></div>
						</div>
					
						
					<?php elseif($_POST['category']):?>
						<h3 style="margin-top: 20px; ">Курсов на данную категорию не существует</h3>
					<?php endif;?>


				</div>	

				<!-- sidebar content -->
				<div class="sidebar col-md-3 order-last" >
					<div class="section search" style="margin-top: 20px;">
						<h3></h3>
						<form action="google.php" method="post">
							
							<select name="category" class="form-select" aria-label="Default select example">
								<option selected value="0" selected>Категории курсов</option>
								<?php foreach($topics as $top):?>
									<option value="<?=$top['id_name_category']?>" ><?=$top['name_category']?></option>
									
								<? endforeach;?>
								
							</select>
														
							<button style="width:100%; margin-top:20px" name="category_charts_create" type="submit" class="btn btn-light">
										<i class="fa-solid fa-chart-column" style="color: #640b56;"></i> Создать гистограмму
							</button>
						</form>
					</div>
				

				</div>
				
				<!-- sidebar content -->

			
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