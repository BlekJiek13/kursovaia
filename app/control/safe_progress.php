<?php 
include_once  '/www/wwwroot/boostrap.local/app/db.php';

$contents = selectAll('content_course',['id_courses' => $_POST['id_course']] );


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['safe-prodress'])){


	foreach($contents as $key=> $content){
		
	if(isset($_POST[$content['id_content_course']])){
		$contents[$key]['progress'] = 1; 

		$id_progress_course = selectOne('progress_course',['id_content_course'=>$contents[$key]['id_content_course'],
		'id_users'=>$_SESSION['id_users']]);

		

			update('progress_course',$id_progress_course['id_progress_course'] ,['id_content_course' => $contents[$key]['id_content_course'],
		'id_users' => $_SESSION['id_users'], 'progress' =>  $contents[$key]['progress'],
		'id_courses' => $contents[$key]['id_courses']]);
		
	
	}else{

			$id_progress_course = selectOne('progress_course',['id_content_course'=>$contents[$key]['id_content_course'],
		'id_users'=>$_SESSION['id_users']]);
	
			$contents[$key]['progress'] = 0;
				update('progress_course',$id_progress_course['id_progress_course'] ,['id_content_course' => $contents[$key]['id_content_course'],
		'id_users' => $_SESSION['id_users'], 'progress' =>  $contents[$key]['progress'],
		'id_courses' => $contents[$key]['id_courses']]);
		}

	}

header('location:../../buy_courses.php?id_course=' . $_POST['id_course']);




}







?>