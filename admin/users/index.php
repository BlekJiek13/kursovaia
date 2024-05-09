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
				<div class="row title-table">
			
					<h2 class="mb-4">Управление пользователями</h2>
					<div class="col-1">ID</div>
					<div class="col-2">Логин</div>
					<div class="col-3">ФИО</div>
					<div class="col-3">email</div>
					<div class="col-1">Роль</div>
					<div class="col-2">Управление</div>
					
				</div>
				<?php foreach($users as $key => $user): ?>
				<div class="row post">
					<div class="col-1"><?=$user['id_users']?></div>
					<div class=" col-2"><?=$user['login']?></div>
					<div class=" col-3"><?=$user['FIO_users']?></div>
					<div class=" col-3"><?=$user['email']?></div>

					<?php if($user['admin']): ?>
						<div class=" col-1">Admin</div>
					<?php else: ?>
						<div class=" col-1">User</div>
					<?php endif; ?>

					<div class="red col-1"><a href="edit.php?edit_id=<?=$user['id_users']?>" class="">edit</a></div>
					<div class="del col-1"><a href="index.php?delete_id=<?=$user['id_users']?>">delete</a></div>
				</div>
				<?php endforeach; ?>
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