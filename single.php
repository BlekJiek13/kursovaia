<?php 

	include  '/www/wwwroot/boostrap.local/app/db.php';
//test($_GET); exit(); -   $_GET('id_article')   // id поста

$post = selectAOneFromPostsUsersIndex('articles','users',$_GET['id_articles']);
$course = selectAll('courses', ['id_articles'=>$_GET['id_articles']]);



$view = selectOne('articles',['id_articles'=>$_GET['id_articles']]);
if($_SESSION['id_users']){

	update('articles',$_GET['id_articles'], ['view' => $view['view']+1] );
}


?>

	<?php include 'app/include/header.php'; ?>

	<!-- main -->
	<div class="container">
		
		<div class="content row">
			<div class="main-content col-md-12">
				
				<h2><?=$post['title']?></h2>


				<div class="single_post row"> <!--пост -->
					<div class="img col-12"> <!--картинка -->
						<img src="<?='assets/image/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
					</div>

					<div class="info">
						<i class="fa-solid fa-pen"> <label style="	font-family: 'Times New Roman', Times, serif;"><?=$post['login']; ?> </label></i>
						<i class="far fa-calendar"> <label style="	font-family: 'Times New Roman', Times, serif;">  <?= $post['date_articles']; ?> </label></i>
						<i class="fa-regular fa-eye"><label style="	font-family: 'Times New Roman', Times, serif;">        <?=" ". $post['view']; ?> </label></i>
					</div>

					<div class="single_post_text col-12"> <!--описание--->
						<p>
							<?=$post['text_articles']?>
						</p>
					</div>
					
					<div class="row mb-3">
						<?php if($course): ?>
							<h1>Курсы по теме: </h1>
							<?php foreach($course as $course): ?>
								<?php $avgrate = AvgRate($course['id_courses']);?>
								<div class="col-4" style="margin-top: 20px;">
									<div class="product-card">
										<div class="product-thumb">
											<a href="single_course.php?id_course=<?=$course['id_courses']?>"><img src="<?='assets/image/courses/' . $course['img'] ?>" alt="<?=$course['name_courses']?>" class="img-thumbnail"></a>
												
										</div>
										<div class="product-details">
											
											<h4><a href="single_course.php?id_course=<?=$course['id_courses']?>"><?=$course['name_courses']?></a></h4>
											
												<?=$course['description']?>
											<div class="product-bottom-details d-flex justify-content-between">
												<div class="product-price">
													<?=$course['price']?>$
												</div>
												<?php if($avgrate['AvgRate']):?>
													<div class="product-rate">
														<i  style="color:#FFD700;" class="fa-sharp fa-solid fa-star"></i> <?=round($avgrate['AvgRate'],1)?>
													</div>
												<?php endif;?>
												<div class="product-hour">
													<?=$course['hours']?>ч
												</div>
												<div class="product-links">
													<a class="add_cart"  href="app/control/cart.php?id=<?=$course['id_courses']?>"><i class="fas fa-shopping-cart"></i></a>

												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif;?>
					</div>


					<!-- Комментарии -->
					<?php include 'app/include/comments.php'; ?>
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