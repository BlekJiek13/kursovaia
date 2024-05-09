<?php 
session_start(); 

	include '../../app/control/review.php';

?>


	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">

		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				<div class="row title-table">
					<h2  class="mb-4">Управление отзывами</h2>
				
						<div class="title col-1">ID</div>
						<div class="title col-1">Курс</div>
						<div class="title col-1"><i  style="color:#FFD700;" class="fa-sharp fa-solid fa-star"></i></div>
						<div class="title col-4">Текст</div>
						<div class="title col-2">Автор</div>
						<div class="title col-3">Управление</div>
			
					
					
				</div>
				<!-- вывод статей в Управление записями -->
				<?php   foreach( $AllReviewForAdm  as $key => $review): ?>
				<div class="row post">
					<div class="id col-1" style="text-align: center;"><?=$review['id_reviews']?></div>
					<div class="id col-1" style="text-align: center;"><?=$review['id_courses']?></div>
					<div class="id col-1" style="text-align: center;"><?=$review['rate']?></div>
					<div class="comment col-4"><?=$review['text_review'] ?></div>
					<div class="login col-2" style="text-align: center;"><?=$review['login']?></div>
					<div class="del col-1"><a href="index.php?del_id=<?=$review['id_reviews']?>">delete</a></div>
					<!-- изменение кнопки в зависимости от статуса статьи -->
					<?php if($review['status']): ?>
						<div class="status col-2"><a href="index.php?publish=0&pub_id=<?=$review['id_reviews']?>">unpublish</a></div>
					<?php else: ?>
						<div class="status col-2"><a href="index.php?publish=1&pub_id=<?=$review['id_reviews']?>">publish</a></div>
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