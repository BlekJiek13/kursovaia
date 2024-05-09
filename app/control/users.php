<?php



include  '/www/wwwroot/boostrap.local/app/db.php';


$errMsg=[];

$users = selectAll('users');


$suc = [];

//попадаем сюда с формы регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
	
	$randForm = trim($_POST['kod']); 
	echo($randForm);
	$emailkod = trim($_POST['kodvalue']); 
		echo($emailkod);

	$FIO_USERS =trim($_POST['FIO_users']); 
	$lOGIN = trim($_POST['login']);
	$EMAIL = trim($_POST['email']);
	$pass = trim($_POST['password']);
	$admin = 0;

	if($randForm === '' || $lOGIN === '' || $FIO_USERS === '' || $EMAIL=== '' || $pass === '' ){
		array_push($errMsg,"Не все поля заполнены!");

	}elseif(mb_strlen($lOGIN,'UTF-8') < 5){
		array_push($errMsg, "Короткий логин");
	
	}elseif(mb_strlen($pass,'UTF-8') < 5){
		array_push($errMsg,"Короткий пароль");
		
	}elseif($randForm!=$emailkod){
		array_push($errMsg,"Неверный код, отправьте новый на почту");
	}
	else{
	
		$existence = selectOne('users', ['email' => $EMAIL]);
		
		if($existence['email'] === $EMAIL){
			array_push($errMsg,"Пользователь с такой почтой уже зарегистрирован!");
		}else{
			$pass = password_hash($pass,PASSWORD_DEFAULT);
			$post = [
				'FIO_users' => $FIO_USERS,
				'login' => $lOGIN,
				'password' => $pass,
				'email' => $EMAIL,
				'admin' => $admin
			];

		$id = insert('users',$post);
		
		$user = selectOne('users',['id_users' => $id]);

		// $_SESSION['id_users'] = $user['id_users'];
		// $_SESSION['login'] = $user['login'];
		// $_SESSION['admin'] = $user['admin'];
		// $_SESSION['email'] = $user['email'];
	
		

		header('location: ' . 'http://boostrap.local/log.php');


		
		}
	}
	// $last_row = selectOne('users', ['id_users'=>$id]);

}else{

	
}


//попадаем сюда с формы регистрации через кнопку получить код
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email-cod'])){

	require 'phpMailer/PHPMailer.php';
	require 'phpMailer/SMTP.php';
	require 'phpMailer/Exception.php';

	$FIO_USERS = trim($_POST['FIO_users']);
	$lOGIN = trim($_POST['login']);
	$EMAIL = trim($_POST['email']);

	$email = trim($_POST['email']);
	if($email=== ''){
		array_push($errMsg,"Введите email");
	}else{


	$rand = mt_rand(100000,999999);
	// echo '"'
	// echo($rand);

	// Формирование самого письма
	$title = "Код регистрации";
	$body = "
	<h2>Ваш код:</h2>
	<b>$rand<br>";

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
		$mail->addAddress($email);  
	
		// Отправка сообщения
		$mail->isHTML(true);
		$mail->Subject = $title;
		$mail->Body = $body;    

		// Проверяем отравленность сообщения
		if ($mail->send()){
			array_push($suc, "Код отправлен" );
		}else{
			array_push($errMsg, "Введите существующую почту");
		}

	} catch (Exception $e) {

		array_push($errMsgemail, "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}");
	}



		
		
	}
	// $last_row = selectOne('users', ['id_users'=>$id]);

}else{
	$FIO_users = '';
	$login = '';
	$email = '';
}

//попадаем сюда с формы авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
	
	$email = trim($_POST['email']);
	$pass = trim($_POST['password']);

	if($email === '' || $pass === '' ){
		array_push($errMsg,"Не все поля заполнены!");
	}
	else{
		$existence = selectOne('users', ['email' => $email]); //проверка на email в бд
		if($existence && password_verify($pass,$existence['password'])){

			$_SESSION['id_users'] = $existence['id_users'];
			$_SESSION['login'] = $existence['login'];
			$_SESSION['admin'] = $existence['admin'];
			$_SESSION['email'] = $existence['email'];

			

			if($_SESSION['admin']){
				//header('location: ' . 'http://boostrap.local/');
				header('location: ' . 'http://boostrap.local/' . 'admin/posts/index.php');
			}else{
				header('location: ' . 'http://boostrap.local/');
			
			}


		}else{
			 array_push($errMsg,"Почта или пароль введены неверно!");
		}
	}

}else{
	$email ='';
}






//код добавления пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){
	
	//test($_POST);


	$FIO_users = trim($_POST['FIO_users']);
	$login = trim($_POST['login']);
	$email = trim($_POST['email']);
	$pass = trim($_POST['password']);

	//если с метода POST прилетает инф. по админу то 1 если нет то 0
	$admin = isset($_POST['admin']) ? 1 : 0;


	

	if($login === '' || $FIO_users === '' || $email=== '' || $pass === '' ){
		array_push($errMsg,"Не все поля заполнены!");
	}elseif(mb_strlen($login,'UTF-8') < 5){
		array_push($errMsg,"Короткий логин");
	}elseif(mb_strlen($pass,'UTF-8') < 5){
		array_push($errMsg,"Короткий пароль");
	}
	else{
		$existence = selectOne('users', ['email' => $email]);
		if($existence['email'] === $email){
			array_push($errMsg,"Пользователь с такой почтой уже зарегистрирован!");
		}else{
			$pass = password_hash($pass,PASSWORD_DEFAULT);
			
			$user = [
				'FIO_users' => $FIO_users,
				'login' => $login,
				'password' => $pass,
				'email' => $email,
				'admin' => $admin
			];

			$id = insert('users',$user);
			
			$user_ = selectOne('users',['id_users' => $id]);

			if($_SESSION['admin']){
				header('location: ' . 'http://boostrap.local/' . 'admin/users/index.php');
			}else{
				header('location: ' . 'http://boostrap.local/');
			}
		
		}
	}


}else{
	
}


//Редактирование пользователя

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){    //если в методе GET есть id 
	
	
	//для потдягивания логина email

	$user = selectOne('users', ['id_users' => $_GET['edit_id']]);


	
	$id_users = $user['id_users'];
	$FIO_users = $user['FIO_users'];
	$login = $user['login'];
	$email = $user['email']; 
	$admin = $user['admin']; 

	
	


}
//кнопка обновить
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){   //topic-create - name кнопки
	 test($_POST);
	


	$id_users = $_POST['id'];
	$email = trim($_POST['email']); 				
	$login = trim($_POST['login']); 
	$FIO_users = trim($_POST['FIO_users']); 	
	$pass = trim($_POST['password']); 		
	$admin = isset($_POST['admin']) ? 1 : 0;

	

	if($login === '' || $FIO_users === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($login, 'UTF8') < 5 ){
		array_push($errMsg,"Логин должен быть более 5-х символов");
	}
	else{	
	
		//формирование массива с пользователем
			
		if($_POST['password']){
			$pass = password_hash($pass,PASSWORD_DEFAULT);
			$user = [
				'FIO_users' => $FIO_users,
				'login' => $login,
				'password' => $pass,
				'admin' => $admin
			];
		}else{
			//если пароль мы не трогаем то он остается тем же
			$user = [
				'FIO_users' => $FIO_users,
				'login' => $login,
				'admin' => $admin
			];
		}
			


		

		$user = update('users',$id_users,$user);
		header('location:index.php'); //переход после кнопки на index
		
		
	}

}else{

	
	
}


//Удаление пользователя

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){   

	$id = $_GET['delete_id'];
	delete('users',$id);
	header('location: index.php');

}





?>