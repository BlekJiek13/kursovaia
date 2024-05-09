<?php 


session_start(); 

	include '../../app/control/comment.php';

?>


	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">

		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				<div class="row title-table">
					<h2  class="mb-4">Управление комментариями к статье</h2>

					<div class="col-1">ID</div>
					<div class="col-2">Статья</div>
					<div class="col-4">Текст</div>
					<div class="col-2">Автор</div>
					<div class="col-3">Управление</div>
					
				</div>
				<!-- вывод статей в Управление записями -->
				<?php foreach(  $AllCommentsForAdm as $key => $comment): ?>
				<div class="row post">
					<div class="id col-1"><?=$comment['id_comments_articles']?></div>
					<div class="id col-2" style="text-align: center;"><?=$comment['page']?></div>


						<?php  if(strlen($comment['comment']) > 20):?>
							<div class="comment col-4"><?=$comment['comment'] ?></div>
						<?php else: ?>
							<div class="comment col-4"><?=$comment['comment'] ?></div>
						<?php endif; ?>







					<div class="login col-2"><?=$comment['login']?></div>
					<div class="red col-1"><a href="edit.php?id=<?=$comment['id_comments_articles']?>" class="">edit</a></div>
					<div class="del col-1"><a href="index.php?del_id=<?=$comment['id_comments_articles']?>">delete</a></div>
					<!-- изменение кнопки в зависимости от статуса статьи -->
					<?php if($comment['status']): ?>
						<div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['id_comments_articles']?>">unpublish</a></div>
					<?php else: ?>
						<div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['id_comments_articles']?>">publish</a></div>
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