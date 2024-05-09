<?php
include  '/www/wwwroot/boostrap.local/app/db.php';



$sum_order = sum_orders_on_month('"2022.01.01"','"2023.04.13"');
$month = [
	"1" => 'Январь',"2" => 'Февраль',"3" => 'Март',"4" => 'Апрель',
	"5" => 'Май',"6" => 'Июнь',"7" => 'Июль',"8"=>'Август',
	"9"=> 'Сентябрь',"10"=> 'Октябрь',"11"=>'Ноябрь',"12"=>'Декабрь'
];

$abc = [];
$abc1 =[];

$random_city = [[54.21956026558543,45.115193531484245,'Саранск'],
[54.187433,45.183938,'Саранск'],
[56.326797,44.006516,'Нижний Новгород'],
[59.938955,30.315644,'Санкт-Петербург'],
[53.195878,50.100202,'Самара'],
[40.714627,-74.002863,'штат Нью-Йорк'],
[42.36638706842742,-71.08116503920945,'Массачусетс'],
[55.781042777575415,49.127319265145424,'Республика Татарстан'],
[56.81335302570613,53.25268547608293,'Ижевск'],
[51.7151334017035,55.098388601082924,'Оренбург'],
[57.98457261256929,56.26943551719238,'Пермь'],
[50.40750118402632,30.56283029827939,'Киев'],
[51.599689291336496,39.17611154827938,'Воронеж']
];
$count_user = count_user();
$random_count = rand(1,5);



$bubbly = bubbly_chart_parametr();
$calendar = calendar_chart_parametr();
$sanky = sanky_chart_parametr();
$timeline = timeline_chart_parametr();

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
 


	<script src="https://api-maps.yandex.ru/2.1/?apikey=db4c72d5-0250-4ef8-818d-5feec90bd800&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
      	ymaps.ready(init);
	function init() {
    let map = new ymaps.Map('map', {
        center: [54.18715, 45.18605],
        zoom: 8,
    });
    map.controls.remove('geolocationControl');
    map.controls.remove('searchControl');
    map.controls.remove('trafficControl');
    map.controls.remove('typeSelector');
    map.controls.remove('fullscreenControl');
    map.controls.remove('zoomControl');
    map.controls.remove('rulerControl');

    <?php for($i = 0; $i < 10; $i++) {
        $city = $random_city[$random_count][2];
		$random_count = rand(1,8);
    ?>

        ymaps.geocode('<?php echo $city ?>', { results: 1 }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            var coords = firstGeoObject.geometry.getCoordinates();
            var bounds = firstGeoObject.properties.get('boundedBy');
            firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
            firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine() + '. Кол-во: <?php echo $random_count; ?>');
            firstGeoObject.properties.set('balloonContentHeader', 'Количество');
            firstGeoObject.properties.set('balloonContentBody', '<p>Проживающих: <?php echo $random_count; ?></p>');
            map.geoObjects.add(firstGeoObject);
        });

    <?php } ?>
}
	
</script>




