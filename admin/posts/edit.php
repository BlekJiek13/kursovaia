<?php 
		include "../../app/control/posts.php";
?>


	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">

		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				
				<div class="row title-table">
					<h2 class="mb-4">Редактирование записи</h2>
					
				</div>

				

				<div class="row add-post">

				<div class="mb-12 col-12 col-md-12 err">
					<!-- Вывод массива с ошибками -->
						
						<?php include "../../app/helps/errorinfo.php"; ?>
				</div>

					<form enctype="multipart/form-data" action="edit.php" method="POST" >

					  	<input type="hidden" name="id" value="<?=$id_articles?>">

						<div class="col  mb-4">
   							 <input value="<?=$post['title']; ?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
  						</div>
						<div class="col mb-4">
  							<label for="editor" class="form-label">Содержимое записи</label>
  							<textarea name="text_articles" id="editor" class="form-control" rows="6"><?=$post['text_articles']; ?></textarea>
						</div>
						<div class="input-group col mb-4">
							<input name="img" type="file" class="form-control" id="inputGroupFile02">
							<label class="input-group-text" for="inputGroupFile02">Upload</label>
						</div>

						<!-- Выпадающий список -->
						<select name = "topic" class="form-select  mb-4" aria-label="Default select example">
							<!-- сохранение категории для Редактирования -->
							<option value="<?=$topicname['id_name_category']?>"><?=$topicname['name_category']?></option>

							<?php foreach ($topics as $topics): ?>
								<?php if ($topics['id_name_category'] == $topicname['id_name_category']): ?>
								<?php else: ?>
									<option value="<?=$topics['id_name_category']?>"><?=$topics['name_category']?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
						<!-- Выпадающий список -->



						<!-- проверка на статус  -->
						<!-- <div class="form-check form-switch mb-4">
							<?php if(empty($publish) && $publish == 0): ?>
  							<input name= "publish" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
  							<label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
							<?php else: ?>
								<input name= "publish" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
  								<label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
							<?php endif; ?>
						</div> -->
						<!-- проверка на статус  -->

						<div class="col col-6 ">
							<button name="edit_post" class="btn btn-primary" type="submit">Сохранить</button>
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