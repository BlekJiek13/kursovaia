
<?php  if($success): ?>
	<ul>
		<?php foreach ($success as $error): ?>
				<li style="list-style-type: none; color: green;font-style: italic;">
				<?=$error; ?>
			</li>
			
		<?php endforeach; ?>
	</ul>
<?php endif; ?>


<?php  if($errMsg): ?>
	<ul>
		<?php foreach ($errMsg as $error): ?>
			<li style="list-style-type: none; color: red;font-style: italic;">
				<?=$error; ?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>