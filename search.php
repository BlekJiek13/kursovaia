<?php

	include "path.php";

	include  '/www/wwwroot/boostrap.local/app/db.php';

	if(empty($_POST['search-term'])){
		header('location:index.php'); //переход после кнопки на index
		exit();
	}
	$index=0;



	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term']) && $_POST['search_category'] == '0'){
		$posts = searchInTitleAndContent($_POST['search-term'], 'articles' , 'users');
	}elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term']) && $_POST['search_category'] == 'title'){
		$posts = searchInTitle($_POST['search-term'], 'articles' , 'users');
	}elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term']) && $_POST['search_category'] == 'text_articles'){
		$posts = searchInContent($_POST['search-term'], 'articles' , 'users');
	}elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term']) && $_POST['search_category'] == 'courses'){
		$coursePublish = searchInCourse($_POST['search-term'], 'courses');
		$index = 1;
		
	}
	else{
		$posts = [];
	}
	
?>

	<?php include 'app/include/header.php'; ?>
	
	<?php if($index==0): ?>

	<!-- main -->
	<div class="container">
		<div class="content row">
			<div class="main-content col-9">
				

				
				<?php if(!empty($posts)): ?>
					
					<h2 style="text-align: center;">Результаты поиска</h2>
					<?php foreach($posts as $post): ?>


					<div class="post row">
						<div class="img col-12 col-md-4"> <!--картинка -->
							<img src="<?='assets/image/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
						</div>
						<div class="post_text col-12 col-md-8"> <!--описание--->
							<h3>
								<!-- обрезаем title если он больше 36 символов -->
								<?php if (strlen($post['title'])>36): ?>
									<a href="single.php?id_articles=<?=$post['id_articles']?>"><?=mb_substr($post['title'], 0, 36, 'utf-8') . '...'?></a>
								<?php else: ?>
									<a href="single.php?id_articles=<?=$post['id_articles']?>"><?=$post['title']?></a>
								<?php endif; ?>
								<!-- обрезаем title если он больше 36 символов -->
							</h3>
							<i class="far fa-user"> <label style="	font-family: 'Times New Roman', Times, serif;"><?=$post['login']; ?> </label></i>
							<i class="far fa-calendar"> <label style="	font-family: 'Times New Roman', Times, serif;">  <?= $post['date_articles']; ?> </label></i>
							<p class="previem-text">
								<!-- обрезаем text_articles если он больше 72 символов -->
								<?php if (strlen($post['text_articles'])>72): ?>
									<a href="#"><?=mb_substr($post['text_articles'], 0, 72, 'utf-8') . '...';?></a>
								<?php else: ?>
									<a href="#"><?=$post['text_articles']?></a>
								<?php endif; ?>
								<!-- обрезаем text_articles если он больше 100 символов -->

							</p>
						</div>

					

					</div>
					<?php endforeach; ?>
					
				<?php else: ?>
					<h2 style="text-align: center; margin-bottom: 40rem;">Нет результатов поиска</h2>
				
				<?php endif; ?>
			
				
			</div>
			<div class="sidebar col-md-3 col-12">
							<!-- sidebar content -->
						
							<div class="section search" style="margin-top: 100px;">
								<h3></h3>
								<form action="search.php" method="post">
									<input type="text" name="search-term" class="text-input" placeholder="Поиск...">
							
									<h3></h3>
									<select name="search_category" class="form-select" aria-label="Default select example">
										<option value="0" selected>Категория поиска</option>
										<option value="title">Статьи (Заголовки)</option>
										<option value="text_articles">Статьи (Контент)</option>
										<option value="courses">Курсы</option>
									</select>
								</form>
							</div>
					
			</div>
			
			
		</div>
	</div>
	<!-- end main -->

	<?php else: ?>
		
	<section class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 order-first" >
					<?php if(!empty($coursePublish)): ?>
					<div class="row">
						<?php  foreach($coursePublish as $course): ?>
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
												<a href="#"><i class="fas fa-shopping-cart"></i></a>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

				<?php else: ?>
					<h2 style="text-align: center; margin-bottom: 40rem;">Нет результатов поиска</h2>
				
				<?php endif; ?>
					
					

				</div>	

			<!-- sidebar content -->
			<div class="sidebar col-md-3 order-last" >



				<div class="section search" style="margin-top: 20px;">
					<h3></h3>
					<form action="search.php" method="post">
						<input type="text" name="search-term" class="text-input" placeholder="Поиск...">
				
						<h3></h3>
						<select name="search_category" class="form-select" aria-label="Default select example">
					
							<option selected value="courses">Курсы</option>
						</select>
					</form>
				</div>

			



				<form action="pdf.php" method="POST" >	
					<input name="search-term" type="hidden" value="<?=$_POST['search-term']?>">							
					<button style="width:100%" name="search_pdf" type="submit" class="btn btn-light">
								<i class="fa-solid fa-download"></i> Получить результат поиска в PDF
					</button>
				</form>
			
			</div>


			


		</div>
		
	</section>


	<?php endif; ?>



	

	<!-- FOOTER -->
		<?php include 'app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>