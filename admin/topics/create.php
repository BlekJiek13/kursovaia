<?php

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
				<div class="row title-table mb-4">
					<h2>Создать категорию</h2>
					
				</div>
				<div class="row add-post">

					<!-- вывод ошибок в массиве -->
					<div class="mb-12 col-12 col-md-12 err">
						<?php include "../../app/helps/errorinfo.php"; ?>					
					</div>

					<form action="create.php" method="POST">
					  	<div class="col">
   							 <input name="name" value="<?=$name?>" type="text" class="form-control" placeholder="Имя категории" aria-label="Имя категории">
  						</div>
						
						<div class="col mt-4">
							<button name="topic-create" class="btn btn-primary" type="submit">Создать категорию</button>
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