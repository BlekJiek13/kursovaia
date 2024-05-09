<?php 

include_once  '/www/wwwroot/boostrap.local/app/db.php';


$success=[];
$errMsg=[];

$tovar = selectOne('courses', ['id_courses' => $_GET['id']]);

if($_SESSION['cart']){
	foreach ($_SESSION['cart'] as $cart ){
		$sum_cart += $cart['price'];
		$qty_cart++;
	}	
}





//попадаем после нажатие на корзину
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){

	if(!$_SESSION['email']){
		
	}else{
	$qty = 1;
	$id_course =  $_GET['id']; 
	$course = selectOne('courses', ['id_courses' =>$id_course]);

	if(isset($_SESSION['cart'][$id_course])){
		
		$_SESSION['cart'][$id_course]['qrt'] +=$qty;
	}else{
		
		$course_s =[
			'id_courses' => $id_course,
			'hours'=>$course['hours'],
			'price' =>$course['price'],
			'name_courses'=>$course['name_courses'],
			'description' =>$course['description'],
			'img' =>$course['img'],
			'qrt' => $qty
		];
		$_SESSION['cart'][$id_course] = $course_s;
	}


	// //кол-во товаров в корзине
	// $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
	
	// //сумма товаров в корзине
	// $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $_SESSION['cart'][$id_course]['price']  :  $qty * $_SESSION['cart'][$id_course]['price'];

	}
header('location:../../courses.php');
}





//попадаем после нажатие на корзину
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_del'])){

	if($_SESSION['cart'][$_GET['id_del']]['qrt']==1){
		$_SESSION['cart.qty'] -= 1;
		$_SESSION['cart.sum'] -=$_SESSION['cart'][$_GET['id_del']]['price'];
		unset($_SESSION['cart'][$_GET['id_del']]);
	}else{
		$_SESSION['cart'][$_GET['id_del']]['qrt'] -=1;
		$_SESSION['cart.qty'] -= 1;
		$_SESSION['cart.sum'] -=$_SESSION['cart'][$_GET['id_del']]['price'];
	}
	
	header('location:../../cart.php');
}


//попадаем после нажатие на покупку - отправка сообщения пользователю о заказе
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_buy'])){
	if(isset($_SESSION['cart'][$_GET['id_buy']]['id_courses'])){
		header('location:../../cart.php');	
	}


	require 'phpMailer/PHPMailer.php';
	require 'phpMailer/SMTP.php';
	require 'phpMailer/Exception.php';

	
	$id_user = $_SESSION['id_users'];
	$id_course = $_SESSION['cart'][$_GET['id_buy']]['id_courses'];


	$contents = selectAll('content_course',['id_courses' => $id_course] );
	
	foreach($contents as $key=> $content){	
		insert('progress_course', ['id_content_course' => $contents[$key]['id_content_course'],
		'id_users' => $_SESSION['id_users'], 'progress' => 0,
		'id_courses' => $contents[$key]['id_courses']]);
	}

	
	
	unset($_SESSION['cart'][$_GET['id_buy']]);

	// --$_SESSION['cart.qty'];
	// $_SESSION['cart.sum'] =  $_SESSION['cart.sum'] - $_SESSION['cart'][$_GET['id_buy']]['price']; 







	// $user = selectOne('users', ['id_users' => $id_user]);
	// $name_course = selectOne('courses', ['id_courses'=>$id_course]);
	$order_id =insert('orders', ['id_courses'=> $id_course, 'id_users'=> $id_user]);
	// $order_id = $order_id + 100000;
	//  // Формирование самого письма
    // $title = "Оформлен заказ на сайте MyCourse";
    // $body = "
    // <h3>Ваш заказ под номером: ". $order_id . "</h3> 
    // <b>Приобретен курс</b> \"" .$name_course['name_courses'] . "\"  </br>
	// <b>Стоимость: " .$name_course['price']. "$ </b></br>
	// <b>Описание курса</b> : ".$name_course['description']." </br>
	// Спасибо за покупку, по всем вопросам обращайтесь на служебную почту через личный кабинет.
    // ";
	// $email = $user['email'];
	// // Настройки PHPMailer
	// $mail = new PHPMailer\PHPMailer\PHPMailer();
	// 	$mail->isSMTP();   
	// 	$mail->CharSet = "UTF-8";
	// 	$mail->SMTPAuth   = true;
	// 	//$mail->SMTPDebug = 2;
	// 	$mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

	// 	// Настройки вашей почты
	// 	$mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
	// 	$mail->Username   = 'i-shemetov@mail.ru'; // Логин на почте
	// 	$mail->Password   = 'q7yc90wKBc4fJdjgjkuc'; // Пароль на почте
	// 	$mail->SMTPSecure = 'ssl';
	// 	$mail->Port       = 465;
	// 	$mail->setFrom('i-shemetov@mail.ru','MyCourse'); // откуда будем отправлять письмо

	// 	// Получатель письма
	// 	$mail->addAddress($email);  
	
	// 	// Отправка сообщения
	// 	$mail->isHTML(true);
	// 	$mail->Subject = $title;
	// 	$mail->Body = $body;    

      
	// 	// Проверяем отравленность сообщения
	// 	if ($mail->send()){
	// 	}else{		
	// 	}
}









?>