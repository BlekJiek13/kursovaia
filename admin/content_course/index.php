<?php 


session_start(); 

include '../../app/control/content_course.php';  // получаем массив из базы данных со всеми статьями

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
					<h2  class="mb-4">Управление Содержанием Курса</h2>

					<!-- <div class="col-1">ID</div> -->
					<div class="col-2">ID Курса</div>
					<div class="col-2">Название</div>
					<div class="col-6">Контент</div>
					<div class="col-2">Управление</div>
					
				</div>
				<!-- вывод статей в Управление записями -->
				<?php foreach($content_course as $key => $course): ?>
				<div class="row post">
					<!-- <div class="id col-1"><?=$course['id_content_course']?></div> -->
					<div class="id col-2"><?=$course['id_courses']?></div>
					<div class="name col-2"><?=$course['name_item_course'] ?></div>

					



					<?php if($course['content'] == ''):?>
				      	<div class="content col-6" ><?=$course['content']?></div>
					<?php else: ?>
						<div class="content col-6" style="overflow-y: scroll;overflow-x: scroll;height: 300px;"><?=$course['content']?></div>
					<?php endif;?>
					<div class="red col-1"><a href="edit.php?id=<?=$course['id_content_course']?>" class="">edit</a></div>
					<div class="del col-1"><a href="edit.php?delete_id=<?=$course['id_content_course']?>">delete</a></div>
				
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