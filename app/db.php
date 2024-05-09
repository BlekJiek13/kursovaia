<?php

session_start();

require('connect.php');


function test($value){
	echo '<pre>';
	print_r($value);
	echo '<pre>';
}

function teste($value){
	echo '<pre>';
	print_r($value);
	echo '<pre>';
	exit();
	
}

function dbCheckError($query){
	$errInfo=$query->errorInfo(); //получаем ошибки
	if ($errInfo[0]!== PDO::ERR_NONE) {
		echo $errInfo[2];
		exit();
	}
	return true;
}

function selectAll($table, $params = []){
	global $pdo;
	$sql = "SELECT * FROM $table";

	if (!empty($params)) {
		$i=0;
		foreach($params as $key => $value){
			if(!is_numeric($value))
			{
				$value = "'". $value. "'";
			}
			if($i === 0){
				$sql = $sql . " WHERE $key = $value";

			}else{
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		}
		
	}
	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}

function selectOne($table, $params = []){
	global $pdo;
	$sql = "SELECT * FROM $table";

	if (!empty($params)) {
		$i=0;
		foreach($params as $key => $value){
			if(!is_numeric($value))
			{
				$value = "'". $value. "'";
			}
			if($i === 0){
				$sql = $sql . " WHERE $key = $value";

			}else{
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		}
		
	}

	// $sql = $sql . " LIMIT  1";
	//test($sql);
	

	$query = $pdo->prepare($sql);  // prepare - Подготавливает SQL-запрос к базе данных
	$query->execute(); // execute - Запускает подготовленный запрос(Возвращает true в случае успешного выполнения или false в случае возникновения ошибки. )
	dbCheckError($query);
	
	return $query->fetch();
}

function insert($table,$params){
	global $pdo;
	//$sql = "INSERT INTO $table () VALUES ()";	
	$i=0;
	$coll = '';
	$mask = '';
	foreach($params as $key => $value){
		if($i===0){
			$coll = $coll . "$key";
			$mask = $mask ."'" ."$value". "'";
		}else{
			$coll = $coll . ", $key";
			$mask = $mask .", '" . "$value" . "'";
			
		}
		$i++;
		
	}

	$sql = "INSERT INTO $table ($coll) VALUES ($mask)";	
	 test($sql);


	$query = $pdo->prepare($sql);
	$query->execute($params);
	dbCheckError($query);

	return $pdo->lastInsertId(); //возвращаем id

}

function update($table,$id,$params){
	global $pdo;
	$idNAME='id_' . $table.'';
	$i=0;
	$str = '';
	foreach($params as $key => $value){
		if($i===0){
			$str = $str .$key . " = '" .$value. "'";
		}else{
			$str = $str ." , ".$key . " = '" .$value. "'";
		}
		$i++;
	}
	$sql = "UPDATE $table SET $str WHERE $idNAME = $id";
	
	
//teste($sql);

	$query = $pdo->prepare($sql);
	$query->execute($params);
	dbCheckError($query);
}



function delete($table,$id){
	global $pdo;
		//DELETE FROM `users` WHERE `users`.`id_users` = 32 
	$idname = 'id' . "_". $table; 
	$sql = "DELETE FROM $table WHERE $idname = $id";

	//teste($sql);
	
	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
}


function delete_chat_content_course($id){
	global $pdo;


	$sql = "DELETE FROM chat_content_course WHERE id = $id";

	//teste($sql);
	
	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);

}


//Выборка записей с автором в админку

function selectAllFromPostsUsers($table1,$table2){
	global $pdo;

	$sql = "SELECT

	 t1.id_articles,
	 t1.id_category,
	 t1.title,
	 t1.img,
	 t1.text_articles,
	 t1.status,
	 t1.date_articles,
	 t2.login
	 
	 FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id_users";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

//Выборка записи с автором на single.php
function selectAOneFromPostsUsersIndex($table1,$table2, $id){
	global $pdo;

	$sql = "SELECT p.*, u.login FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id_users WHERE p.id_articles = $id";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}

//Выборка записи с автором на single_course.php


//Выборка записей с автором на главную
function selectAllFromPostsUsersIndex($table1,$table2, $limit, $offset){
	global $pdo;

	$sql = "SELECT p.*, u.login FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id_users WHERE p.status = 1 LIMIT $limit OFFSET $offset";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


//Поиск по курсам
function searchInTitle($text,$table1,$table2){
	global $pdo;
	$text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));


	$array_text =[]; 
	$tok = strtok($text," \t\n");

	while($tok){
		$array_text[] =$tok;
		$tok = strtok(" \t\n");
	}

	$i=0;
	$sql_and = '';

	foreach($array_text as $key => $value){
		if($i===0){
			$sql_and = $sql_and . " p.title LIKE" . "'%". $value ."%'". ' ';
		}else{
			$sql_and = $sql_and ." OR p.title LIKE" . "'%". $value ."%'". ' ';
		}
		$i++;
	}


	$sql = "SELECT 
	p.*, u.login FROM 
	$table1 AS p 
	JOIN $table2 AS u 
	ON p.id_user = u.id_users 
	WHERE p.status = 1
	AND $sql_and";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

function searchInCourse($text,$table1){
	global $pdo;
	$text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));


	$array_text =[]; 
	$tok = strtok($text," \t\n");

	while($tok){
		$array_text[] =$tok;
		$tok = strtok(" \t\n");
	}

	$i=0;
	$sql_and = '';

	foreach($array_text as $key => $value){
		if($i===0){
			$sql_and = $sql_and . " courses.name_courses LIKE" . "'%". $value ."%'". ' ';
		}else{
			$sql_and = $sql_and ." OR courses.name_courses LIKE" . "'%". $value ."%'". ' ';
		}
		$i++;
	}


	$sql = "SELECT * FROM $table1 WHERE status=1 AND $sql_and";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


//Поиск по контенту
function searchInContent($text,$table1,$table2){
	global $pdo;
	$text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));

	$array_text =[]; 
	$tok = strtok($text," \t\n");

	while($tok){
		$array_text[] =$tok;
		$tok = strtok(" \t\n");
	}

	$i=0;
	$sql_and = '';

	foreach($array_text as $key => $value){
		if($i===0){
			$sql_and = $sql_and . " p.text_articles LIKE" . "'%". $value ."%'". ' ';
		}else{
			$sql_and = $sql_and ." OR p.text_articles LIKE" . "'%". $value ."%'". ' ';
		}
		$i++;
	}


	$sql = "SELECT 
	p.*, u.login FROM 
	$table1 AS p 
	JOIN $table2 AS u 
	ON p.id_user = u.id_users 
	WHERE p.status = 1
	AND $sql_and ";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

