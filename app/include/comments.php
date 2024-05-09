<?php 
		include  '/www/wwwroot/boostrap.local/app/control/comment.php';
		//test($page); получаем id поста
			
?>



<div class="col-md-12 col-12 comments">
	<h3>Оставить комментарий</h3>

	<?php if(!empty($errMsg)): ?>
	<div class="col-12 err" style="padding: 1rem 0; color: red;">
	<!-- Вывод массива с ошибками -->	
		<?php include "app/helps/errorinfo.php"; ?>
	</div>
	<?php endif; ?>


	<form action="single.php?id_articles= <?=$page?>" method="post">

		<!-- передача id поста методом POST -->
		<input name="page" value="<?=$page?>" type="hidden"> 

		<div class="mb-3">
			<label for="exampleFormControlTextarea1" class="form-label">Напишите отзыв</label>
			<textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
		</div>
		<div class="col-12">
			<button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
		</div>

	</form>

	<!-- вывод комментариев через foreach  -->

	<?php  if($AllComments): ?>
		<div class="row all-comments">
			<h3 class="col-12">Комментарии к записи</h3>
			<?php foreach($AllComments as $comment): ?>
				<div class="one-comment col-12">
					
					<span><i class="fa-regular fa-user"></i><?=$comment['login']?></span>
					<span><i class="fa-solid fa-calendar-days"></i><?=$comment['created_date']?></span>
					<div class="col-12 text">
						<?=$comment['comment']?>
					</div>
					

				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	
	


</div>