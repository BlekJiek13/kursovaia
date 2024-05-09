
if(!empty($_FILES['img']['name'])){
		
		$imgName = time() . "_" . $_FILES['img']['name'];
		$fileTmpName =  $_FILES['img']['tmp_name'];
		$destination ="assets\image\posts\\" . $imgName;       //путь с названием
		//test($destination);
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

