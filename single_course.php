<?php 

	include  '/www/wwwroot/boostrap.local/app/db.php';
	include  '/www/wwwroot/boostrap.local/app/control/review.php';
//teste($_GET);   //  $_GET('id_article');   // id поста

// $post = selectAOneFromPostsUsersIndex('articles','users',$_GET['id_articles']);
$single_course = selectOne('courses', ['id_courses' => $_GET['id_course']]);
$content = selectAll('content_course',['id_courses' => $_GET['id_course']] );

$avgrate = AvgRate($_GET['id_course']);
// $avgrate['AvgRate'] - средняя оценка курса
$view = selectOne('courses',['id_courses'=>$_GET['id_course']]);



if($_SESSION['id_users']){

	update('courses',$_GET['id_course'], ['view' => $view['view']+1] );
}


//teste($single_course); 
?>

	<?php include 'app/include/header.php'; ?>

	<!-- main -->
	<div class="container">
		<div class="content row">
			<div class="main-content col-md-12">
				
				<h2><?=$post['title']?></h2>


				<div class="single_course row"> <!--пост -->
					<div class="img col-6">
						<img src="<?='assets/image/courses/' . $single_course['img'] ?>" class="img-thumbnail">
					</div>
					<div class="date col-4">
						<?php if($avgrate['AvgRate']):?>
							<h1><i  style="color:#FFD700;" class="fa-sharp fa-solid fa-star"></i> <?=round($avgrate['AvgRate'],1)?></h1>
						<?php endif;?>
							<h1>Цена</h1>
							<h1 style="color:green"><?=$single_course['price']?>$</h1>
				
						<h1><?=$single_course['hours']?> часов теории и практики</h1>

					

						<a href="app/control/cart.php?id=<?=$single_course['id_courses']?>" class=""><button style="background-color: green; border-color: green;" name="add_post" class="btn btn-primary " type="submit">В корзину</button></a>
					</div>

					</div>
	
					

					<!-- <div class="info">
						<i class="fa-solid fa-pen"> <label style="	font-family: 'Times New Roman', Times, serif;"><?=$post['login']; ?> </label></i>
						<i class="far fa-calendar"> <label style="	font-family: 'Times New Roman', Times, serif;">  <?= $post['date_articles']; ?> </label></i>
						
					</div> -->
					<h1><?=$single_course['name_courses']?></h1>

					<div class="single_post_text col-12"> <!--описание--->
						<p>
							<?=$single_course['description']?>
						</p>
					</div>

					<div class="content">
						<h1>Содержание курса:</h1>

							<ul>
								<?php foreach($content as $content ): ?>
								<li>
									<?=$content['name_item_course']?>
								</li>
								<?php endforeach; ?>
							</ul>
					</div>
					
					<?php $buy = ColVoBuyCourse($single_course['id_courses']); ?>

					<?php  if($buy['buy']): ?>
						<?php if($buy['buy']>4): ?>
							<h2 style="color:rgb(172, 142, 255);">Курс купили уже <?=$buy['buy'];?> пользователей, не упускай шанс и ты</h2>
						<?php elseif($buy['buy']==1): ?>
							<h2 style="color:rgb(172, 142, 255);">Курс купил <?=$buy['buy'];?> пользователь, не упускай шанс и ты</h2>
						<?php elseif($buy['buy']>1 && $buy['buy']<5 ): ?>
							<h2 style="color:rgb(172, 142, 255);">Курс купили <?=$buy['buy'];?> пользователя, не упускай шанс и ты</h2>
						<?php endif; ?>
					<?php endif;?>
					<!-- отзыв -->

					<div class="col-md-12 col-12  comments">
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
					
				</div>

			</div>
			

		</div>
	</div>
	<!-- end main -->

	<!-- FOOTER -->
	<?php include 'app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>