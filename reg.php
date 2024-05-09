<?php 

include "app/control/users.php";

?>



	<?php include 'app/include/header.php'; ?>




	<div class="container reg_form">
		<form class="row justify-content-center" method="post" action="reg.php">
			<h2>Форма регистрации</h2>

			<div class="mb-3 col-12 col-md-4 err" style="padding: 1rem 0; color: red;">
			
				<?php $success = $suc ?>
				<?php include "app/helps/errorinfo.php"; ?>
			</div>

			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<label for="formGroupExampleInput" class="form-label">ФИО</label>
				<input name="FIO_users" value="<?=$FIO_USERS?>" type="text" class="form-control" id="formGroupExampleInput">
			</div>

			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<label for="exampleInputEmail1" class="form-label">Логин</label>
				<input name="login" value="<?=$lOGIN?>" type="login" class="form-control">
				<div class="form-text">Введите логин.</div>
			</div>

			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">

				<label for="exampleInputEmail1" class="form-label">Email</label>
				<input name="email" value="<?=$EMAIL?>" type="email" class="form-control" id="exampleInputEmail1">
				<div id="emailHelp" class="form-text">Введите email.</div>
				
			</div>
			<div class="w-100"></div>
			<div class="mb-3 col-12 col-md-4">
				<input type="hidden" name="kodvalue" value="<?=$rand?>">
				<input  name="kod" type="input" class="form-control" id="exampleInputEmail1">
				<div id="emailHelp" class="form-text">Введите код</div>
				
			</div>
			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<button type="submit" class="btn btn-primary" name="email-cod">Получить код</button>
			
			</div>
			

			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<label for="exampleInputPassword1" class="form-label">Пароль</label>
				<input name="password" type="password" class="form-control" id="exampleInputPassword1">
			</div>

			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<button type="submit" class="btn btn-secondary" name="button-reg">Регистрация</button>
				<a href="log.php">Войти</a>
			</div>
		</form>
	</div>







	<?php include 'app/include/footer.php'; ?>
