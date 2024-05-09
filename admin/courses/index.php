<?php 


session_start(); 

include '../../app/control/courses.php';  // получаем массив из базы данных со всеми статьями

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
					<h2  class="mb-4">Управление Курсами</h2>

					<div class="col-1">ID</div>
					<div class="col-1">ID Статьи</div>
					<div class="col-2">Название</div>
					<div class="col-3">Описание</div>
					<div class="col-1">Цена</div>
					<div class="col-1">Часы</div>
					<div class="col-3">Управление</div>
					
				</div>
				<!-- вывод статей в Управление записями -->
				<?php foreach($courses as $key => $course): ?>
				<div class="row post">
					<div class="id col-1"><?=$course['id_courses']?></div>
					<div class="id col-1"><?=$course['id_articles']?></div>
				
					<div class="name col-2"><?=$course['name_courses'] ?></div>
					<div class="description col-3"><?=$course['description']?></div>
					<div class="hour col-1" style="text-align: center;"><?=$course['price']?></div>
					<div class="hour col-1" style="text-align: center;"><?=$course['hours']?></div>
					<div class="red col-1"><a href="edit.php?id=<?=$course['id_courses']?>" class="">edit</a></div>
					<div class="del col-1"><a href="edit.php?delete_id=<?=$course['id_courses']?>">delete</a></div>
					<!-- изменение кнопки в зависимости от статуса статьи -->
					<?php if($course['status']): ?>
						<div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$course['id_courses']?>">unpublish</a></div>
					<?php else: ?>
						<div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$course['id_courses']?>">publish</a></div>
					<?php endif; ?>
					<!-- изменение кнопки в зависимости от статуса статьи -->
				</div>
				<?php endforeach; ?>
				<!-- вывод статей в Управление записями -->
				
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