//Поиск по заголовкам и содержимому
function searchInTitleAndContent($text,$table1,$table2){
	global $pdo;
	$text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));



	$array_text =[]; 
	$tok = strtok($text," \t\n");

	while($tok){
		$array_text[] =$tok;
		$tok = strtok(" \t\n");
	}

	$i=0;
	$sql_and = '';

	foreach($array_text as $key => $value){
		if($i===0){
			$sql_and = $sql_and . "p.title LIKE " . "'%". $value ."%'". ' '. ' OR p.text_articles LIKE ' . "'%". $value ."%'". ' ';
		}else{
			$sql_and = $sql_and ." OR p.title LIKE " . "'%". $value ."%'". ' ' ." OR p.text_articles LIKE " . "'%". $value ."%'";
		}
		$i++;
	}


	$sql = "SELECT 
	p.*, u.login FROM 
	$table1 AS p 
	JOIN $table2 AS u 
	ON p.id_user = u.id_users 
	WHERE p.status = 1
	AND $sql_and ";
	
	

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

//Поиск по заголовкам и содержимому
function countRow($table){
	global $pdo;
	
	$sql = "SELECT COUNT(*) FROM $table WHERE status=1";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchColumn();
}

function selectAllCommentAndLoginForAdm($table1,$table2){
	global $pdo;

	$sql = "SELECT c.*, u.login FROM $table1 AS c JOIN $table2 AS u ON c.email = u.email";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function selectAllReviewAndLoginForAdm($table1,$table2){
	global $pdo;

	$sql = "SELECT r.*, u.login FROM $table1 AS r JOIN $table2 AS u ON r.id_users = u.id_users";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



//Выборка записей с автором на главную
function selectAllCommentAndLogin($table1,$table2, $page){
	global $pdo;

	$sql = "SELECT c.*, u.login FROM $table1 AS c JOIN $table2 AS u ON c.email = u.email WHERE c.status = 1 AND c.page = $page ";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


//Выборка всех отзывов по курсу
function selectAllReviewAndLogin($table1,$table2, $page){
	global $pdo;

	$sql = "SELECT r.*, u.login FROM $table1 AS r JOIN $table2 AS u ON r.id_users = u.id_users WHERE r.status = 1 AND r.id_courses = $page ";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



//среднеее значения рейтинга
function AvgRate($id_course){
	global $pdo;

	$sql = "SELECT sum(rate)/(SELECT count(id_reviews) FROM reviews 
	WHERE id_courses=$id_course) AS `AvgRate` FROM reviews WHERE id_courses=$id_course";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}



//Выборка всех среднего значения рейтинга
function PercentProgress($id_course,$id_users){
	global $pdo;

	$sql = "SELECT sum(progress)/(SELECT count(id_progress_course)
	 FROM progress_course WHERE id_courses=$id_course and id_users=$id_users)
	 AS `progress` FROM progress_course WHERE id_courses=$id_course and id_users=$id_users;";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}


//Подсчет купленных курсов
function ColVoBuyCourse($id_course){
	global $pdo;

	$sql = "SELECT count(id_orders) AS buy FROM orders WHERE id_courses=$id_course ;";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}

//Вывод всех email адресов
function AllEmailUsers(){
	global $pdo;
	$sql = "SELECT email FROM users";

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}

//изменение в таблице rassylka_sub
function up_rassylka_sub($id_rassylka,$id_users,$reward){
	global $pdo;

	$sql = "UPDATE rassylka_sub SET reward = '$reward' WHERE id_rassylka = $id_rassylka and id_users=$id_users";
	
	// test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
}



//Выборка всех отзывов по курсу
function selectAllRassylka_sub(){
	global $pdo;

	$sql = "SELECT rassylka.name_rassylka, rassylka_sub.* FROM rassylka JOIN rassylka_sub ON rassylka.id_rassylka=rassylka_sub.id_rassylka ";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



// function select_name_rassylka($id){
// 	global $pdo;

// 	$sql = "SELECT name_rassylka FROM rassylka WHERE id_rassylka=$id";

// 	//teste($sql);
// 	$query = $pdo->prepare($sql);
// 	$query->execute();
// 	dbCheckError($query);
// 	return $query->fetch();
// }



function Select_email_on_rassylka($id){
	global $pdo;

	$sql = " select email from users join (select id_users from rassylka_sub where id_rassylka=$id and reward=1 group by id_users) AS d where users.id_users=d.id_users";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function countidrassylka($id){
	global $pdo;

	$sql = " select count(id_rassylka) as count from send_email_rassylka where id_rassylka=$id";

	//test($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

function delete_rassylka_sub($id_rassylka){
	global $pdo;

	$sql = "DELETE FROM rassylka_sub WHERE id_rassylka=$id_rassylka";

	//test($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function proverkaPodpishikov($id_rassylka){
	
	global $pdo;

	$sql = "select count(id_users) as count from rassylka_sub where id_rassylka=$id_rassylka and reward=1";

	//test($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function AllMessageChat(){
	
	global $pdo;

	$sql = "SELECT chat.*, users.login from chat join users on chat.id_users=users.id_users WHERE chat.id_send IS NULL;";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

function AllMessageContentChat($id_content){
	
	global $pdo;

	$sql = "SELECT chat_content_course.*, users.login from chat_content_course join users on chat_content_course.id_users=users.id_users WHERE chat_content_course.id_send IS NULL and chat_content_course.id_content=$id_content;";

	//test($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function OneMessageChat($id,$table){
	
	global $pdo;

	$sql = "SELECT $table.*, users.login from $table join users on $table.id_users=users.id_users WHERE $table.id=$id;";

	//test($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}


function OneMessageChat_content_course($id,$table,$id_content){
	
	global $pdo;

	$sql = "SELECT $table.*, users.login from $table join users on $table.id_users=users.id_users WHERE $table.id=$id and $table.id_content=$id_content;";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}



//выбор комментария с like=0||1||-1
function selectOneComment($id_comments,$id_users,$a,$b){
	global $pdo;
	$sql = "SELECT * FROM like_dislike_comments WHERE id_comments=$id_comments AND id_users=$id_users AND (like_=$a OR like_=$b) ";

	//test($sql);
	$query = $pdo->prepare($sql);  // prepare - Подготавливает SQL-запрос к базе данных
	$query->execute(); // execute - Запускает подготовленный запрос(Возвращает true в случае успешного выполнения или false в случае возникновения ошибки. )
	dbCheckError($query);
	
	return $query->fetch();
}

function selectOneComment_content_course($id_comments,$id_content,$id_users,$a,$b){
	global $pdo;
	$sql = "SELECT * FROM like_dislike_comments WHERE id_comments=$id_comments AND id_users=$id_users AND (like_=$a OR like_=$b) AND id_content=$id_content ";

	//test($sql);
	$query = $pdo->prepare($sql);  // prepare - Подготавливает SQL-запрос к базе данных
	$query->execute(); // execute - Запускает подготовленный запрос(Возвращает true в случае успешного выполнения или false в случае возникновения ошибки. )
	dbCheckError($query);
	
	return $query->fetch();
}


//подсчет количества лайков 
function count_like($id_comments){
	global $pdo;
	$sql = "SELECT count(like_) as `like` FROM like_dislike_comments WHERE like_=1 and id_comments=$id_comments;) ";

	//test($sql);
	$query = $pdo->prepare($sql);  // prepare - Подготавливает SQL-запрос к базе данных
	$query->execute(); // execute - Запускает подготовленный запрос(Возвращает true в случае успешного выполнения или false в случае возникновения ошибки. )
	dbCheckError($query);
	
	return $query->fetch();
}
function count_like_content_course($id_comments,$id_content){
	global $pdo;
	$sql = "SELECT count(like_) as `like` FROM like_dislike_comments WHERE like_=1 and id_comments=$id_comments and id_content=$id_content ";

	//test($sql);
	$query = $pdo->prepare($sql);  // prepare - Подготавливает SQL-запрос к базе данных
	$query->execute(); // execute - Запускает подготовленный запрос(Возвращает true в случае успешного выполнения или false в случае возникновения ошибки. )
	dbCheckError($query);
	
	return $query->fetch();
}
//подсчет количества лайков
function count_dislike($id_comments){
	global $pdo;
	$sql = "SELECT count(like_) as `dislike` FROM like_dislike_comments WHERE like_=-1 and id_comments=$id_comments;) ";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute(); 
	dbCheckError($query);
	
	return $query->fetch();
}
function count_dislike_content_course($id_comments,$id_content){
	global $pdo;
	$sql = "SELECT count(like_) as `dislike` FROM like_dislike_comments WHERE like_=-1 and id_comments=$id_comments and id_content=$id_content ";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute(); 
	dbCheckError($query);
	
	return $query->fetch();
}

function output_send_message($id_send){
	global $pdo;
	$sql = "select * from chat where id_send =$id_send;";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}

function output_send_message_content_course($id_send){
	global $pdo;
	$sql = "select * from chat_content_course where id_send =$id_send;";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}


function output_send_content_message($id_send){
	global $pdo;
	$sql = "select * from chat_content_course where id_send =$id_send;";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}

// из id__users ---> login
function FromIDtoLogin($id_users){
	global $pdo;
	$sql = "select login from users where id_users =$id_users;";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetch();
}



// из id_message --> login кто это сообщение написал
function FromID_MessagetoLogin($id_message,$table){
	global $pdo;
	$sql = "select login from users where id_users =(select id_users from $table where id=$id_message);";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetch();
}



//вывод комментариев с количеством лайков в порядке от большего к меньшему
function AllMessageChatWithLike(){
	global $pdo;
	$sql = "SELECT chat.*, users.login,`like` 
			FROM chat 
			JOIN users  ON chat.id_users=users.id_users 
			LEFT JOIN (SELECT id_comments,count(like_) as `like` FROM like_dislike_comments WHERE like_=1 group by id_comments) l 
			ON chat.id=l.id_comments
			WHERE chat.id_send IS NULL
			ORDER BY `like` DESC
	";

	//test($sql);
	$query = $pdo->prepare($sql); 
	$query->execute();
	dbCheckError($query);
	
	return $query->fetchAll();
}

//вывод комментариев с сортировкой по дате (сначала новые)
function AllMessageChatNew(){
	
	global $pdo;

	$sql = "SELECT chat.*, users.login from chat join users on chat.id_users=users.id_users WHERE chat.id_send IS NULL ORDER BY chat.date DESC;";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

//вывод комментариев с сортировкой по дате (сначала старые)
function AllMessageChatOld(){
	
	global $pdo;

	$sql = "SELECT chat.*, users.login from chat join users on chat.id_users=users.id_users WHERE chat.id_send IS NULL ORDER BY chat.date;";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



//подсчет комментариев
function CountMessage_chat($table){
	
	global $pdo;

	$sql = "SELECT count(id) as count FROM $table ;";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}
function CountMessage($table,$id_content){
	
	global $pdo;

	$sql = "SELECT count(id) as count FROM $table WHERE id_content=$id_content;";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}



//подсчет комментариев
function Logins_Put_Likes($id_comments, $a){
	
	global $pdo;

	$sql = "select login from users JOIN (select id_users from like_dislike_comments WHERE like_=$a 
	and id_comments=$id_comments) a  ON users.id_users=a.id_users;";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}

function Logins_Put_Likes_content_course($id_comments, $a,$id_content){
	
	global $pdo;

	$sql = "select login from users JOIN (select id_users from like_dislike_comments WHERE like_=$a 
	and id_comments=$id_comments and id_content=$id_content) a  ON users.id_users=a.id_users;";

		//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



//минимальная дата заказа
function Min_Order(){
	
	global $pdo;

	$sql = "select MIN(date) as date from orders";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}

function Max_Order(){
	
	global $pdo;

	$sql = "select MAX(date) as date from orders";

	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}


function OutPut_orders_ByOrder_date($min,$max,$month,$year){
	
	global $pdo;

	$sql = "SELECT * FROM `orders`
	JOIN courses ON orders.id_courses=courses.id_courses
	JOIN users ON orders.id_users=users.id_users  
	WHERE (date BETWEEN ".$min." AND ".$max." ) AND MONTH(date)=$month AND YEAR(date)=$year";

	//test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchALL();
}


function sum_orders_on_month($min,$max){
	
	global $pdo;

	$sql = "SELECT MONTH(orders.date) as month ,YEAR(orders.date) as year, SUM(courses.price) as sum FROM `orders`
	JOIN courses ON orders.id_courses=courses.id_courses
	JOIN users ON orders.id_users=users.id_users  
	WHERE (date BETWEEN ".$min." AND ".$max." ) group by month,year order by year, month
	";

	//teste($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchALL();
}




function price_course($id){
	
	global $pdo;

	$sql = "SELECT price FROM courses WHERE `id_courses`=$id";

	//test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
}



function course_on_category($id){
	
	global $pdo;

	$sql = "SELECT a.* FROM (SELECT c.*, a.id_category FROM courses c
    JOIN articles a ON c.id_articles=a.id_articles) a WHERE id_category=$id";

	//test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}



function user_costs_by_category($id_users){
	
	global $pdo;

	$sql = "SELECT a.id_category,a.name_category, SUM(a.price) as Sum FROM (SELECT a.*,b.price,b.id_category,name_category.name_category FROM 
		(SELECT id_courses,id_users FROM orders WHERE id_users= $id_users) a
		JOIN (SELECT c.id_courses,c.price, a.id_category FROM courses c JOIN articles a ON c.id_articles=a.id_articles) b
		ON a.id_courses=b.id_courses
		JOIN name_category 
		ON b.id_category=name_category.id_name_category) a group by a.id_category
	";

	//test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}






function kolvo_reg_users_on_week($min,$max){
	
	global $pdo;

	$sql = "SELECT COUNT(id_users) as count, WEEK(date_users) as week,
	YEAR(date_users) as year, date_users FROM `users` 
	WHERE (date_users BETWEEN ".$min." AND ".$max." )
	GROUP BY week,year 
	
	ORDER BY year(date_users),month(date_users), day(date_users)
	";

	//  test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }


 function kolvo_orders_on_week($min,$max){
	
	global $pdo;

	$sql = "SELECT COUNT(id_orders) as count, WEEK(date) as week,
	YEAR(date) as year, date FROM `orders` 
	WHERE (date BETWEEN ".$min." AND ".$max." )	
	GROUP BY WEEK(date),year 	
	ORDER BY year(date),month(date), day(date)
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }




  function bubbly_chart_parametr(){
	
	global $pdo;

	$sql = "SELECT courses.name_courses, courses.price, d.buy, (d.buy*courses.price) as profit 
	FROM (SELECT count(id_orders) as buy,id_courses FROM orders group by id_courses) d
	JOIN courses ON d.id_courses=courses.id_courses 
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }


  function calendar_chart_parametr(){
	
	global $pdo;

	$sql = "SELECT YEAR(date) as year,MONTH(date) as month,DAY(date) as day, count(id_orders) as count
	 FROM orders group by DATE(date)
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }

 
  function sanky_chart_parametr(){
	
	global $pdo;

	$sql = "SELECT name_courses, articles.title, articles.id_category, name_category.name_category 
		from courses 
		JOIN articles ON courses.id_articles=articles.id_articles 
		JOIN name_category ON articles.id_category=name_category.id_name_category
		group by id_courses 
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }


   function timeline_chart_parametr(){
	
	global $pdo;

	$sql = "SELECT YEAR(MIN(date)) as year_min, MONTH(MIN(date)) as month_min,DAY(MIN(date)) as day_min,courses.name_courses,YEAR(MAX(date)) as year_max, MONTH(MAX(date)) as month_max ,DAY(MAX(date)) as day_max
FROM orders JOIN courses ON courses.id_courses=orders.id_courses group by orders.id_courses
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }


  
  function count_user(){
	
	global $pdo;

	$sql = "SELECT count(id_users) FROM `users` 
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();
 }



  function content_course($id){
	
	global $pdo;

	$sql = "SELECT * FROM content_course WHERE id_courses=$id order by number
	";

	//   test($sql);

	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
 }



 function allchat_on_content($id_content){
	global $pdo;

	$sql = "SELECT chat_content_course.*,users.login from chat_content_course
		JOIN users ON chat_content_course.id_users=users.id_users
		where id_content=$id_content";

	//teste($sql);
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetchAll();
}


function idcontent_on_id_chat($id){
	global $pdo;


	$sql = "SELECT id_content FROM `chat_content_course` WHERE id= $id";

	//test($sql);
	
	
	$query = $pdo->prepare($sql);
	$query->execute();
	dbCheckError($query);
	return $query->fetch();

}





?>