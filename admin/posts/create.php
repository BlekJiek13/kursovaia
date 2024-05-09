<?php 
		include "../../app/control/posts.php";
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
					<h2 class="mb-4">Добавление записи</h2>
					
				</div>

				

				<div class="row add-post">

				<div class="mb-12 col-12 col-md-12 err">
					<!-- Вывод массива с ошибками -->
						<!-- <p style="color: red; font-style: italic; font-size: 0.8em;"><?=$errMsg?></p>	 -->
						<?php include "../../app/helps/errorinfo.php"; ?>
				</div>

					<form enctype="multipart/form-data" action="create.php" method="POST" >
					  	<div class="col  mb-4">
   							 <input value="<?=$title?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
  						</div>
						<div class="col mb-4">
  							<label for="editor" class="form-label">Содержимое записи</label>
  							<textarea name="text_articles" id="editor" class="form-control" rows="6"><?=$text_articles; ?></textarea>
						</div>
						<div class="input-group col mb-4">
							<input name="img" type="file" class="form-control" id="inputGroupFile02">
							<label class="input-group-text" for="inputGroupFile02">Upload</label>
						</div>

						<!-- Выпадающий список -->
						<select name = "topic" class="form-select  mb-4" aria-label="Default select example">
							<option selected>Категория поста:</option>
							<?php foreach ($topics as $topics): ?>

							<option value="<?=$topics['id_name_category']?>"><?=$topics['name_category']?></option>
							<?php endforeach; ?>
						</select>
						<!-- Выпадающий список -->
						<div class="form-check form-switch mb-4">
  							<input value="1" name= "publish" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
  							<label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
						</div>
						<div class="col col-6 ">
							<button name="add_post" class="btn btn-primary" type="submit">Создать пост</button>
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
	
	
	<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>



	<script src="../../assets/js/scripts.js"></script>

</body>

</html>