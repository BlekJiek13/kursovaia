<?php 

include "app/control/users.php";

?>



	<!--header -->
	<?php include 'app/include/header.php'; ?>
	<!--end header-->

	<!-- form-->

	<div class="container reg_form">
		<form class="row justify-content-center" style="margin-bottom: 15rem;" method="post" action="log.php">
			<h2 class="col-12">Авторизация</h2>


				<div class="mb-3 col-12 col-md-4 err" style="padding: 1rem 0; color: red;">
					<!-- Вывод массива с ошибками -->

						<?php include "app/helps/errorinfo.php"; ?>
				</div>

			
			<div class="w-100"></div>

				<div class="mb-3 col-12 col-md-4">
				<label for="exampleInputEmail1" class="form-label">Email</label>
				<input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1">
				<div id="emailHelp" class="form-text">Введите email.</div>
			</div>

			<div class="w-100"></div>
			<div class="mb-3 col-12 col-md-4">
				<label for="exampleInputPassword1" class="form-label">Пароль</label>
				<input name="password" type="password" class="form-control" id="exampleInputPassword1">
			</div>
			<div class="w-100"></div>

			<div class="mb-3 col-12 col-md-4">
				<button type="submit" class="btn btn-secondary" name="button-log">Отправить</button>
				<a href="reg.php">Регистрация</a>
			</div>
		</form>
	</div>


	<!-- end form -->




	<!-- FOOTER -->
	<?php include 'app/include/footer.php'; ?>
	<!-- footer -->