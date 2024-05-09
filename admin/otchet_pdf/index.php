<?php session_start(); 
include  '/www/wwwroot/boostrap.local/app/db.php';
?>
	 
<!doctype html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Course</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="hvttps://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="../../assets/css/admin.css">

	<link rel="stylesheet" href="../../app/calendar/air-datepicker.css">

	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>

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
	
	<div class="container">
		<?php include "../../app/include/sidebar-admin.php"; ?>
			<div class="posts col-9">
			

				<div class="row title-table">
					<h2  class="mb-4">Выбор даты для отчета </h2>

					<form style="margin-top:20px; margin-left:-10px" action="../../app/control/pdf.php" method="POST" >								
						<input name="date" type="text" id="airdatepicker" class="form-control">

						<button style="margin-top:20px; width:260px" name="otchet_pdf" type="submit" class="btn btn-light">
									<i class="fa-solid fa-download"></i> Выписка о заказах в PDF
						</button>

						<button style="margin-top:20px; width:260px; margin-left:10px" name="chart" type="submit" class="btn btn-light">
									<i class="fa-solid fa-chart-column" style="color: #640b56;"></i> График отчета
						</button>
					</form>

				


				</div>

				<div class="row title-table">
					<h2  class="mb-4">Проверка гипотезы о существовании тренда </h2>
					<form style=" text-align: center;  margin-left:-10px" action="../../app/control/gypotiza_grafics_rost/gipoteza.php" method="POST">
						<button style=" width:260px; margin-left:10px; height: 60px" name="chart" type="submit" class="btn btn-light">
									Проверка гипотезы
						</button>
					</form>


					<h2  class="mb-4">Построение кривых роста </h2>
					<form style=" text-align: center;  margin-left:-10px" action="../../app/control/gypotiza_grafics_rost/grafic_rost.php" method="POST">
						<button style=" width:260px; margin-left:10px; height: 60px" name="chart" type="submit" class="btn btn-dark">
									<i class="fa-solid fa-chart-column" ></i>Графики кривых роста
						</button>
					</form>
					
				</div>
				
				
				
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
		<?php include '../../app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
		<script src="../../app/calendar/air-datepicker.js"></script>
		<script>
			<?php $mindate= Min_Order(); 
				$min_temp = mb_substr($mindate['date'],5,2) . ' ' . mb_substr($mindate['date'],8,2). ' ' . mb_substr($mindate['date'],2,2);
				$maxdate = Max_Order();
				$max_temp =mb_substr($maxdate['date'],5,2) . ' ' . mb_substr($maxdate['date'],8,2). ' ' . mb_substr($maxdate['date'],2,2); 
			?>
			
			new AirDatepicker('#airdatepicker', {
			 isMobile: true,
   			 autoClose: true,
  			 range: true,
   			 multipleDatesSeparator: ' - ',
			 minDate: "<?=$min_temp?>",
			 maxDate: "<?=$max_temp?>",
					 
			});


			

		</script>
	
</body>

</html>