<?php

	include "path.php";
	include  'app/control/personal.php';



// 	   [id_users] => 68
//     [FIO_users] => Шеметов
//     [login] => User1
//     [password] => $2y$10$n198qvjfT9cGdo.o5RB6devndyU8Pty7tu319kEvpUOyiPO3B62Se
//     [email] => 1234@1234
//     [admin] => 0

	$order = selectAll('orders', ['id_users' => $_SESSION['id_users']]);

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
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://kit.fontawesome.com/6209f1fc5a.js" crossorigin="anonymous"></script>
</head>

<body>
<header class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<h1>
						<a href="/">My Course</a>
					</h1>
				</div>
				<nav class="col-8">
					<ul>
						<li><a href="/">Главная</a></li>
						<li><a href="#">О нас</a></li>
						<li><a href="../../courses.php">Курсы</a></li>
						<li><a href="cart.php">Корзина</a></li>
						<li>
							<?php if(isset($_SESSION['id_users'])): ?>
								<a	a href="#">
									<i class="fa-solid fa-user"></i>
									<?php echo $user['login']; ?>
								</a>
								<ul>
									<?php if($_SESSION['admin']): ?>
										<li><a href="../../admin/posts/index.php">Админ панель</a></li>
									<?php else: ?>
										<li><a href="../../personal.php">Кабинет</a></li>
									<?php endif; ?>

									<li><a href="logout.php">Выход</a></li>
									
								</ul>
							<?php else: ?>
								<a	a href="log.php">
									<i class="fa-solid fa-user"></i> Войти
								</a>
								<ul>
									<li><a href="reg.php">Регистрация</a></li>
									
								</ul>
							<?php endif; ?>


							
						</li>
					</ul>
				</nav>
			</div>
		</div>
</header>


	<!-- main -->
<div class="container">
	

<div class="personal">
	<header class="page-header">
		<h1 class="page-title">Личный кабинет <?=$user['login']?></h1>
	</header>
	<div class="row">
		<div class="img col-md-3"> 	<!-- аватар -->
			<img class="img-circle img-responsive" alt="" src="assets/image/user.png">
		</div>
		<div class="col-md-9 mb-4"> <!--данные -->
			<div class="date">
					<?php include "app/helps/errorinfo.php"; ?>
				<form action="personal.php" method="POST" >
			

					<input type="hidden" name="id" value="<?=$user['id_users']?>">
					<div class="col mb-2" style="width: 50%;">
						<label for="formGroupExampleInput" class="form-label">ФИО</label>
						<input name="FIO_users" value="<?=$user['FIO_users']?>" type="text" class="form-control" id="formGroupExampleInput">
					</div>
					<div class="col  mb-2" style="width: 50%;">
						<label for="formGroupExampleInput" class="form-label">Логин</label>
						<input value="<?=$user['login']?>" name="login" type="text" class="form-control" placeholder="login">
					</div>
					<div class="col  mb-2" style="width: 50%;">
						<label for="formGroupExampleInput" class="form-label">email</label>
						<input value="<?=$user['email']?>" readonly name="email" type="text" class="form-control" placeholder="email">
					</div>
					<div class="col mb-2" style="width: 50%;">
							<label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
							<input name="password" type="password" class="form-control" id="exampleInputPassword1">
					</div>

					<div class="col col-6 ">
							<button name="edit_personal" class="btn btn-primary"  type="submit">Изменить</button>
					</div>
				</form>
			</div>
		</div>
	</div>

		
		

		
		
		
	</div>

	</div>
	</div>
    
</div>




