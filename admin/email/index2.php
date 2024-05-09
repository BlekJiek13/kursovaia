<?php session_start(); 

include '../../app/control/email.php';

?>

	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">
		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				
				<div class="row title-table-email">
			
					<h2>Рассылка</h2>

						<div class="contact-form col-12">
							<br>
							<?php if($errMsgemail || $suc): ?>
								<div class="mb-12 col-12 col-md-12 err">
										<!-- Вывод массива с ошибками -->
									<?php $errMsg = $errMsgemail ?>
									<?php $success = $suc ?>
									<?php include "../../app/helps/errorinfo.php"; ?>
								</div>
								<?php endif; ?>
							<form action="index2.php" method="POST" >
								
								<div class="col mb-6">
									<label for="formGroupExampleInput" class="form-label">Тема рассылки</label>
									<!-- Выпадающий список -->
									
									<select style="width:50%;" name = "id_rassylka" class="form-select  mb-4" aria-label="Default select example" style="width:50%; margin-left: 15px; ">
										
										<?php foreach($rassylka as $key=> $ras):?>
											
											<option value="<?=$ras['id_rassylka']?>"><?=$ras['name_rassylka']?></option>
										<?php endforeach; ?>
									</select>
									<!-- Выпадающий список -->
								</div>
								<div class="col  mb-2">
									<textarea rows="4" name="message" type="text" class="form-control" placeholder="Cообщение"></textarea>
								</div>

								

								<button id="admin_email_rassylka" name="admin_email_rassylka" type="submit" class="btn btn-light">
									<i class="fas fa-envelope"></i> Отправить
								</button>

							</form>
				
						</div>
					</div>


					<div class="col-12 mt-4">
						<div class="col-12 mb-4">
							<h4 style="text-align: center;">Статистика по подпискам и отправленным сообщениям определенной рассылке :</h4>
						</div>
						<?php  foreach($rassylka as $key=> $rassylka):?>
							<div class="row">
								<div class="col-5">
									<?php $count = countidrassylka($rassylka['id_rassylka']);?>
									<h5><?=$rassylka['name_rassylka']?> :</h5>
								</div>
								<div class="col-2">
									<h5><?=$count[0]['count']?></h5>
								</div>
								<div class="col-3">
									<?php $countPodpiska = proverkaPodpishikov($rassylka['id_rassylka']);?>
									<h5>Подписок:</h5>
								</div>
								<div class="col-1">
									<h5><?=$countPodpiska[0]['count']?></h5>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					
						
					

				</div>
			
		
				</div>



				
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
		<?php include '../../app/include/footer.php'; ?>
	<!-- footer -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>