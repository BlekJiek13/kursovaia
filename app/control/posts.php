<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';
	//include '../../path.php';


$errMsg = [];
$id='';
$title = '';
$text_articles='';
$topic = '';



$topics = selectAll('name_category');

$posts = selectAll('articles');
$postsAdm = selectAllFromPostsUsers('articles', 'users');

//создание поста
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){   //add_post - name кнопки
	// test($_FILES);
	 //test($_POST);
	

	//получение изображения с формы
	if(!empty($_FILES['img']['name'])){
		
		$imgName = time() . "_" . $_FILES['img']['name'];
		$fileTmpName =  $_FILES['img']['tmp_name'];
		$destination ='/www/wwwroot/boostrap.local/assets/image/posts/' . $imgName;       //путь с названием
		// test($destination);
		// exit();
		//test($_FILES);

		$filetype =  $_FILES['img']['type'];
		// if(strpos($filetype, 'image') === false){
		// 	array_push($errMsg,"Файл не является изображением");
		// }

		$result = move_uploaded_file($fileTmpName,$destination);

		if($result){
			$_POST['img'] = $imgName;
		}else{
			array_push($errMsg,"Ошибка загрузки изображения");
		}
	
	}else{
	
		array_push($errMsg,"Ошибка получения изображения");
	}
	

	$title = trim($_POST['title']); 				//заголовок статьи
	$text_articles = trim($_POST['text_articles']); //текст поста
	$topic = trim($_POST['topic']); 				//id категории с выпадающего списка
	$publish = isset($_POST['publish']) ? 1 : 0;
	

	if($title === '' || $text_articles === '' || $topic === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($title, 'UTF8') <3 ){
		array_push($errMsg,"В названии статьи должно быть более 3-х символов");
	}elseif(!is_numeric($topic)){
		array_push($errMsg,"Выберите категорию!");
	}elseif((strpos($filetype, 'image') === false)){
		array_push($errMsg,"Файл не является изображением");
	}
	else{	
	
		//формирование массива с постом
		$post = [
			'id_category' => $topic,
			//'id_courses' => 0,///////////
			'id_user' => $_SESSION['id_users'],
			'img' => $_POST['img'],
			'title' => $title,
			'text_articles' => $text_articles,
			'status' => $publish
		];

		
		
	
		

		$id = insert('articles',$post);
		$post = selectOne('articles',['id_articles' => $id]);
		header('location:index.php'); //переход после кнопки на index
		
		
	}

}else{
	$id = '';
	$title = '';
	$text_articles = '';
	$publish = '';
	$topic = '';
	
}

//кнопки публикации

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){   
	
	$id = $_GET['pub_id'];
	$publish = $_GET['publish'];

	$postId = update('articles',$id , ['status' => $publish]);
	
	header('location: index.php');
	exit();
	
}

//Редактирование статьи

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){    //если в методе GET есть id 
	
	

	$post = selectOne('articles', ['id_articles' => $_GET['id']]);

	$id_articles = $post['id_articles'];
	$title = $post['title'];
	$text_articles = $post['text_articles'];
	$topic = $post['id_category'];
	$publish = $post['status']; 

	$topicname = selectOne('name_category' , ['id_name_category' => $topic] );
// test($topicname);
// 		exit();

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){   //topic-create - name кнопки


	
	$id_articles = $_POST['id'];
	$title = trim($_POST['title']); 				//заголовок статьи
	$text_articles = trim($_POST['text_articles']); //текст поста
	$topic = trim($_POST['topic']); 				//id категории с выпадающего списка
	$publish = isset($_POST['publish']) ? 1 : 0;

	
if(!empty($_FILES['img']['name'])){
		
		$imgName = time() . "_" . $_FILES['img']['name'];
		$fileTmpName =  $_FILES['img']['tmp_name'];
		$destination ='/www/wwwroot/boostrap.local/assets/image/posts/' . $imgName;       //путь с названием
	
		$filetype =  $_FILES['img']['type'];
		$result = move_uploaded_file($fileTmpName,$destination);

		if($result){
			$_POST['img'] = $imgName;
		}else{
			array_push($errMsg,"Ошибка загрузки изображения");
		}
	
	}else{
	
		array_push($errMsg,"Ошибка получения изображения");
	}
	
	
	
	$filetype =  $_FILES['img']['type'];

	if($title === '' || $text_articles === '' || $topic === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($title, 'UTF8') <3 ){
		array_push($errMsg,"В названии статьи должно быть более 3-х символов");
	}elseif(!is_numeric($topic)){
		array_push($errMsg,"Выберите категорию!");
	}elseif((strpos($filetype, 'image') === false)){
		array_push($errMsg,"Файл не является изображением");
	}
	else{	
	
		//формирование массива с постом
		$post = [
			'id_category' => $topic,
			//'id_courses' => 0,///////////
			'id_user' => $_SESSION['id_users'],
			'img' => $_POST['img'],
			'title' => $title,
			'text_articles' => $text_articles,
			'status' => $publish
		];
		

		$post = update('articles',$id_articles,$post);
		header('location:index.php'); //переход после кнопки на index
		
		
	}

}else{

	$title = $_POST['title'];
	$text_articles = $_POST['text_articles'];
	$publish = isset($_POST['publish']) ? 1 : 0;
	$topic = $_POST['topic'];
	
}


//Удаление статьи

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){   

	$id = $_GET['delete_id'];
	delete('articles',$id);
	header('location: index.php');

}




?>