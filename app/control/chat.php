<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';

	date_default_timezone_set('Europe/Moscow');

$message = AllMessageChat();
date_norm($message);

$month = [
	"1" => 'января',"2" => 'февраля',"3" => 'марта',"4" => 'апреля',
	"5" => 'мая',"6" => 'июня',"7" => 'июля',"8"=>'августа',
	"9"=> 'сентября',"10"=> 'октября',"11"=>'ноября',"12"=>'декабря'
	];


function date_norm(&$message){

	$month = [
	"1" => 'января',"2" => 'февраля',"3" => 'марта',"4" => 'апреля',
	"5" => 'мая',"6" => 'июня',"7" => 'июля',"8"=>'августа',
	"9"=> 'сентября',"10"=> 'октября',"11"=>'ноября',"12"=>'декабря'
	];
	
	foreach ($message as $key=> $mes){ //замена даты на месяц + время
	
	$date = time();
	$date_new = date(time());
	
	$date_post=strtotime($message[$key]['date']) ; //большое число в секундах когда был опубликован комментарий

	$time='';
	$temp = explode(" ",$mes['date']);
	$time = substr($temp[1],0,-3);
	$proshlo = $date_new-$date_post; // пройденное кол-во секунд с поста до сегодняшнее время
	
	//$today = date(" H:i:s "); //время сейчас 
	$today_in_sec = date("H") * 3600 + date("i")*60 + date("s"); // сколько секунд с 00:00 прошло сегодня
	// test('Время на данный момент = ' . $today_in_sec);
	// test('Время прошло со времени комментрия = '.$proshlo );
	// teste($message);

	if(($proshlo<$today_in_sec)){
		$message[$key]['date']= ' сегодня в ' . $time ;
	}elseif($proshlo<($today_in_sec+86400)){
		$message[$key]['date']= ' вчера в ' . $time ;
	}else{
		$message[$key]['date']=$mes['date'][8]. "" .  $mes['date'][9] .' ' . $month[$mes['date'][6]] . ' ' . $time ;
	}


	
}
}


$name_order = 'Выбор сортировки';

$text_comment='';
$id_com='';

$count_message = CountMessage_chat('chat');

//кнопка "отправить"
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chat-btn'])){

	

	
	if(!$_SESSION){
		header("location:../../log.php");
		exit();
	}

	if($_POST['name_send'] && $_POST['id_mess_send']){
		$long = strlen($_POST['name_send']);
	
		$_POST['text']= substr($_POST['text'],$long);


		$text = trim($_POST['text']);

		insert('chat',['id_users'=> $_SESSION['id_users'], 'text'=> $text, 'id_send'=>$_POST['id_mess_send']]);
		header("location:../../chat.php");
		
		exit();

	}





	

	$text = trim($_POST['text']);

	insert('chat',['id_users'=> $_SESSION['id_users'], 'text'=> $text]);
	header("location:../../chat.php");

}


// попадаем сюда если поставили лайк 
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message_like'])){

	if(!$_SESSION){
		header("location:../../log.php");
		exit();
		
	}
	$message = selectOne('chat',['id'=>$_GET['id_message_like']]);


	$proverka_dislika = selectOneComment($_GET['id_message_like'],$_SESSION['id_users'],0,-1);


	$proverka = selectOne('like_dislike_comments',['id_comments'=>$_GET['id_message_like'],'id_users'=>$_SESSION['id_users'], 'like_'=>1]);
	
	if($proverka){
		update('like_dislike_comments', $proverka['id_like_dislike_comments'],['like_'=>0]);
		header("location:../../chat.php");
	}else{
		if($proverka_dislika){
			update('like_dislike_comments', $proverka_dislika['id_like_dislike_comments'],['like_'=>1]);
		}else{
			insert('like_dislike_comments',['id_comments'=>$_GET['id_message_like'],'like_' => 1, 'id_users'=>$_SESSION['id_users']]);
		}
		

	}
			header("location:../../chat.php");

}

// попадаем сюда если поставили дизлайк 
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message_dislike'])){

	if(!$_SESSION){
		header("location:../../log.php");
		exit();
	}
	$message = selectOne('chat',['id'=>$_GET['id_message_dislike']]);
	
	$proverka_lika = selectOneComment($_GET['id_message_dislike'],$_SESSION['id_users'],0,1);


	$proverka = selectOne('like_dislike_comments',['id_comments'=>$_GET['id_message_dislike'],'id_users'=>$_SESSION['id_users'], 'like_'=>-1]);
	
	if($proverka){
		update('like_dislike_comments', $proverka['id_like_dislike_comments'],['like_'=>0]);
		header("location:../../chat.php");
	}else{
		if($proverka_lika){
			update('like_dislike_comments', $proverka_lika['id_like_dislike_comments'],['like_'=>-1]);
		}else{
			insert('like_dislike_comments',['id_comments'=>$_GET['id_message_dislike'],'like_' => -1, 'id_users'=>$_SESSION['id_users']]);
		}
	}
		header("location:../../chat.php");
}

//кнопка "ответить"
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message'])){



	$messag = OneMessageChat($_GET['id_message'],'chat');

	// [id] => 1
    // [id_users] => 85
    // [text] => и правда, они изначально делают даунгрейд как основу. Сразу вспоминается как после Одиссеи вышла Вальгалла, в которой все деньги сожрал дизайн воды и потому на максимальных настройках о полигоны скал можно зарезаться насмерть, чего в той же Одиссее вообще не наблюдалось.По факту просто сборка из модов) Комбез давно уже существует и не раз появлялся здесь, прическа Бладрейн, из нового только оттенок глаз и клыки (Лицо самой Клэр)
    // [id_send] => 
    // [date] => 2023-02-27 23:56:57
	// [login] => YuraF123

	$text_comment = $messag['login'] . ", ";
	$id_com = $messag['id'];

}


//кнопка "популярные комментарии"
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['popular'])){
	$message = AllMessageChatWithLike();
	date_norm($message);
	$name_order = 'Сначала популярные';
}

//кнопка "сначала новые комментарии"
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['new'])){
	$message = AllMessageChatNew();
	date_norm($message);
	$name_order = 'Сначала новые';
}

//кнопка "сначала старые комментарии"
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['old'])){
	$message = AllMessageChatOld();
	date_norm($message);
	$name_order = 'Сначала старые';
}


?>