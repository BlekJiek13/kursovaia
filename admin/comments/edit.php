<?php 
		include "../../app/control/comment.php";
?>


	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">

		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				
				<div class="row title-table">
					<h2 class="mb-4">Редактирование комментария</h2>
					
				</div>

				<div class="row add-post">

				<div class="mb-12 col-12 col-md-12 err">
						<?php include "../../app/helps/errorinfo.php"; ?>
				</div>

					<form enctype="multipart/form-data" action="edit.php" method="POST" >

					  	<input type="hidden" name="id" value="<?=$id_comments_articles?>">

						<div class="col  mb-4">
   							 <input readonly value="<?=$login['login']; ?>" name="login" type="text" class="form-control" placeholder="login" aria-label="Название статьи">
  						</div>
						<div class="col mb-4">
  							<label for="editor" class="form-label">Содержимое комментария</label>
  							<textarea  name="comment" id="editor" class="form-control" rows="6">
								<?=$text?>
							</textarea>
						</div>
						

						<div class="col col-6 ">
							<button name="edit_comment" class="btn btn-primary" type="submit">Сохранить</button>
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