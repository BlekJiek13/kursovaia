<?php session_start(); 

include '../../app/control/email.php';

?>

	<?php include '../../app/include/header-admin.php'; ?>


	<div class="container">
		<?php include "../../app/include/sidebar-admin.php"; ?>

			<div class="posts col-9">
				
				<div class="row title-table-email">
			
					<h2>Отправка сообщения</h2>

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
							<form action="index.php" method="POST" >
								<div class="col mb-6">
									<label for="formGroupExampleInput" class="form-label">Заголовок письма</label>
									<input name="caption"  type="text" class="form-control" id="formGroupExampleInput">
								</div>
								<div class="col  mb-2">
									<textarea rows="4" name="message" type="text" class="form-control" placeholder="Cообщение"></textarea>
								</div>
								<label style="text-align: left;" for="formGroupExampleInput" class="form-label">Кому отправить</label>	
								<!-- Выпадающий список -->
								<select  name = "topic" class="form-select  mb-4" aria-label="Default select example" style="width:50%; margin-left: 15px; ">
									<option value="1" selected>Всем пользователям:</option>
									<?php  foreach ($Users_email as $key => $topics): ?>

										<option value="<?=$topics['email']?>"><?=$topics['email']?></option>
									<?php endforeach; ?>
								</select>
								<!-- Выпадающий список -->

								<button id="admin_email" name="admin_email" type="submit" class="btn btn-light">
									<i class="fas fa-envelope"></i> Отправить
								</button>

							</form>
				
						</div>
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