<?php  if($order):?>
<section class="main-content">
		<div class="container mt-3">
			<div class="d-flex flex-row">
				<div class="col-4"><h1>Купленные курсы:</h1></div>
				<div class="d-flex align-items-center">
					<form action="pdf.php" method="POST" >								
						<button  name="order_pdf" type="submit" class="btn btn-light">
									<i class="fa-solid fa-download"></i> Выписка о заказах в PDF
						</button>
					</form>
					<form action="google_chart/chart_personal.php" method="POST" style="margin-left: 20px;">								
						<button  name="order_pdf" type="submit" class="btn btn-light">
									<i class="fa-solid fa-chart-column" style="color: #640b56;"></i>  Построить график (затраты на заказы по категориям)
						</button>
					</form>

				</div>
				
			</div>
			
			<div class="row">
				<div class="col-md-12 order-first" >
					
					<div class="row">
						<?php  foreach($order as $id): ?>
						<?php $progress = PercentProgress($id['id_courses'],$id['id_users']); ?>
							<?php $course=selectOne('courses', ['id_courses'=>$id['id_courses']]);?>
							<div class="col-4" style="margin-top: 20px;">
								<div class="product-card">
									<div class="product-thumb">
										<a href="buy_courses.php?id_course=<?=$course['id_courses']?>"><img src="<?='assets/image/courses/' . $course['img'] ?>" alt="<?=$course['name_courses']?>" class="img-thumbnail"></a>
											
									</div>
									<div class="product-details">
										
										<h4><a href="buy_courses.php?id_course=<?=$course['id_courses']?>"><?=$course['name_courses']?></a></h4>
										
											<?=$course['description']?>
										<div class="product-bottom-details d-flex justify-content-between">
											

											<div class="product-progress">
												<h3>Курс пройден на <?=round($progress['progress']*100)?>%</h3>
											</div>
											
											
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					
					

				</div>	

				

			
			</div>
		</div>
		<!-- Форма обратной связи -->
		<div class="container mt-3">
			

				<div class="row">
					<h1 class="personal_email_block" >Форма обратной связи</h1>
					<h1 class="personal_email_block">Рассылка</h1>
				</div>
				
				<div class="row">
					<div class="footer-section contact-form col-md-6 col-12">
						<br>
						<div class="mb-12 col-12 col-md-12 err">
							
						<!-- Вывод массива с ошибками -->
						<?php $errMsg= $errMsgemail?>
						<?php $success= $suc?>
						
							<?php include "app/helps/errorinfo.php"; ?>
						</div>
						<form action="personal.php" method="POST" >
							<div class="col mb-2">
							<label for="formGroupExampleInput" class="form-label">Заголовок письма</label>
							<input name="caption"  type="text" class="form-control" id="formGroupExampleInput">
						</div>
						<div class="col  mb-2">
							<textarea rows="4" name="message" type="text" class="form-control" placeholder="Ваше сообщение"></textarea>
						</div>

							<button id="send_email" name="email" type="submit" class="btn btn-big contact-btn">
								<i class="fas fa-envelope"></i> Отправить
							</button>

						</form>
			
					</div>
					<!-- рассылка -->
					<div class="col-6">
						<div class="col-6 offset-md-4 mt-3">

							<form action="app/control/email.php" method="POST" >
								<?php $rassylka = selectAll('rassylka'); ?>
								
									<?php  foreach($rassylka as $key => $rassylka ): ?>
										
										<?php $rassylka_sub = selectAll('rassylka_sub',['id_users'=>$_SESSION['id_users'],'id_rassylka'=>$rassylka['id_rassylka']]);?>
											<div class="form-check">
												<input type="hidden" name="id_users" value="<?=$_SESSION['id_users']?>">
												<?php  if($rassylka_sub[0]['reward']==1): ?>
													<input name= "<?=$rassylka['id_rassylka']?>" class="form-check-input" type="checkbox" value="<?=$rassylka['id_rassylka']?>" id="flexCheckDefault" checked>
												<?php else:?>
													<input name= "<?=$rassylka['id_rassylka']?>" class="form-check-input" type="checkbox" value="<?=$rassylka['id_rassylka']?>" id="flexCheckDefault">
												<?php endif; ?>
												<label style="margin: 4px 0 10px 5px;" class="form-check-label" for="flexCheckDefault">
													<?=$rassylka['name_rassylka']?>
												</label>
											</div>
										
									<?php endforeach; ?>
									<button  name="safe-rassylka" class="btn btn-primary" type="submit" style="background-color: rgb(172, 142, 255); border-color:rgb(172, 142, 255);" >Сохранить изменение</button>
							</form>
						</div>
					</div>
				</div>
					
				

				
			
		</div>
		
	</section>

</div>
<?php else: ?>
	<div class="container mt-3">
			

				<div class="row">
					<h1 style="margin-top: 40px;width: 50%;text-align: center;" class="personal_email_block" >Форма обратной связи</h1>
					<h1 style="margin-top: 40px;width: 50%;text-align: center;" class="personal_email_block">Рассылка</h1>
				</div>
				
				<div class="row">
					<div class="footer-section contact-form col-md-6 col-12">
						<br>
						<div class="mb-12 col-12 col-md-12 err">
							
						<!-- Вывод массива с ошибками -->
						<?php $errMsg= $errMsgemail?>
						<?php $success= $suc?>
						
							<?php include "app/helps/errorinfo.php"; ?>
						</div>
						<form action="personal.php" method="POST" >
							<div class="col mb-2">
							<label for="formGroupExampleInput" class="form-label">Заголовок письма</label>
							<input name="caption"  type="text" class="form-control" id="formGroupExampleInput">
						</div>
						<div class="col  mb-2">
							<textarea rows="4" name="message" type="text" class="form-control" placeholder="Ваше сообщение"></textarea>
						</div>

							<button id="send_email" name="email" type="submit" class="btn btn-big contact-btn">
								<i class="fas fa-envelope"></i> Отправить
							</button>

						</form>
			
					</div>
					<div class="col-6">
						<div class="col-6 offset-md-4 mt-3">

							<form action="app/control/email.php" method="POST" >
								<?php $rassylka = selectAll('rassylka'); ?>
								
									<?php  foreach($rassylka as $key => $rassylka ): ?>
										
										<?php $rassylka_sub = selectAll('rassylka_sub',['id_users'=>$_SESSION['id_users'],'id_rassylka'=>$rassylka['id_rassylka']]);?>
											<div class="form-check">
												<input type="hidden" name="id_users" value="<?=$_SESSION['id_users']?>">
												<?php  if($rassylka_sub[0]['reward']==1): ?>
													<input name= "<?=$rassylka['id_rassylka']?>" class="form-check-input" type="checkbox" value="<?=$rassylka['id_rassylka']?>" id="flexCheckDefault" checked>
												<?php else:?>
													<input name= "<?=$rassylka['id_rassylka']?>" class="form-check-input" type="checkbox" value="<?=$rassylka['id_rassylka']?>" id="flexCheckDefault">
												<?php endif; ?>
												<label style="margin: 4px 0 10px 5px;" class="form-check-label" for="flexCheckDefault">
													<?=$rassylka['name_rassylka']?>
												</label>
											</div>
										
									<?php endforeach; ?>
									<button  name="safe-rassylka" class="btn btn-primary" type="submit" style="background-color: rgb(172, 142, 255); border-color:rgb(172, 142, 255);" >Сохранить изменение</button>
							</form>

						</div>
							
					
						
					
						
					</div>
					
				</div>
					
				

				
			
		</div>
<?php endif; ?>

	<!-- end main -->













	<!-- FOOTER -->
		<?php include 'app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>