<?php 

	include  '/www/wwwroot/boostrap.local/app/db.php';
//teste($_GET);   //  $_GET('id_article');   // id поста

// $post = selectAOneFromPostsUsersIndex('articles','users',$_GET['id_articles']);
$single_course = selectOne('courses', ['id_courses' => $_GET['id_course']]);
$content = content_course($_GET['id_course']);



//teste($single_course); 
?>

	<?php include 'app/include/header.php'; ?>

	<!-- main -->
	<div class="container">
		<div class="content row">
			<div class="main-content col-md-12">
				
			
			

				<div class="single_course row mt-4"> <!--пост -->
					<div class="img col-6"> <!--картинка -->
						<img src="<?='assets/image/courses/' . $single_course['img'] ?>" class="img-thumbnail">
					</div>
					<div class="date col-4">
							<h1><i style="color:green" class="fa-solid fa-check"></i>Куплен</h1>
							
				
						<h1><?=$single_course['hours']?> часов теории и практики</h1>
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

					<div class="content-course">
						<h1>Содержание курса:</h1>

						<ul style="margin-bottom: 5rem;">

							<form action="app/control/safe_progress.php" method="POST" >
								<?php  foreach($content as $key => $conten ): ?>
									
									<?php $con = selectOne('progress_course',['id_content_course'=>$conten['id_content_course'],'id_courses' => $conten['id_courses'],'id_users'=> $_SESSION['id_users']] );?>
									


									<div class="div">
										<?php if($con['progress']):?>
										<div class="form-check">
											<input type="hidden" name="id_course" value="<?=$single_course['id_courses']?>">
											<input name= "<?=$conten['id_content_course']?>" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" checked>
											<label class="form-check-label" for="flexCheckDefault">
												<a href="course_module/course_mod_content.php?id=<?=$conten['id_content_course']?>"><?=$conten['number']?> <?=$conten['name_item_course']?></a>
											</label>
										</div>
										<?php else:?>
											<div class="form-check">
												<input type="hidden" name="id_course" value="<?=$single_course['id_courses']?>">
												<input name= "<?=$conten['id_content_course']?>" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" >
												<label class="form-check-label" for="flexCheckDefault">
													<a href="course_module/course_mod_content.php?id=<?=$conten['id_content_course']?>"><?=$conten['number']?>  <?=$conten['name_item_course']?></a>
												</label>
											</div>
										<?php endif;?>
									</div>
									




								<?php endforeach; ?>
								<button  name="safe-prodress" class="btn btn-primary" type="submit" style="background-color: rgb(172, 142, 255); border-color:rgb(172, 142, 255);" >Сохранить прогресс</button>
							</form>

						</ul>
					</div>
											


					

					<!-- отзыв -->
					<?php include 'app/include/review.php'; ?>
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