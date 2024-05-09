<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';

	$content_course = selectAll('content_course');
	$course = selectAll('courses');
	//teste($course);


	$errMsg = [];
	//создание содержания
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contentcourse-create'])){   //add_post - name кнопки
	

	
	$name_item_course = trim($_POST['name']); 				
	$id_course = trim($_POST['id_course']);
	$number =  trim($_POST['number']);		

	if(is_numeric($name_item_course) || $id_course === '' || $number === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($name_item_course, 'UTF8') < 5 ){
		array_push($errMsg,"В названии содержания курса должно быть более 5-х символов");
	}elseif(!is_numeric($number) ){
		array_push($errMsg,"Номер порядка должен содержать целое число > 0 ");
	}else{	
	
		//формирование массива с содержанием

		$content_course = [
			'name_item_course' => $name_item_course,
			'id_courses' => $id_course,
			'number' => $number
		];

		$id = insert('content_course',$content_course);
		header('location:index.php'); //переход после кнопки на index		
	}

}else{
	$name_item_course = '';
	$id_course = '';
	$number = '';
}


//Редактирование категории

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){   
	
	

	$id = $_GET['id'];

	$content_course = selectOne('content_course', ['id_content_course' => $id]);
	$name = $content_course['name_item_course'];
	$id_course = $content_course['id_courses'];
	$name_courses = selectOne('courses', ['id_courses' => $id_course]);


	
	


}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content-edit'])){   //topic-create - name кнопки


	

	$name = trim($_POST['name']);
	$id_course = trim($_POST['id_course']);
	$content_cour =  trim($_POST['content']);
	$weight =  trim($_POST['number']);


	$content = preg_replace("#sandbox=#", "allowfullscreen=", $content_cour);


	if($name === '' || $id_course === ''){
		array_push($errMsg,"Поле не заполнено!");
	}
	else{
		
		$course = [
			'name_item_course' => $name,
			'id_courses' =>$id_course,
			'number'=>$weight,
			'content'=>$content
		];

		$id = $_POST['id'];
		$content_course = update('content_course',$id , $course);
		}
	
	header('location: index.php');

}

//Удаление категории

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){   
	
	$id = $_GET['delete_id'];
	delete('content_course',$id);
	header('location: index.php');
}


?>