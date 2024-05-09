<?php 


	include  "control_mod.php";

	


?>

<?php include '../app/include/header.php'; ?>


<style>
	a{
		text-decoration: underline;
		color: blue;
	}

	.footer-comment a{
		text-decoration: none;
		color: grey;
	}

	.name_course{
		color: grey;
		font-size: 16px;
		margin-top: 20px;
	}
	.name_content{
		font-size: 40px;
		font-weight: bold;
		margin-bottom: 30px;
	}
	.continue .row button{
		width: 30%;
		
	}
	.continue .row .cont{
		text-align: right;
	}
	.status_progress{
		color: #50ff00;
		font-size: 20px;
		border-radius: 32px;
		background: #ccfbc6;
		/* box-shadow: -7px 7px 20px #a7cea2, 25px -7px 25px #f1ffea; */
	
		height: 30px;
	}
	
</style>



<!-- main -->
<div class="container">
	<div class="content row">
		<div class="main-content col-md-2">
		
		</div>
		<div class="main-content col-md-8">
			<div class="name_course">
				<?php echo($course['name_courses']);?>
			</div>
			<div class="row name_content">
				<div class="col-10">
							<?php echo($content['name_item_course']);?>
				</div>
				<?php if($progress_course['progress']==1):?>
				<div class="col-2 status_progress" style="margin-top: 20px;">
					<i class="fa-sharp fa-solid fa-check"></i> Пройден
				</div>
				<?php endif;?>
			
			</div>
		
				
			<!-- <?=test($_GET);?>
			<?=test($message);?> -->

			
			<?php echo($content['content']);?>
		


		
	

			<div class="continue">
				<div class="row">
					<div class="pred col-6">
						<?php if($content_pred):?>
							<button  class="btn btn-light" type="submit" onclick="document.location = '?id=<?=$content_pred['id_content_course']?>'">Назад</button>
						<?php endif;?>
						
					</div>
					<div class="cont col-6">
						<?php if($content_future):?>
						<button  class="btn btn-dark" type="submit" onclick="document.location = '?id=<?=$content_future['id_content_course']?>'">Далее</button>
						<?php endif;?>
					</div>
					
						
						

				</div>
			</div>

		

			<div style="margin-top:20px;" class="main-content col-md-12">
				<div style="border-bottom: 1px solid #cecece; margin-bottom:50px; " class="chat d-flex flex-row ">
					<div class="col-8  d-flex justify-content-start">
						<?php if($count_message['count'] == 0 || $count_message['count']>4):?>
							<h3 style="padding: 10px; margin-bottom: 0px;"><b><?=$count_message['count']?> комментариев</b></h3>
						<?php elseif($count_message['count'] == 1):?>
							<h3 style="padding: 10px; margin-bottom: 0px;"><b><?=$count_message['count']?> комментарий</b></h3>
						<?php else:?>
							<h3 style="padding: 10px; margin-bottom: 0px;"><b><?=$count_message['count']?> комментария</b></h3>
						<?php endif;?>

					</div>
					
					
				</div>
			</div>

			<form action="course_mod_content.php?id=<?=$_GET['id']?>" method="POST">
				<div class="block-comment d-flex row">
					<input type="hidden" name="name_send" value="<?=$text_comment?>">
					<input type="hidden" name="id_mess_send" value="<?=$id_com?>">
					<input type="hidden" name="id_content" value="<?=$content['id_content_course']?>">
					<textarea  name="text" id="" cols="90" rows="2" placeholder="Оставьте комментарий..."><?=$text_comment?></textarea>
					<button name="chat_content-btn" style="width: 20%;" class="btn btn-light mt-2">Отправить</button>
				</div>
			</form>	


			<?php  foreach($message as $key => $mes): ?>

					<?php $like = count_like_content_course($mes['id'],$_GET['id']);
					 $dislike = count_dislike_content_course($mes['id'],$_GET['id']);?>
					<div style="margin-left: 11px;" class="block-comment d-flex row">
						<?php	$output_send_mes = output_send_content_message($mes['id']);?>
						 <!-- <?=test($output_send_mes)?>  -->
					
						<?php if($output_send_mes):?>
							<!-- <?=test($mes['id_users']);?>
							<?=test($_SESSION['id_users']);?> -->
								<div class="message">
									<div class="d-flex flex-row">
										<div class="d-flex flex-column col-12">
											<div class="d-flex align-items-center">
												<div class="name_users">
													<?=$mes['login']?>
												</div>
												<div class="timestamp"><?=$mes['date']?></div>
											</div>							
											<div class="text-chat">
												<p><?=$mes['text']?></p>
											</div>
											
											<div class=" footer-comment">
												<?php if($mes['id_users']==$_SESSION['id_users']):?>
													<a style="color:red" href="course_mod_content.php?id=<?=$_GET['id']?>&id_del=<?=$mes['id']?>">удалить</a>
												<?php else:?>
													<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message=<?=$mes['id']?>">ответить</a>
												<?php endif?>
											</div>
																				
										</div>
									<div class="rating ">
										<div class=" like-dislike d-flex flex-column" >
											<!-- вывод пользователей поставивших лайк -->
											<?php $login_like=Logins_Put_Likes_content_course($mes['id'],1,$_GET['id']); 
												$temp='';
											
													foreach($login_like as $log_like){
														$temp = $temp.  $log_like['login'] . "  ";
													}
												
												
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a> <span data-clue="<?=$temp?>" class="clue"><?=$like['like']?></span> 
											<?php else:?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a> <?=$like['like']?>
											<? endif;?>
											<!-- вывод пользователей поставивших лайк -->


											<?php $login_dislike=Logins_Put_Likes_content_course($mes['id'],-1,$_GET['id']); 
											
												$temp='';
												foreach($login_dislike as $log_dislike){
													$temp = $temp.  $log_dislike['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><span data-clue="<?=$temp?>" class="clue"><?=$dislike['dislike']?></span> 
											<?php else:?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike['dislike']?>
											<? endif;?>

										</div>

									</div>
								
								</div>

								<!-- все смежные сообщения с главным -->
									<?php
										$i=0;
										for($i; $i<count($output_send_mes) ;$i++){
											$output = $output_send_mes[$i];
											$output_send_send_mes = output_send_message_content_course($output['id']);

											if($output_send_send_mes){
												foreach($output_send_send_mes as $out){
													array_push($output_send_mes, $out);
												}	
											}

										}	
									?>		
								<!-- end все смежные сообщения с главным -->
								
								<?php  foreach($output_send_mes as $key => $output):?> 
								<!-- перевод $output['date'] из даты в время -->
									<?php  

								
										$date = time();
										$date_new = date(time());
										
										$date_post=strtotime($output['date']) ; //большое число в секундах когда был опубликован комментарий

										$time='';
										$temp = explode(" ",$output['date']);
										$time = substr($temp[1],0,-3);
										$proshlo = $date_new-$date_post; // пройденное кол-во секунд с поста до сегодняшнее время
										
										$today_in_sec = date("H") * 3600 + date("i")*60 + date("s"); // сколько секунд с 00:00 прошло сегодня
										
									

										if(($proshlo<$today_in_sec)){
											$output['date']= ' сегодня в ' . $time ;
										}elseif($proshlo<($today_in_sec+86400)){
											$output['date']= ' вчера в ' . $time ;
										}else{
											$output['date']=$output['date'][8]. "" .  $output['date'][9] .' ' . $month[$output['date'][6]] . ' ' . $time ;
										}
										
									?> 
								<!-- end перевод  $output['date'] из  даты в время -->
								<?php $like_send = count_like_content_course($output['id'],$_GET['id']); $dislike_send = count_dislike_content_course($output['id'],$_GET['id']);?>
								<div class="message_send">
									<div class="d-flex flex-row">
										<div class="d-flex flex-column col-12">
											<div class="d-flex align-items-center">
												<div class="name_users">
													<?php $login = FromIDtoLogin($output['id_users']);?>
													<?=$login['login']?>
												</div>
												<div class="parent_author">
													<?php $parent_author=FromID_MessagetoLogin($output['id_send'],'chat_content_course');  ?>
													<i class="fa-solid fa-arrow-right"></i> <?=$parent_author['login']?>
												</div>
												<div class="timestamp"><?=$output['date']?></div>
											</div>							
											<div class="text-chat">
												<p><?=$output['text']?></p>
											</div>
											
											<div class=" footer-comment">
												<?php if($output['id_users']==$_SESSION['id_users']):?>
													<a style="color:red" href="course_mod_content.php?id=<?=$_GET['id']?>&id_del=<?=$output['id']?>">удалить</a>
												<?php else:?>
													<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message=<?=$output['id']?>">ответить</a>
												<?php endif?>

											</div>
																				
										</div>
										
										<div style="margin-left:19px;" class="rating ">
											<div class=" like-dislike d-flex flex-column" >
												<?php $login_like=Logins_Put_Likes_content_course($output['id'],1,$_GET['id']); 
												$temp='';
												foreach($login_like as $log_like){
													$temp = $temp.  $log_like['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$output['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><span data-clue="<?=$temp?>" class="clue"><?=$like_send['like']?></span> 
											<?php else:?>
													<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$output['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><?=$like_send['like']?>
											<? endif;?>

											<?php $login_dislike=Logins_Put_Likes_content_course($output['id'],-1,$_GET['id']); 
												$temp='';
												foreach($login_dislike as $log_dislike){
													$temp = $temp.  $log_dislike['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$output['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><span data-clue="<?=$temp?>" class="clue"><?=$dislike_send['dislike']?></span> 
											<?php else:?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$output['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike_send['dislike']?>
											<? endif;?>
											
											
											
											</div>
										</div>
									</div>
									
								
								</div>
							<?php endforeach;?>
							</div>

						<?php else:?>

							<div class="message">
							
								<div class="d-flex flex-row">
									<div class="d-flex flex-column col-12">
										<div class="d-flex align-items-center">
											<div class="name_users">
												<?=$mes['login']?>
											</div>
											<div class="timestamp"><?=$mes['date']?></div>
										</div>							
										<div class="text-chat">
											<p><?=$mes['text']?></p>
										</div>
										
										<div class=" footer-comment">
											
											<?php if($mes['id_users']==$_SESSION['id_users']):?>
												<a style="color:red" href="course_mod_content.php?id=<?=$_GET['id']?>&id_del=<?=$mes['id']?>">удалить</a>
											<?php else:?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message=<?=$mes['id']?>">ответить</a>
											<?php endif?>
										
										</div>
																			
									</div>
									<div class="rating ">
										<div class=" like-dislike d-flex flex-column" >
											
											<?php $login_like=Logins_Put_Likes_content_course($mes['id'],1,$_GET['id']); 
												$temp='';
												foreach($login_like as $log_like){
													$temp = $temp.  $log_like['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><span data-clue="<?=$temp?>" class="clue"><?=$like['like']?></span> 
											<?php else:?>
													<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><?=$like['like']?>
											<? endif;?>

											<?php $login_dislike=Logins_Put_Likes_content_course($mes['id'],-1,$_GET['id']); 
												$temp='';
												foreach($login_dislike as $log_dislike){
													$temp = $temp.  $log_dislike['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><span data-clue="<?=$temp?>" class="clue"><?=$dislike['dislike']?></span> 
											<?php else:?>
												<a href="course_mod_content.php?id=<?=$_GET['id']?>&id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike['dislike']?>
											<? endif;?>

										</div>
									</div>
								
								</div>
							
							</div>
						<?php endif;?>
					</div>
				



		
				<?php endforeach;?>
		
		

		

		</div>
		<div class="main-content col-md-2">

		</div>
		

	</div>
</div>
<!-- end main -->

<!-- FOOTER -->
<?php include '../app/include/footer.php'; ?>
<!-- footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
	crossorigin="anonymous">
</script>


</body>

</html>