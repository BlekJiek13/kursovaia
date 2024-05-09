<?php

	include_once  '/www/wwwroot/boostrap.local/app/db.php';

$page =trim($_GET['id_articles']);
$comment='';
$errMsg = [];
$status = 1;
$comments = [];

$AllCommentsForAdm = selectAllCommentAndLoginForAdm('comments_articles','users');

if($_GET['id']){
	$all_chat_content = allchat_on_content($_GET['id']);
}




//создания комментария
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){  
	

	$email = $_SESSION['email']; 			
	$comment = trim($_POST['comment']);


	if(empty($_SESSION['email'])){
		array_push($errMsg, "Комментарии могут оставлять только зарегистрированные пользователи!");
		$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
	}elseif($comment === ''){
		array_push($errMsg, "Поле не заполнено!");
		$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
	}elseif(mb_strlen($comment, 'UTF8') < 8 ){
		array_push($errMsg,"Комментарий должен быть более 8-х символов");
		$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
	}else{
	


		$existence = selectOne('comments_articles', ['comment' => $comment]);
		if($existence['comment'] === $comment){
			$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
		}else{
		//формирование массива с постом
		$comments = [
			'status' => $status,
			'page' => $page,
			'email' => $email,
			'comment' => $comment
		];


		$id = insert('comments_articles',$comments);
		$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
		}
		
		
		
		
	}

}else{

		$comment='';
	if(!empty($page)){
		//получаем все комментарии методом GET
		
		$AllComments = selectAllCommentAndLogin('comments_articles','users',$page);
	}

		
}


//кнопки публикации

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){   

	$id = $_GET['pub_id'];
	$publish = $_GET['publish'];

	$CommentId = update('comments_articles',$id , ['status' => $publish]);
	
	header('location: index.php');
	exit();
}
	
//Редактирование комментария

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){    //если в методе GET есть id 

	//teste($_GET);

	$comments = selectOne('comments_articles', ['id_comments_articles' => $_GET['id']]);
	$login = selectOne('users', ['email' => $comments['email']]);
	
	//teste($login['login']); - логин 

	$id_comments_articles = $comments['id_comments_articles'];
	$text = $comments['comment'];

	$publish = $comments['status'];

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){    //если в методе GET есть id 

	//teste($_POST);

	$id = $_POST['id'];
	$text = $_POST['comment'];

	if($text === ''){
		array_push($errMsg, "Поле не заполнено!");
	}elseif(mb_strlen($text,'UTF-8') < 8 ) {
		array_push($errMsg, "Комментарий меньше 8 символов!");
	}
	else{	
	
		//teste(mb_strlen($text,'UTF-8'));
	
		//формирование массива с постом
		$com = [
			'comment' => $text
		];



		$comment = update('comments_articles',$id , $com);
		
		header('location:index.php');
		
		
	}
}else{
	
}




//удаление комментария
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){   //topic-create - name кнопки


	
	$id = $_GET['del_id'];
	delete('comments_articles',$id);
	header('location: index.php');

}else{


}

//удаление комментария у содержания
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id_content_course'])){   //topic-create - name кнопки

	
	
	$id = $_GET['del_id_content_course'];
	$id_get = idcontent_on_id_chat($id);



	delete_chat_content_course($id);


	header("location: edit.php?id=". $id_get['id_content']);

}else{


}







?>




