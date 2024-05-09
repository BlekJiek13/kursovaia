<?php

include  '/www/wwwroot/boostrap.local/app/db.php';





$content = selectOne('content_course',['id_content_course'=> $_GET['id']]);
$course = selectOne('courses',['id_courses'=>$content['id_courses']]);

$content_future = selectOne('content_course',['number'=>$content['number']+1,'id_courses'=>$content['id_courses']]);
$content_pred = selectOne('content_course',['number'=>$content['number']-1,'id_courses'=>$content['id_courses']]);

$progress_course = selectOne('progress_course',['id_users'=>$_SESSION['id_users'],'id_courses'=>$content['id_courses'],'id_content_course'=>$_GET['id']]);










date_default_timezone_set('Europe/Moscow');
// test($_GET);
$message = AllMessageContentChat($_GET['id']);
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

$count_message = CountMessage('chat_content_course',$_GET['id']);

//кнопка "отправить"
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chat_content-btn'])){

	


	if($_POST['name_send'] && $_POST['id_mess_send']){
		$long = strlen($_POST['name_send']);
	
		$_POST['text']= substr($_POST['text'],$long);


		$text = trim($_POST['text']);

		insert('chat_content_course',['id_users'=> $_SESSION['id_users'], 'text'=> $text, 'id_send'=>$_POST['id_mess_send'],'id_content'=>$_POST['id_content']]);
		header("location:course_mod_content.php?id=".$_POST['id_content']);
		
		exit();

	}

	$text = trim($_POST['text']);

	insert('chat_content_course',['id_users'=> $_SESSION['id_users'], 'text'=> $text,'id_content'=>$_POST['id_content']]);
	header("location:course_mod_content.php?id=".$_POST['id_content']);

}


// попадаем сюда если поставили лайк 
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message_like'])){

	//test($_GET);

	$message = selectOne('chat_content_course',['id'=>$_GET['id_message_like']]);


	//test($message);

	$proverka_dislika = selectOneComment_content_course($_GET['id_message_like'],$_GET['id'],$_SESSION['id_users'],0,-1);

	//test($proverka_dislika);

	$proverka = selectOne('like_dislike_comments',['id_comments'=>$_GET['id_message_like'],'id_users'=>$_SESSION['id_users'], 'like_'=>1,'id_content'=>$_GET['id']]);
	
	//teste($proverka);

	if($proverka){
		update('like_dislike_comments', $proverka['id_like_dislike_comments'],['like_'=>0]);
		header("location:course_mod_content.php?id=".$_GET['id']);
	}else{
		if($proverka_dislika){
			update('like_dislike_comments', $proverka_dislika['id_like_dislike_comments'],['like_'=>1]);
		}else{
			insert('like_dislike_comments',['id_comments'=>$_GET['id_message_like'],'like_' => 1, 'id_users'=>$_SESSION['id_users'],'id_content'=>$_GET['id']]);
		}
		

	}
	header("location:course_mod_content.php?id=".$_GET['id']);

}

// попадаем сюда если поставили дизлайк 
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message_dislike'])){

	$message = selectOne('chat_content_course',['id'=>$_GET['id_message_dislike']]);
	
	$proverka_lika =  selectOneComment_content_course($_GET['id_message_dislike'],$_GET['id'],$_SESSION['id_users'],0,1);


	$proverka = selectOne('like_dislike_comments',['id_comments'=>$_GET['id_message_dislike'],'id_users'=>$_SESSION['id_users'], 'like_'=>-1,'id_content'=>$_GET['id']]);
	
	if($proverka){
		update('like_dislike_comments', $proverka['id_like_dislike_comments'],['like_'=>0]);
		header("location:course_mod_content.php?id=".$_GET['id']);
	}else{
		if($proverka_lika){
			update('like_dislike_comments', $proverka_lika['id_like_dislike_comments'],['like_'=>-1]);
		}else{
			insert('like_dislike_comments',['id_comments'=>$_GET['id_message_dislike'],'like_' => -1, 'id_users'=>$_SESSION['id_users'],'id_content'=>$_GET['id']]);
		}
	}
		header("location:course_mod_content.php?id=".$_GET['id']);
}

//кнопка "ответить"
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_message'])){



	$messag = OneMessageChat_content_course($_GET['id_message'],'chat_content_course',$_GET['id']);
	
	// [id] => 1
    // [id_users] => 85
    // [text] => и правда, они изначально делают даунгрейд как основу. Сразу вспоминается как после Одиссеи вышла Вальгалла, в которой все деньги сожрал дизайн воды и потому на максимальных настройках о полигоны скал можно зарезаться насмерть, чего в той же Одиссее вообще не наблюдалось.По факту просто сборка из модов) Комбез давно уже существует и не раз появлялся здесь, прическа Бладрейн, из нового только оттенок глаз и клыки (Лицо самой Клэр)
    // [id_send] => 
    // [date] => 2023-02-27 23:56:57
	// [login] => YuraF123

	$text_comment = $messag['login'] . ", ";
	$id_com = $messag['id'];

}



if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_del'])){



	$id = $_GET['id_del'];
	delete_chat_content_course($id);
	header("location:course_mod_content.php?id=".$_GET['id']);


}





?>




