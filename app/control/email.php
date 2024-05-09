<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';

    require '../../phpMailer/PHPMailer.php';
	require '../../phpMailer/SMTP.php';
	require '../../phpMailer/Exception.php';


$Users_email = AllEmailUsers();
$suc = [];
$errMsgemail =[];

$rassylka = selectAll('rassylka');


function request($caption,$text,$email,$i,&$suc=[],&$errMsgemail=[]){

    // Формирование самого письма
    $title = $caption;
    $body = "
    <h2>Новое сообщение</h2>
    <b>От Компании MyCourse</b><br>
    <b>Сообщение:</b><br>$text
    ";

	// Настройки PHPMailer
	$mail = new PHPMailer\PHPMailer\PHPMailer();
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

        if($i==1){
            // Проверяем отравленность сообщения
            if ($mail->send()){
                array_push($suc, "Сообщение отправлено" );
                 return true;
            }else{
                array_push($errMsgemail, "Возможно почта или аккаунт был удален");}
                 return false;
        }else{
            if ($mail->send()){
                return true;
		}else{
             return false;
		}
        }
		


}
//отправление сообщений от админа
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_email'])){

    $caption = trim($_POST['caption']);
    $text = trim($_POST['message']);
    $email = trim($_POST['topic']);

   

    $send =0;
    $error =0;

	if($email=== '1'){
        foreach($Users_email as $em){
            if(request($caption,$text,$em['email'],0,$suc,$errMsgemail)){
                ++$send;
                $id_user = selectOne('users', ['email' => $em['email']]);
                $mas = [
                    'id_users' => $id_user['id_users'],
                    'text' => $text,
	        	];
                insert('send_email', $mas);
            }else{ ++$error;}
        }
         $temp = "Сообщений отправлено: " . $send .  " Не удалось отправить: " . $error;
         array_push($suc,  $temp );
	}else{
         if(request($caption,$text,$email,1,$suc,$errMsgemail)){
             $id_user = selectOne('users', ['email' => $email]);
             ++$send;
                $mas = [
                    'id_users' => $id_user['id_users'],
                    'text' => $text,
	        	];
               insert('send_email', $mas);
         }else{
            array_push($errMsgemail,"Сообщение отправить не удалось");
         }
        
	}

}else{
	$FIO_users = '';
	$login = '';
	$email = '';
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_email_rassylka'])){
  
   
    $name = selectOne('rassylka',['id_rassylka'=>$_POST['id_rassylka']]);
    $text = trim($_POST['message']);
 
    $caption = $name['name_rassylka'];

   $user_email = Select_email_on_rassylka($_POST['id_rassylka']); //получение email-ов для рассылки
      
   //teste($user_email);

    $send =0;
    $error =0;


    foreach($user_email as $em){
      
        if(request($caption,$text,$em['email'],0,$suc,$errMsgemail)){
            ++$send;


            
            $id_user = selectOne('users', ['email' => $em['email']]);
            $mas = [
                'id_users' => $id_user['id_users'],
                'text' => $text,
                'id_rassylka'=>$_POST['id_rassylka']
            ];
            insert('send_email_rassylka', $mas);

        }else{ ++$error;}
    }
        $temp = "Сообщений отправлено: " . $send .  " Не удалось отправить: " . $error;
        array_push($suc,  $temp );
	

    // echo "Сообщений отправлено: ";
    // echo($send);
    // echo "   Не удалось отправить: ";
    // echo($error);

   
	// $last_row = selectOne('users', ['id_users'=>$id]);

}else{
	$FIO_users = '';
	$login = '';
	$email = '';
}
//сохранение рассылки в личном кабинете
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe-rassylka'])){
  
    $proverka = selectAll('rassylka_sub', ['id_users'=>$_SESSION['id_users']]);
    $rassylka = selectAll('rassylka');

    if($proverka){
        foreach($rassylka as $key=>$rassylka){
            if($_POST[$rassylka['id_rassylka']]){
    
                up_rassylka_sub($_POST[$rassylka['id_rassylka']], $_SESSION['id_users'],1);
            }else{
                $proverka2 = selectOne('rassylka_sub', ['id_users'=>$_SESSION['id_users'],'id_rassylka'=>$rassylka['id_rassylka']]);
              
                if($proverka2){
                     up_rassylka_sub($rassylka['id_rassylka'], $_SESSION['id_users'],0);
                }else{
                    test("1");
                    insert('rassylka_sub',['id_users'=>$_SESSION['id_users'], 'reward'=>0,'id_rassylka'=>$rassylka['id_rassylka']]);
                     if($_POST[$rassylka['id_rassylka']]){
                        up_rassylka_sub($_POST[$rassylka['id_rassylka']], $_SESSION['id_users'],1);
                    }
                }
            }
        }
    }else{
         foreach($rassylka as $key=>$ras){
           insert('rassylka_sub',['id_users'=>$_SESSION['id_users'], 'reward'=>0,'id_rassylka'=>$ras['id_rassylka']]);
        }
        foreach($rassylka as $key=>$ras){
      
            if($_POST[$ras['id_rassylka']]){
                up_rassylka_sub($_POST[$ras['id_rassylka']], $_SESSION['id_users'],1);
            }else{
                up_rassylka_sub($ras['id_rassylka'], $_SESSION['id_users'],0);
            }
        }

    }

    header('location:../../personal.php');   
}

//удаление темы
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){
   
    $id = $_GET['del_id'];
    delete_rassylka_sub($id);
	delete('rassylka',$id);

    header('location:index.php');
    

}else{
	
}

$errMsg=[];

//создание темы
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme-create'])){   //topic-create - name кнопки
    
	$name = trim($_POST['name']);

	if($name === ''){
		array_push($errMsg,"Поле не заполнено!");
	}elseif(mb_strlen($name, 'UTF8')<5){
		array_push($errMsg,"Тема должна быть более 5-x символов");
	}
	else{
        
		$existence = selectOne('rassylka', ['name_rassylka' => $name]);
		if($existence['name_rassylka'] === $name){
			array_push($errMsg,"Такая тема уже существует!");
		}else{
			$theme = [
				'name_rassylka' => $name,
			];
		$id = insert('rassylka',$theme);
		//$topic = selectOne('name_category',['id_name_category' => $id]);
		}
	}

	// $last_row = selectOne('users', ['id_users'=>$id]);
}else{

	$name = '';
}


?>