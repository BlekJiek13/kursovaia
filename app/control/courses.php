<?php

	include  '/www/wwwroot/boostrap.local/app/db.php';
	//include '../../path.php';


$errMsg = [];
$name_courses = '';
$description='';
$hour = '';
$price= '';
$courses = selectAll('courses');
$articles = selectAll('articles');

$allCourses = selectAll('courses');
$coursePublish = selectAll('courses', ['status' => 1]);
$topics = selectAll('name_category');





//создание курса
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post_courses'])){   //add_post - name кнопки
	
	//получение изображения с формы
	if(!empty($_FILES['img']['name'])){
		
		$imgName = time() . "_" . $_FILES['img']['name'];
		$fileTmpName =  $_FILES['img']['tmp_name'];
		$destination ='/www/wwwroot/boostrap.local/assets/image/courses/' . $imgName;       //путь с названием
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
	

	$name_courses = trim($_POST['title']); 				//заголовок курса
	$description = trim($_POST['description']); //описание курса
	$id_articles = trim($_POST['id_post']); 				//id статьи с выпадающего списка
	$publish = isset($_POST['publish']) ? 1 : 0;
	$price = trim($_POST['price']); 
	$hours = trim($_POST['hours']);
	
	//teste($_POST);
	if($name_courses === '' || $description === '' || $id_articles === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($name_courses, 'UTF8') <5 ){
		array_push($errMsg,"В названии курса должно быть более 5-х символов");
	}elseif(!is_numeric($price)){
		array_push($errMsg,"Введите числовое значение в поле Price");
	}elseif(!is_numeric($hours)){
	 	array_push($errMsg,"Введите числовое значение в поле Hour");
	}elseif(!is_numeric($id_articles)){
		array_push($errMsg,"Выберите статью категорию!");
	}elseif((strpos($filetype, 'image') === false)){
		array_push($errMsg,"Файл не является изображением");
	}
	else{	
		
	
		//формирование массива с постом
		$course = [
			'hours' => $hours,
			'price' => $price,
			'img' => $_POST['img'],
			'name_courses' => $name_courses,
			'description' =>$description,
			'status' => $publish,
			'id_articles' => $id_articles
		];

		
		
	
		

		$id = insert('courses',$course);
		$course = selectOne('courses',['id_courses' => $id]);
		header('location:index.php'); //переход после кнопки на index
		
		
	}

}else{
	$id = '';
	$name_courses = '';
	$description = '';
	$publish = '';
	$id_articles = '';
	
}

//кнопки публикации

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){   
	//teste($_GET);
	$id = $_GET['pub_id'];
	$publish = $_GET['publish'];

	$courseId = update('courses',$id , ['status' => $publish]);
	
	header('location: index.php');
	exit();
	
}

//Редактирование курса

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){    //если в методе GET есть id 
	
	

	$course = selectOne('courses', ['id_courses' => $_GET['id']]);
	//teste($course);
	$id_course = $course['id_courses'];
	$id_articles = $course['id_articles'];
	$name_courses = $course['name_courses'];
	$description = $course['description'];
	$hours = $course['hours'];
	$price = $course['price'];
	$publish = $course['status']; 
	$img = $coursep['img'];

	$articlescname = selectOne('articles' , ['id_articles' => $id_articles] );
	
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_courses'])){   //topic-create - name кнопки

	//teste($_POST);
	$id = $_POST['id'];
	$name_courses = $_POST['title']; 				//заголовок курса
	$description = $_POST['description']; //описание курса
	$id_articles = $_POST['id_post']; 				//id статьи с выпадающего списка
	$publish = isset($_POST['publish']) ? 1 : 0;
	$price = $_POST['price']; 
	$hours = $_POST['hours'];

	
	if(!empty($_FILES['img']['name'])){
		
		$imgName = time() . "_" . $_FILES['img']['name'];
		$fileTmpName =  $_FILES['img']['tmp_name'];
		$destination ='/www/wwwroot/boostrap.local/assets/image/courses/' . $imgName;       //путь с названием
	
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

	if($name_courses === '' || $description === '' || $id_articles === ''){
		array_push($errMsg, "Не все поля заполнены!");
	}elseif(mb_strlen($name_courses, 'UTF8') <5 ){
		array_push($errMsg,"В названии курса должно быть более 5-х символов");
	}elseif(!is_numeric($price)){
		array_push($errMsg,"Введите числовое значение в поле Price");
	}elseif(!is_numeric($hours)){
	 	array_push($errMsg,"Введите числовое значение в поле Hour");
	}elseif(!is_numeric($id_articles)){
		array_push($errMsg,"Выберите статью категорию!");
	}elseif((strpos($filetype, 'image') === false)){
		array_push($errMsg,"Файл не является изображением");
	}
	else{	
		
		//формирование массива с постом
	$course = [
			'hours' => $hours,
			'price' => $price,
			'img' => $_POST['img'],
			'name_courses' => $name_courses,
			'description' => $description,
			'status' => $publish,
			'id_articles' => $id_articles
		];

	    $course = update('courses',$id,$course );
		header('location:index.php'); //переход после кнопки на index
		
	}

}else{

}


//Удаление курса

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){   

	$id = $_GET['delete_id'];
	delete('courses',$id);
	header('location: index.php');

}



//создание курса
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_charts_create'])){   //add_post - name кнопки
	
$course_on_category = course_on_category($_POST['category']);
$name_category = selectOne('name_category',['id_name_category'=>$_POST['category']]);

		
		
	

}else{
	
}




?>