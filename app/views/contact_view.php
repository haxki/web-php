<? if (isset($_POST['clear'])) header("Location: /contact/index") ?>

<div class="content">
	<section id="inner_header"><h3>Контакт</h3></section>
	<img class="background" src="../../public/assets/img/contact.jpg" height="849" alt="">

	<form class="form" method="POST" action="validate">
		<h3 style="text-align: center">Отправьте мне сообщение</h3><br>

		<label for="fio">Ваше ФИО:</label>
		<?	
			$validation_result = 
				(isset($model->form_validator->errors['fio'])) 
				? $model->form_validator->errors['fio'] : true;

			echo '<input type="text" id="fio" name="fio" placeholder="Введите ваше ФИО..."'
				. (isset($_POST['fio']) ? " value='{$_POST['fio']}'" 
					. (is_string($validation_result) ? " style='background: rgb(255, 158, 158)'" : '' ) : '')
				. '>';
			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br> 


		<label for="phone">Ваш телефон:</label>
		<?
			$validation_result = 
				(isset($model->form_validator->errors['phone'])) 
				? $model->form_validator->errors['phone'] : true;

			echo '<input type="text" id="phone" name="phone" placeholder="Введите ваш телефон..."'
				. (isset($_POST['phone']) ? " value='{$_POST['phone']}'"
					. (is_string($validation_result) ? " style='background: rgb(255, 158, 158)'" : '' ) : '')
				. '>';
			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>
		

		<label for="birthdate">Дата вашего рождения:</label>
		<?
			$validation_result = 
				(isset($model->form_validator->errors['birthdate'])) 
				? $model->form_validator->errors['birthdate'] : true;

			echo '<input type="text" id="birthdate" name="birthdate" placeholder="Выберите дату вашего рождения..." readonly'
				. (isset($_POST['birthdate']) ? " value='{$_POST['birthdate']}'"
					. (is_string($validation_result) ? " style='background: rgb(255, 158, 158)" : "rgb(158, 255, 158)" ) . "'" : '')
				.'>';
			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>
		

		<label for="gender">Ваш пол:</label>
		<fieldset id="gender" name="gender" style="border: none">
			<? echo '<input type="radio" value="Мужчина" name="gender" id="gender_male"'
					.(isset($_POST['gender']) && $_POST['gender'] == 'Мужчина' ? ' checked' : '')
					.'>' ?>
			<label for="gender_male">Мужчина</label>

			<? echo '<input type="radio" value="Женщина" name="gender" id="gender_female"'
					.(isset($_POST['gender']) && $_POST['gender'] == 'Женщина' ? ' checked' : '')
					.'>' ?>
			<label for="gender_female">Женщина</label>
		</fieldset>
		<?	
			$validation_result = $model->form_validator->errors['gender'];
			if ($validation_result && is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>
		

		<label for="age">Ваш возраст:</label>
		<? 
			$validation_result = $model->form_validator->errors['age'];
			echo '<select id="age" name="age"'
				. ($validation_result && is_string($validation_result) ? " style='background:rgb(255, 158, 158)'" : '')
				. '>';
			$options = ['', 'До 14', 'От 15 до 24', 'От 25 до 34', 'От 35 до 44', 'От 45 до 54', 'От 55'];
			foreach ($options as $option)
				echo "<option" 
						.(isset($_POST['age']) && $_POST['age'] == $option ? ' selected' : '') 
						.">$option</option>";
		?>
		</select>
		<?	
			if ($validation_result && is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>


		<label for="email">Ваш e-mail:</label>
		<? 
			$validation_result = 
				(isset($model->form_validator->errors['email'])) 
				? $model->form_validator->errors['email'] : true;
			
			echo '<input type="text" id="email" name="email" placeholder="Введите ваш e-mail..."'
				. (isset($_POST['email']) ? " value='{$_POST['email']}'"
					. (is_string($validation_result) ? " style='background:rgb(255, 158, 158)'" : '' ) : '')
				.'>';
			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>
	

		<label for="message">Сообщение:</label>
		<?	
			$validation_result = 
				(isset($model->form_validator->errors['message'])) 
				? $model->form_validator->errors['message'] : true;

			echo '<textarea id="message" name="message" placeholder="Введите ваше сообщение..."'
				. (isset($_POST['message']) && is_string($validation_result) ? "style='background:rgb(255, 158, 158)'" : '') . '>'
				. (isset($_POST['message']) ? $_POST['message'] : '')
				.'</textarea>';

			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>
		<script>
			$('#fio, #email, #message, #phone')
				.on('input', function(){ clearValidation($(this)) });
			$('#age, #gender').on('change', function(){ clearValidation($(this)) });
			
			function clearValidation(element) {
				if (element.attr('id') != 'gender')
					element.removeAttr('style');
				switch (element.next().attr('class')) {
					case 'err-msg':
						element.next().remove();
						break;
					case 'popover':
						if (element.next().next().attr('class') == 'err-msg')
							element.next().next().remove();
				}
			};
		</script>
		<div class="form_buttons">
			<input type="submit">
			<input type="submit" value="Очистить форму" name="clear">
		</div>
	</form>
</div>