<?php
include_once  '/www/wwwroot/boostrap.local/app/db.php';
	

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Моя первая страница WEB</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="http://boostrap.local/assets/css/style.css">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
	<link rel="shortcut icon" type="image/png" href="/assets/image/favicon1.png">

	<style>
		p{
			text-indent: 40px;
			margin-top: 0px;
			margin-bottom: 0px;
		}
		hr{
			color:blueviolet;
			
		}
		body{
			background-color: whitesmoke;
		}
	
		table{
			width: 100%;
	
			
		}
		table, th, td {
			border: 3px solid;

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

		table.table2 tr td{
			height: 100px;
			
		}


	

	</style>

</head>


<body>
	
<!-- 
<div class="2_zad" style="text-align: center; margin-top: 10px;">

	<h1>Моя первая Web-страница</h1>
	<hr></hr>

	<I>Шеметов Илья Александрович</I>
	<b style="font-family: Arial, Helvetica, sans-serif;">404</b>


	<div style="color:red; font-family: Arial, Helvetica, sans-serif; "><u>Шеметов Илья Александрович 404</u></div>

</div>


Нижний регистр - <sub></sub>
Вверхний - <sup></sup>


<div class="3_zad" style="text-align: center; margin-top: 60px; font-family: Arial, Helvetica, sans-serif;">
	<div class="formula1" style="color: blueviolet; font-family: Arial, Helvetica, sans-serif;">
			Арифметическая прогрессия <br>
			a<sub>n</sub> = a<sub>1</sub> + (n-1)*d <br>
	</div>
	<div class="formula2" style="color: blue; font-family: Arial, Helvetica, sans-serif;">
		Куб суммы <br>
		(x+y)<sup>3</sup> = x <sup>3</sup> + 3x<sup>2</sup>y + 3xy<sup>2</sup> + y<sup>3</sup> <br>
	</div>
	<div class="formula3" style="color: grey; font-family: Arial, Helvetica, sans-serif;">
		Разность кубов <br>
		x<sup>3</sup> - y<sup>3</sup> = (x-y)*(x<sup>2</sup> + xy + y<sup>2</sup>) 	
	</div>
</div>
<b style="text-decoration:dashed;"></b>

<div class="zad-4" style="margin-top: 10rem; margin-left:20px;">
	<h1 style="text-align: center;">Структура программного обеспечения компьютера</h1>
	<hr>
	<p><b style="color: red; text-decoration: underline;">Программное обеспечение </b> - 
	неотъемлемая часть компьютерной системы. Оно является логическим продолжением технических 
	средств. <sub>Сфера применения конкретного компьютера определяется созданным для него 
	программным обеспечением.</sub> Сам по себе компьютер не обладает знаниями ни в одной области
	 применения. <h4><i> Все эти знания сосредоточены в выполняемых на компьютерах программах.</i></h4></p>

	<h3><p>Программное обеспечение, можно условно разделить на три категории:</p></h3>
	<p> 1. <font color="brown">Системное ПО</font> <u><i>(программы общего пользования)</i></u>, выполняющие различные вспомогательные
		функции, например создание копий используемой информации, выдачу справочной
		информации о компьютере, проверку работоспособности устройств компьютера
		и т.д.</p>
	<p>2. <font color="yellow">Прикладное ПО</font>, обеспечивающее выполнение необходимых работ на ПК: 
		редактирование текстовых документов, создание рисунков или картинок, 
		обработка информационных массивов и т.д.</p>
	<p>3. <font color="grey">Инструментальное ПО</font> <u><i>(системы программирования)</i></u>, 
		обеспечивающее разработку новых программ для компьютера на языке
		 программирования.</p>

</div> -->

<!-- 
<div class="zad-1">
	<ul type="disc">
		<li>Петров</li>
		<li>Иванов</li>
		<li>Сидоров</li>
	</ul>

	<ol>
		<li>Петров</li>
		<li>Иванов</li>
		<li>Сидоров</li>
	</ol>

	<dl>
		<dt>БРАУЗЕР</dt>
		<dd> <p>Программа, предназначенная для просмотра Web-документов и перехода между ними</p></dd>
		<dt>HTML</dt>
		<dd>  <p>Язык разметки гипертекста. Используется для подготовки Web-документов</p></dd>
		<dt>ТЕГ</dt>
		<dd> <p> Маркер, заключенный в угловые скобки. Меняет формат документа</p></dd>
	</dl>

</div>


<div class="zad-2">
	<h4 style="text-align: center;">СПИСКИ НА WEB-СТРАНИЦАХ</h4>
	<hr>
	Списки на Web-страницах могут быть трех типов:
	<ol>
		<li>Маркированные</li>
			<ul type="disc">
				<li>маркер disc</li>
			</ul>
			<ul type="square">
				<li>маркер square</li>
			</ul>
			<ul type="circle">
				<li>маркер circle</li>
			</ul>
		<li>Нумерованные</li>
		<ol type="1"><li>Арабские цифры</li>
			<li>Буквами</li>
				<ol type="A"><li>Прописными</li></ol>
				<ol type="a"><li>Строчными</li></ol>
		</ol>
		<li>Списки определений</li>
	</ol>
</div>



<div class="zad-3">
	<dl>
		<dt>Систе́мный блок</dt>
		<dd> <p>физически представляет собой корпус, наполненный аппаратным обеспечением для создания компьютера.</p></dd>
		<dt>Видеока́рта</dt>
		<dd>  <p>устройство, преобразующее графический образ, хранящийся как содержимое памяти компьютера (или самого адаптера), в форму, пригодную для дальнейшего вывода на экран монитора.</p></dd>
		<dt>Блок питания</dt>
		<dd> <p> устройство, предназначенное для формирования напряжения, необходимого системе, из напряжения электрической сети. </p></dd>
		<dt>Компью́терная мышь</dt>
		<dd> <p> координатное устройство для управления курсором и отдачи различных команд компьютеру. </p></dd>
		<dt>Монитор </dt>
		<dd> <p> устройство оперативной визуальной связи пользователя с управляющим устройством и отображением данных, передаваемых с клавиатуры, мыши или центрального процессора. </p></dd>
	</dl>
</div> -->

<!-- 
<div class="zad-4">
	<h2 style="text-align: center;">Вставка рисунка</h2>
	<hr>
	<center><img src="../assets/image/123.jpg" alt="" width="600px;" height="400px;" border="10"></center>

	<br>
	<p style="text-align: center;">Программист пишет код</p>


	<center><img src="../assets/image/image_3.jpg" alt="" width="600px;" height="400px;"></center>

	<br>
	<p style="text-align: center;">на рисунке представлено что делает программист. В голове у него много языков программирования</p>

</div> -->

<div class="zad6">
	<table border="3" width="100%">
		<CAPTION>Таблица 2</CAPTION>
		<tr style="color:chartreuse">
			<td >Слово</td>
			<td ><b>Синоним</b></td>
			<td ><b>Антоним</b></td>
		</tr>
		<tr style="color: red;">
			<td rowspan="2">Мокрый</td>
			<td>Влажный</td>
			<td>Сухой</td>
		</tr>
		<tr style="color: red;">
			<td colspan="2">Другие синонимы: сырой, промозглый</td>
		
		
		</tr>
		
	</table>



	<table border="3" width="100%" class="table2">
		<CAPTION>Таблица 2</CAPTION>
		<tr style="color:aqua; ">
			<td style="height:50px">Слово</td>
			<td ><b>Синоним</b></td>
			<td ><b>Антоним</b></td>
		</tr>
		<tr style="color: blue;">
			<td rowspan="2">Мокрый</td>
			<td>Влажный</td>
			<td>Сухой</td>
		</tr>
		<tr style="color: blue;">
			<td colspan="2">Другие синонимы: сырой, промозглый</td>
		
		
		</tr>
		
	</table>
</div>

<div style="margin-bottom: 200px;"></div>




	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>