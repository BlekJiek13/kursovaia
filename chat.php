<?php

	include "path.php";
	
	include "app/control/chat.php";
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$limit = 2;
	$offset = $limit * ($page-1);
	$total_pages = round(countRow('articles') / $limit , 0);
?>

	<?php include 'app/include/header.php'; ?>

	<!-- main -->
	<div class="container">
		<div class="content row">

			<div style="margin-top:20px;" class="main-content col-md-12">
				<div style="border-bottom: 1px solid #cecece; margin-bottom:50px; " class="chat d-flex flex-row ">
					<div class="col-6  d-flex justify-content-start">
						
						<h3 style="padding: 10px; margin-bottom: 0px;"><b>Чат: <?=$count_message['count']?> сообщений</b></h3>
					</div>
					<div class="col-6 d-flex justify-content-end ">
					<p style="padding: 14px 0 0 0 ;">


					<div class="dropdown">
						<button  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							<?=$name_order?>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<li><a  class="dropdown-item" href="chat.php?popular">сначала популярные</a></li>
							<li><a class="dropdown-item"href="chat.php?new">сначала новые</a></li>
							<li><a class="dropdown-item"href="chat.php?old">сначала старые</a></li>
							
						</ul>
						</div>
						
					
					
					
					
					</p>
					</div>	
				</div>
			</div>

			<form action="chat.php" method="POST">
				<div class="block-comment d-flex row">
					<input type="hidden" name="name_send" value="<?=$text_comment?>">
					<input type="hidden" name="id_mess_send" value="<?=$id_com?>">
					<textarea  name="text" id="" cols="90" rows="2" placeholder="Оставьте комментарий..."><?=$text_comment?></textarea>
					<button name="chat-btn" style="width: 20%;" class="btn btn-light mt-2">Отправить</button>
				</div>
			</form>	
				<?php  foreach($message as $key => $mes): ?>
					<?php $like = count_like($mes['id']); $dislike = count_dislike($mes['id']);?>
					<div style="margin-left: 11px;" class="block-comment d-flex row">
						<?php	$output_send_mes = output_send_message($mes['id']);?>
					
						<?php if($output_send_mes):?>
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
												<a href="chat.php?id_message=<?=$mes['id']?>">ответить</a>
											</div>
																				
										</div>
									<div class="rating ">
										<div class=" like-dislike d-flex flex-column" >
											<!-- вывод пользователей поставивших лайк -->
											<?php $login_like=Logins_Put_Likes($mes['id'],1); 
												$temp='';
												foreach($login_like as $log_like){
													$temp = $temp.  $log_like['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="chat.php?id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a> <span data-clue="<?=$temp?>" class="clue"><?=$like['like']?></span> 
											<?php else:?>
												<a href="chat.php?id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a> <?=$like['like']?>
											<? endif;?>
											<!-- вывод пользователей поставивших лайк -->


											<?php $login_dislike=Logins_Put_Likes($mes['id'],-1); 
											
												$temp='';
												foreach($login_dislike as $log_dislike){
													$temp = $temp.  $log_dislike['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="chat.php?id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><span data-clue="<?=$temp?>" class="clue"><?=$dislike['dislike']?></span> 
											<?php else:?>
												<a href="chat.php?id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike['dislike']?>
											<? endif;?>

										</div>

									</div>
								
								</div>
								<!-- все смежные сообщения с главным -->
									<?php
										$i=0;
										for($i; $i<count($output_send_mes) ;$i++){
											$output = $output_send_mes[$i];
											$output_send_send_mes = output_send_message($output['id']);

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
								<?php $like_send = count_like($output['id']); $dislike_send = count_dislike($output['id']);?>
								<div class="message_send">
									<div class="d-flex flex-row">
										<div class="d-flex flex-column col-12">
											<div class="d-flex align-items-center">
												<div class="name_users">
													<?php $login = FromIDtoLogin($output['id_users']);?>
													<?=$login['login']?>
												</div>
												<div class="parent_author">
													<?php $parent_author=FromID_MessagetoLogin($output['id_send'],'chat');  ?>
													<i class="fa-solid fa-arrow-right"></i> <?=$parent_author['login']?>
												</div>
												<div class="timestamp"><?=$output['date']?></div>
											</div>							
											<div class="text-chat">
												<p><?=$output['text']?></p>
											</div>
											
											<div class=" footer-comment">
												<a href="chat.php?id_message=<?=$output['id']?>">ответить</a>
											</div>
																				
										</div>
										
										<div style="margin-left:19px;" class="rating ">
											<div class=" like-dislike d-flex flex-column" >
												<?php $login_like=Logins_Put_Likes($output['id'],1); 
												$temp='';
												foreach($login_like as $log_like){
													$temp = $temp.  $log_like['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="chat.php?id_message_like=<?=$output['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><span data-clue="<?=$temp?>" class="clue"><?=$like_send['like']?></span> 
											<?php else:?>
													<a href="chat.php?id_message_like=<?=$output['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><?=$like_send['like']?>
											<? endif;?>

											<?php $login_dislike=Logins_Put_Likes($output['id'],-1); 
												$temp='';
												foreach($login_dislike as $log_dislike){
													$temp = $temp.  $log_dislike['login'] . "  ";
												}
											?> 
											<?php if($temp):?>
												<a href="chat.php?id_message_dislike=<?=$output['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><span data-clue="<?=$temp?>" class="clue"><?=$dislike_send['dislike']?></span> 
											<?php else:?>
												<a href="chat.php?id_message_dislike=<?=$output['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike_send['dislike']?>
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
												<a href="chat.php?id_message=<?=$mes['id']?>">ответить</a>
											</div>
																			
									</div>
									<div class="rating ">
										<div class=" like-dislike d-flex flex-column" >
											
												<a href="chat.php?id_message_like=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-up like"></i></a><?=$like['like']?>
											
											<a href="chat.php?id_message_dislike=<?=$mes['id']?>"><i class="fa-solid fa-thumbs-down dislike"> </i></a><?=$dislike['dislike']?>
										</div>
									</div>
								
								</div>
							
							</div>
						<?php endif;?>
					</div>
				



		
				<?php endforeach;?>
			

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