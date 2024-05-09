<?php session_start(); 

	include '../../app/control/users.php';


?>

	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">

		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				<div class="button row">
					<a href="create.php" class="col-2 btn btn-success">Создать</a>
					<span class="col-1"></span>
					<a href="index.php" class="col-3 btn btn-warning">Редактировать</a>
				</div>
				<div class="row title-table  mb-4">
					<h2>Редактирование пользователя</h2>
					
				</div>
				<div class="row add-post">
					<form action="edit.php" method="POST" style="width: 50%; margin-left: auto; margin-right: auto;">
						

						<input type="hidden" name="id" value="<?=$id_users?>">
						
						
						<!-- Вывод массива с ошибками -->
						<div class="mb-12 col-12 col-md-12 err">
							<?php include "../../app/helps/errorinfo.php"; ?>
						</div>
						<!-- Вывод массива с ошибками -->
					
							<div class="col mb-4">
								<label for="formGroupExampleInput" class="form-label">ФИО</label>
								<input name="FIO_users" value="<?=$FIO_users?>" type="text" class="form-control" id="formGroupExampleInput">
							</div>

							<div class="col mb-4">
								<label for="exampleInputEmail1" class="form-label">Логин</label>
								<input name="login" value="<?=$login?>" type="login" class="form-control">
						
							</div>

							<div class="col mb-4">
								<label for="exampleInputEmail1" class="form-label">Email</label>
								<input name="email" readonly value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1">
								
							</div>

							<div class="col mb-4">
								<label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
								<input name="password" type="password" class="form-control" id="exampleInputPassword1">
							</div>
							<!-- checkbox админ или нет -->

							<?php if($admin):?>
								<div class="form-check form-switch mb-4">
									<input name= "admin" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
									<label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
								</div>
							<?php else: ?>
								<div class="form-check form-switch mb-4">
									<input name= "admin" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
									<label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
								</div>
							<?php endif; ?>

							<!-- checkbox админ или нет -->

						<div class="col">
							<button name="update-user" class="btn btn-primary" type="submit">Обновить</button>
						</div>

					</form>
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
		<?php include '../../app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>