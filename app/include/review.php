<?php 
		include  '/www/wwwroot/boostrap.local/app/control/review.php';
		//test($page); получаем id поста
			//teste($_GET);
		
?>



<div class="col-md-12 col-12  comments">
	<h3>Оставить отзыв</h3>

	<?php if(!empty($errMsg)): ?>
		<div class="col-12 err" style="padding: 1rem 0; color: red;">
		<!-- Вывод массива с ошибками -->	
			<?php include "app/helps/errorinfo.php"; ?>
		</div>
	<?php endif; ?>


	<form action="buy_courses.php?id_course=<?=$page_course?>" method="post">

		<!-- передача id поста методом POST -->
		<input name="page_course" value="<?=$page_course?>" type="hidden"> 
		<input name="id_users" value="<?=$_SESSION['id_users']?>" type="hidden"> 

		<div class="mb-3">
			<label for="exampleFormControlTextarea1" class="form-label">Напишите отзыв</label>
			<textarea name="review" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
		</div>
		<div class="row">
			<div class=" col-4">
				<h1  ><i style="color:#FFD700;" class="fa-sharp fa-solid fa-star"></i>Оценка</h1>
			</div>
			<div class="rate col-4">
				
			
			
			<input name="rate" type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
			<div class="number">
				<label for="customRange3" style="margin-right: 67px; margin-left: 5px;" class="form-label rate">0</label>
				<label for="customRange3" style="margin-right: 67px;" class="form-label rate">1</label>
				<label for="customRange3" style="margin-right: 65px;" class="form-label rate">2</label>
				<label for="customRange3" style="margin-right: 67px;" class="form-label rate">3</label>
				<label for="customRange3"  style="margin-right: 65px;" class="form-label rate">4</label>
				<label for="customRange3" style="margin-right: 0px;" class="form-label rate">5</label>
				
			</div>
			
				
			
			</div>
		</div>
		<div class="col-12 mt-4">
			<button type="submit" name="goReview" class="btn btn-primary">Отправить</button>
		</div>

	</form>

	<!-- вывод комментариев через foreach  -->

	<?php if($AllReviews): ?>
		<div class="row all-comments">
			<h3 class="col-12">Отзывы к курсу</h3>
			<?php foreach($AllReviews as $review): ?>
				<div class="one-comment col-12">
					
					<span><i class="fa-regular fa-user"></i><?=$review['login']?></span>
					<span><i  style="color:#FFD700;" class="fa-sharp fa-solid fa-star"></i> <?=$review['rate']?> </span>
					<span><i class="fa-solid fa-calendar-days"></i><?=$review['date_review']?></span>
					<div class="col-12 text">
						<?=$review['text_review']?>
					</div>
					

				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	
	


</div>