<script>
	type = "text/javascript" >

	google.charts.load('current', { packages: ['calendar', 'corechart','sankey','timeline']});

	google.charts.setOnLoadCallback(drawChart);
  	

	
	function drawChart() {

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
		?>

		var monthly_rev = google.visualization.arrayToDataTable([
			[ 'Месяц', 'Выручка', 'l=3', 'l=7', 'l=5'],
			<?php 
			foreach ($monthly_revenue as $key => $dat) {
				$st = "['$dat[0]', ". $dat[1] .", ". $dat[2] .", ". $dat[3] .", ". $dat[4] ."],";
				//array_push($abc,$st);
				echo($st);
			}
			?>
		]);

		var options_monthly_rev = {
			title: 'Расчет скользящих средних "Выручка по месяцам"',
			hAxis: {title: 'Месяца', titleTextStyle: {color: '#333'}},
			vAxis: {title: 'Выручка',minValue: 0},
			'width': 1050,
			'height': 700,
			'backgroundColor': {
				'fill': ''
			}

		};

		var bubly = google.visualization.arrayToDataTable([
			['Товар', 'Цена', 'Купили', 'Прибыль'],
			<?php 
			foreach ($bubbly as $key => $bub) {
				$st = "['$bub[name_courses]', ". $bub['price'] .", ". $bub['buy'] .", ". $bub['profit'] ."],";
				//array_push($abc,$st);
				echo($st);
			}
			?>
		]);
		var sanky = google.visualization.arrayToDataTable([
			['From', 'to', 'Weight'],
			//['Category A', 'Category X', 5],
			<?php 
			foreach ($sanky as $key => $sun) {
				$st = "['$sun[name_courses]', '". $sun['name_category'] ."', ". $sun['id_category'] ."],";
				//array_push($abc,$st);
				echo($st);
			}
			?>
		]);
		var calendar_charts = new google.visualization.arrayToDataTable([
			['Дата','Прибыль'],
			<?php 
			foreach ($calendar as $key => $cal) {
				$st = "[ new Date(".$cal['year'].',' . ($cal['month']-1) . ','. $cal['day'] ."), ". $cal['count'] ."],";
				//array_push($abc,$st);
				echo($st);
			}
			?>
		]);


		var timeline_charts = new google.visualization.arrayToDataTable([
			['Товар','Дата начала','Дата окончания'],
			<?php 
			foreach ($timeline as $time) {
				$st = "['". $time['name_courses'] . "', new Date(".$time['year_min'].',' . ($time['month_min']-1) . ','. $time['day_min'] ."), new Date(".$time['year_max'].',' . ($time['month_max']-1) . ','. $time['day_max'] .")],";
				//array_push($abc,$st);
				echo($st);
			}
			?>
		]);


			



		var colors = ['#a6cee3', '#b2df8a', '#fb9a99', '#fdbf6f',
                  '#cab2d6', '#ffff99', '#1f78b4', '#33a02c'];

		var options_sanky = {
			height: 900,
			width:900,
			sankey: {
			node: {
				colors: colors
			},
			link: {
				colorMode: 'gradient',
				colors: colors
			}
			}
		};


		var options_bubly = {
			title: 'Пузырьковая диаграмма',
			hAxis: {title: 'Цена товара',maxValue:150},
			vAxis: {title: 'Кол-во продаж',maxValue:50},
			bubble: {textStyle: {fontSize: 15}},
			'width': 1550,
			'height':1100,
			'backgroundColor': {
				'fill': ''
			}
		};

	 	var options_timeline = {
			title: 'Хронология покупок товаров',
			height:400,
			width: 1400
        };


        var options_calendar = {
			title: "Продажи курсов по дням",
			'width': 1550,
			'height':700,
			calendar: { cellSize: 25,
			monthLabel: {
			fontName: 'Times-Roman',
			fontSize: 15,
			color: 'blue',
			bold: true,		
				},
			},
        };

	   

		var areacharts = new google.visualization.AreaChart(document.getElementById('areachart'));
		areacharts.draw(monthly_rev, options_monthly_rev);

		var bublechart = new google.visualization.BubbleChart(document.getElementById('bubly'));
		bublechart.draw(bubly, options_bubly);

		var calendar = new google.visualization.Calendar(document.getElementById('calendar_basic'));
		calendar.draw(calendar_charts, options_calendar);

		var sankychart = new google.visualization.Sankey(document.getElementById('sankey_chart'));
        sankychart.draw(sanky, options_sanky);

		var timeline = new google.visualization.Timeline(document.getElementById('timeline'));
        timeline.draw(timeline_charts, options_timeline);

	}
</script>

		
	
<section class="main-content">
	<div class="container">	
		<div class="row">

		
			<div class="col-12" ><div  id="areachart" ></div></div>
			<div class="col-12" ><div  id="bubly" ></div></div>
			<div class="col-12" ><div  id="calendar_basic" ></div></div>
			<div class="col-12" ><div  id="sankey_chart" ></div></div>
			<div class="col-12" ><div  id="timeline" ></div></div>
	
			<div id="map" style="width: 1800px; height: 800px;"></div>


			
			
			

		</div>
	</div>
</section>

		
		

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
	crossorigin="anonymous">
</script>


		
	
</body>

</html>