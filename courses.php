<?php

	include "path.php";
	
	//include "app/control/courses.php";
	include "app/control/courses.php";
	
	//вывод всех опубликованных статей в массив
	//teste($allCourses);
	
?>

	<?php include 'app/include/header.php'; ?>

	<section class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 order-first" >
					<div class="row">
						<?php foreach($coursePublish as $course): ?>
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
					</div>
				</div>	

				<!-- sidebar content -->
				<div class="sidebar col-md-3 order-last" >
					<div class="section search" style="margin-top: 20px;">
						<h3></h3>
						<form action="search.php" method="post">
							<input type="text" name="search-term" class="text-input" placeholder="Поиск...">
					
							<h3></h3>
							<select name="search_category" class="form-select" aria-label="Default select example">
								<option value="0" selected>Категория поиска</option>
						
								<option  selected value="courses">Курсы</option>
							</select>
						</form>
					</div>
					<form action="pdf.php" method="POST" >								
						<button style="width:100%" name="price_pdf" type="submit" class="btn btn-light">
									<i class="fa-solid fa-download"></i> Получить прайс лист в PDF
						</button>
					</form>

					<form action="google_chart/google.php" method="POST" >								
						<button style="width:100%; margin-top:20px" name="category_charts" type="submit" class="btn btn-light">
									<i class="fa-solid fa-chart-column" style="color: #640b56;"></i> Перейти к графикам по категориям
						</button>
					</form>

				</div>
				
				<!-- sidebar content -->

			
			</div>
		</div>
	</section> 


	

	<!-- FOOTER -->
		<?php include 'app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>