<?php session_start(); 
include '../../app/control/posts.php';  // получаем массив из базы данных со всеми статьями
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
					<h2  class="mb-4">Управление записями</h2>

					<div class="col-1">ID</div>
					<div class="col-5">Название</div>
					<div class="col-2">Автор</div>
					<div class="col-4">Управление</div>
					
				</div>
				<!-- вывод статей в Управление записями -->
				<?php foreach($postsAdm as $key => $post): ?>
				<div class="row post">
					<div class="id col-1"><?=$post['id_articles']?></div>



						<?php  if(strlen($post['title']) > 25):?>
							<div class="title col-5"><?=mb_substr($post['title'], 0, 25, 'utf-8') . '...' ?></div>
						<?php else: ?>
							<div class="title col-5"><?=$post['title'] ?></div>
						<?php endif; ?>


					<div class="author col-2"><?=$post['login']?></div>
					<div class="red col-1"><a href="edit.php?id=<?=$post['id_articles']?>" class="">edit</a></div>
					<div class="del col-1"><a href="edit.php?delete_id=<?=$post['id_articles']?>">delete</a></div>
					<!-- изменение кнопки в зависимости от статуса статьи -->
					<?php if($post['status']): ?>
						<div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$post['id_articles']?>">unpublish</a></div>
					<?php else: ?>
						<div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$post['id_articles']?>">publish</a></div>
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