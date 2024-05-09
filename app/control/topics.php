<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';


$errMsg = [];
$id='';
$name = '';

$topics = selectAll('name_category');

//создание категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){   //topic-create - name кнопки

	$name = trim($_POST['name']);

	if($name === ''){
		array_push($errMsg,"Поле не заполнено!");
	}elseif(mb_strlen($name, 'UTF8')<2){
		array_push($errMsg,"Категория должна быть более 2-x символов");
	}
	else{
		$existence = selectOne('name_category', ['name_category' => $name]);
		if($existence['name_category'] === $name){
			array_push($errMsg,"Категория уже существует!");
		}else{
			$topic = [
				'name_category' => $name,
			];
		$id = insert('name_category',$topic);
		$topic = selectOne('name_category',['id_name_category' => $id]);
		}
	}
		header('location: index.php');
	// $last_row = selectOne('users', ['id_users'=>$id]);
}else{

	$name = '';
}



//Редактирование категории

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){   
	
	

	$id = $_GET['id'];
	$topic = selectOne('name_category', ['id_name_category' => $id]);
	$id = $topic['id_name_category'];
	$name = $topic['name_category'];


}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){   //topic-create - name кнопки

	$name = trim($_POST['name']);

	if($name === ''){
		array_push($errMsg,"Поле не заполнено!");
	}
	else{
		$existence = selectOne('name_category', ['name_category' => $name]);
		if($existence['name_category'] === $name){
			array_push($errMsg,"Категория уже существует!");
		}else{

		$topic = [
			'name_category' => $name,
		];
		$id = $_POST['id'];
		$topic = update('name_category',$id , $topic);
		}
	}
	header('location: index.php');

}

//Удаление категории

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){   
	
	$id = $_GET['del_id'];
	delete('name_category',$id);
	header('location: index.php');


}

?>