<?php

include '../../app/control/content_course.php'; 
	include '../../app/control/comment.php';
?>

<script src="../../Scripts/ckeditor/ckeditor.js"></script>
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
					<h2>Редактирование Содержание</h2>
					
				</div>
				<div class="row add-post">

					<!-- вывод ошибок в массиве -->
					<div class="mb-12 col-12 col-md-12 err">
						<?php include "../../app/helps/errorinfo.php"; ?>					
					</div>

					<form action="create.php" method="POST">
						<input type="hidden" name="id" value="<?=$id?>">
					  	<div class="col">
   							 <input name="name" value="<?=$name?>" type="text" class="form-control" placeholder="Название содержания" aria-label="Название содержания">
  						</div>
						<div class="col">
   							 <input name="number" value="<?=$content_course['number']?>" type="text" class="form-control" placeholder="Порядок главы" aria-label="Порядок главы">
  						</div>

						<div class="col mt-2">
							<!-- Выпадающий список -->
						
							<select name = "id_course" class="form-select  mb-4" aria-label="Default select example">
									
								<option value="<?=$id_course?>" selected><?=$id_course?> <?=$name_courses['name_courses']?></option>
								<?php  foreach ($course as $course): ?>
									<?php if($course['id_courses']==$id_course): ?>
									<?php else:?>	
										<option value="<?=$course['id_courses']?>"><?=$course['id_courses']?>  <?=$course['name_courses']?></option>
									<?php endif;?>
								
								<?php endforeach; ?>
							</select>
						<!-- Выпадающий список -->
						</div>
						
						<textarea name="content" id="content1"><?=$content_course['content']?></textarea>

						<div class="col mt-4">
							<button name="content-edit" class="btn btn-primary" type="submit">Обновить содержание</button>
						</div>

						
						

					</form>
					<h1></h1>	
					
					
					<!-- <?php echo($content_course['content']);?> -->

			
			

				</div>
					<div class="posts col-12">
					<div class="row title-table">
						<h2  class="mb-4">Управление комментариями к содержанию</h2>
									
						<div class="col-7">Текст</div>
						<div class="col-3">Автор</div>
						<div class="col-2">Управление</div>
						
					</div>
				
					<?php foreach(  $all_chat_content as $key => $comment): ?>
					<div class="row post">
				
							<?php  if(strlen($comment['text']) > 20):?>
								<div class="comment col-7"><?=$comment['text'] ?></div>
							<?php else: ?>
								<div class="comment col-7"><?=$comment['text'] ?></div>
							<?php endif; ?>


						<div class="login col-3"><?=$comment['login']?></div>
				
						<div class="del col-2"><a href="edit.php?del_id_content_course=<?=$comment['id']?>">delete</a></div>
						
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
		
<script>
	document.addEventListener("DOMContentLoaded",function(event) {

		//CKeditor4
		CKEDITOR.timestamp = "v=2";
		 var editor = CKEDITOR.replace('content1');
	

	});

	

	
</script>
</body>

</html>