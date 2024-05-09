<?php



$host= 'localhost';
$data = 'course';
$user='Course';
$pass='2LMYEnFZrhbNyYYa';
$options = [PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];

try {
	$pdo = new PDO("mysql:host=$host;dbname=$data;charset=utf8","$user","$pass",$options);
} catch (PDOException $i) {
	die("Ошибка подключения к бд");
}



?>