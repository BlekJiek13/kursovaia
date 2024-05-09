<?php session_start(); 


include "../../app/control/topics.php";

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

					<h2 class=" mb-4">Управление категориями</h2>
					<div class="col-1">ID</div>
					<div class="col-5">Название</div>
					<div class="col-4">Управление</div>
					
				</div>
			
				<?php foreach ($topics as $topics): ?>

				<div class="row post">
					<div class="id col-1"><?=$topics['id_name_category']?></div>
					<div class="title col-5"><?=$topics['name_category']?></div>
					<div class="red col-2"><a href="edit.php?id=<?=$topics['id_name_category'];?>" class="">edit</a></div>
					<div class="del col-2"><a href="edit.php?del_id=<?=$topics['id_name_category'];?>">delete</a></div>
				</div>
				<?php endforeach; ?>

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