<?php

	include "path.php";
	
	include "app/control/cart.php";


	//вывод всех опубликованных статей в массив
	
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$limit = 2;
	$offset = $limit * ($page-1);
	$total_pages = round(countRow('articles') / $limit , 0);

	$posts = selectAllFromPostsUsersIndex('articles','users', $limit , $offset);
	$topTopic = selectAll('articles',['id_category' => 1]); //посты где категория = 1(TopTopics)

?>

	<?php include 'app/include/header.php'; ?>



	<!-- main -->
	<div class="container">
		<div class="content row">

		
			<div class="main-content col-md-9">
				<h2>Последние публикации</h2>
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
						<i class="fa-solid fa-pen"> <label style="	font-family: 'Times New Roman', Times, serif;"><?=$post['login']; ?> </label></i>
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
				<!-- навигация -->
				<?php include 'app/include/pagination.php'; ?>
			</div>
			<!-- sidebar content -->
			<div class="sidebar col-md-3 col-12">



				<div class="section search">
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

			


				<div class="section topics">
					<h3>Категории</h3>
					<ul>
						
						<?php foreach ($topics as $topics): ?>
						<li><a href="category.php?id=<?=$topics['id_name_category']?>"><?=$topics['name_category']?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<!-- sidebar content -->

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