<?php

	include "path.php";
	
	include "app/control/cart.php";
	//вывод всех опубликованных статей в массив
	//teste($allCourses);
	
?>

	<?php include 'app/include/header.php'; ?>

	<section class="main-content">
		<div class="container">
			<?php if($_SESSION['cart']):?>
			<h1 style="margin-top: 20px;">Корзина</h1>
		
			<div class="row">
			
				<div class="col-md-9 order-first" >
					
					<div class="row">
						<?php foreach($_SESSION['cart'] as $cart): ?>
				
						<div class="col-4" style="margin-top: 20px;">
							<div class="product-card">
								<div class="product-thumb">
									<a href="single_course.php?id_course=<?=$cart['id_courses']?>"><img src="<?='assets/image/courses/' . $cart['img'] ?>" alt="<?=$course['name_courses']?>" class="img-thumbnail"></a>
										
								</div>
								<div class="product-details">
									
									<h4><a href="single_course.php?id_course=<?=$cart['id_courses']?>"><?=$cart['name_courses']?></a></h4>
									
										<?=$cart['description']?>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											<?=$cart['price']?>$
										</div>
										
										<div class="product-buy">
											<a href="cart.php?id_buy=<?=$cart['id_courses']?>" class=""><i class="fa-sharp fa-solid fa-money-bill-1-wave"></i></a>
										</div>
										
										<div class="product-qrt">
											<?=$cart['qrt']?>шт
										</div>
										<div class="product-links">
											<a class="add_cart"  href="cart.php?id_del=<?=$cart['id_courses']?>"><i class="fa-solid fa-trash"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					
					

				</div>	

				<!-- sidebar content -->
				
				<div class="cartsum col-md-3 mt-4 order-last" >
					<h1>Итого: </h1>
				
					<?php if($qty_cart>4): ?>
						<h3><?=$qty_cart?> курсов на <?=$sum_cart?>$</h3>
					<?php elseif($qty_cart>1): ?>
						<h3><?=$qty_cart?> курса на <?=$sum_cart?>$</h3>
					<?php else: ?>
						<h3><?=$qty_cart?> курс на <?=$sum_cart?>$</h3>
					<?php endif; ?>

		
					
				</div>

					

				<!-- sidebar content -->

			
			</div>

			<?php else: ?>
				<h1 style="margin-top: 20px;">Корзина пуста</h1>
			<?php endif; ?>

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