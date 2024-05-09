<?php

include_once  '/www/wwwroot/boostrap.local/app/db.php';

$page_course = trim($_GET['id_course']);

$review='';
$errMsg = [];
$status = 1;
$reviews = [];
$rate=5;

$AllReviewForAdm = selectAllReviewAndLoginForAdm('reviews','users');

// //создания комментария
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goReview'])){  

	$rate = trim($_POST['rate']);
	$id_users = $_POST['id_users'];		
	$review = trim($_POST['review']);
	
	if($review === ''){
		array_push($errMsg, "Поле не заполнено!");
		$AllReviews = selectAllReviewAndLogin('reviews','users',$page_course);
	}elseif(mb_strlen($review, 'UTF8') < 8 ){
		array_push($errMsg,"отзыв должен быть более 8-ми символов");
		$AllReviews = selectAllReviewAndLogin('reviews','users',$page_course);
	}else{
	
		 $existence = selectOne('reviews', ['text_review' => $review]);
		 if($existence['text_review'] === $review){
		 	$AllReviews = selectAllReviewAndLogin('reviews','users',$page_course);
		 }else{
		//формирование массива с постом
		$reviews = [
			'rate'=>$rate,
			'status' => $status,
			'id_courses' => $page_course,
			'id_users' => $id_users,
			'text_review' => $review
		];


		$id = insert('reviews',$reviews);
		$AllReviews = selectAllReviewAndLogin('reviews','users',$page_course);
		//}
		
	}
	
		
	}

}else{
	$comment='';
	if($page_course){
		$AllReviews = selectAllReviewAndLogin('reviews','users',$page_course);
	}	
}


//кнопка публикации
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){   

	$id = $_GET['pub_id'];
	$publish = $_GET['publish'];

	$CommentId = update('reviews',$id , ['status' => $publish]);
	
	header('location: index.php');
}
	
//удаление отзыва
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){   //topic-create - name кнопки
	$id = $_GET['del_id'];
	delete('reviews',$id);
	header('location: index.php');

}else{
}
?>




