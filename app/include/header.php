<?php 
	$user_login = selectOne('users', ['id_users' => $_SESSION['id_users']]);
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Blog</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="http://boostrap.local/assets/css/style.css">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
	<link rel="shortcut icon" type="image/png" href="/assets/image/favicon1.png">
</head>

<body>
<header class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<h1>
						<a href="/" style="text-decoration: none;">My Course</a>
					</h1>
				</div>
				<nav class="col-8">
					<ul>
						<li><a href="/">Главная</a></li>
						<!-- <li><a href="#">О нас</a></li> -->
						<li><a href="http://boostrap.local/courses.php">Курсы</a></li>
						<li><a href="http://boostrap.local/chat.php">Чат</a></li>
						<li>
							<?php if(isset($_SESSION['id_users'])): ?>
								<a	a href="#">
									<i class="fa-solid fa-user"></i>
									<?php echo $user_login['login']; ?>
								</a>
								<ul>
									<?php if($_SESSION['admin']): ?>
										<li><a href="http://boostrap.local/admin/posts/index.php">Админ панель</a></li>
									<?php else: ?>
										<li><a href="http://boostrap.local/personal.php">Кабинет</a></li>
									<?php endif; ?>

									<li><a href="http://boostrap.local/logout.php">Выход</a></li>
									
								</ul>
							<?php else: ?>
								<a	a href="log.php">
									<i class="fa-solid fa-user"></i> Войти
								</a>
								<ul>
									<li><a href="http://boostrap.local/reg.php">Регистрация</a></li>
									
								</ul>
							<?php endif; ?>
						</li>
					</ul>
				</nav>
			</div>
		</div>
</header>