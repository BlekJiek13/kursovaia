<?php 
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';
	include  '/www/wwwroot/boostrap.local/app/db.php';
	$user = selectOne('users', ['id_users' => $_SESSION['id_users']]);
	
	


$errMsg = [];
$errMsgemail = [];
$suc = [];


//изменение данных пользователя
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_personal'])){

	$id =  trim($_POST['id']); 	
	$FIO_users = trim($_POST['FIO_users']); 	
	$pass = trim($_POST['password']); 		
	$login = trim($_POST['login']); 
	
	
	if(mb_strlen($login,'UTF-8') < 5){
		array_push($errMsg, "Короткий логин");
	}else{
		if($_POST['password']){
			$pass = password_hash($pass,PASSWORD_DEFAULT);
			$user = [
				'FIO_users' => $FIO_users,
				'login' => $login,
				'password' => $pass,
			];
		}else{

			if(mb_strlen($pass,'UTF-8') < 5){
				array_push($errMsg,"Короткий пароль");
			}
			//если пароль мы не трогаем то он остается тем же
			$user = [
				'FIO_users' => $FIO_users,
				'login' => $login,
			];
		}

		
		$user = update('users',$id,$user);
		header('location:personal.php'); //переход после кнопки на index
			
	}
	
}



//email
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])){

	$fio = selectOne('users',['id_users'=>$_SESSION['id_users']]);
	$caption = trim($_POST['caption']); 	
	$message = trim($_POST['message']); 		

	if(mb_strlen($message,'UTF-8') < 10){
		array_push($errMsgemail, "Короткое сообщение");
	}elseif(mb_strlen($caption,'UTF-8') < 8){
		array_push($errMsgemail, "Короткий заголовок");
		
	}else{
		// Переменные, которые отправляет пользователь
		$name = $fio['FIO_users'];
		$email = $_SESSION['email'];
		$login = $_SESSION['login'];
		$text = $message;


		// Формирование самого письма
		$title = $caption;
		$body = "
		<h2>Новое сообщение</h2>
		<b>login:</b> $login<br>
		<b>ФИО:</b> $name<br>
		<b>Почта:</b> $email<br><br>
		<b>Сообщение:</b><br>$text
		";

		// Настройки PHPMailer
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		try {
			$mail->isSMTP();   
			$mail->CharSet = "UTF-8";
			$mail->SMTPAuth   = true;
			//$mail->SMTPDebug = 2;
			$mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

			// Настройки вашей почты
			$mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
			$mail->Username   = 'i-shemetov@mail.ru'; // Логин на почте
			$mail->Password   = 'q7yc90wKBc4fJdjgjkuc'; // Пароль на почте
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;
			$mail->setFrom('i-shemetov@mail.ru','MyCourse'); // откуда будем отправлять письмо

			// Получатель письма
			$mail->addAddress('ilyashemetov88@gmail.com');  
		
			// Отправка сообщения
			$mail->isHTML(true);
			$mail->Subject = $title;
			$mail->Body = $body;    

			// Проверяем отравленность сообщения
			if ($mail->send()){
				array_push($suc, "Сообщение отправлено" );
			}else{
				array_push($errMsgemail, "Ошибка отправления");
			}
		}catch (Exception $e) {

			array_push($errMsgemail, "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}");
		}
	}
}


?>