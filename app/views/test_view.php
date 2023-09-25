<? if (isset($_POST['clear'])) header("Location: /test/index") ?>

<div class="content">
	<section id="inner_header"><h3>Тест по дискретной математике</h3></section>
	<img class="background" src="../../public/assets/img/exam.jpg" height="849" alt="">
	<form class="form" method="POST" action="validate" >
		
		<label for="fio"><b><br>Ваше ФИО:</b></label>
		<?	
			$validation_result = 
				(isset($model->form_validator->errors['fio'])) 
				? $model->form_validator->errors['fio'] : true;

			echo '<input type="text" id="fio" name="fio" placeholder="Введите ваше ФИО..."'
				. (isset($_POST['fio']) ? " value='{$_POST['fio']}'" 
					. (is_string($validation_result) ? " style='background:rgb(255, 158, 158)'" : '' ) : '')
				. '>';
			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>


		<label for="group"><b><br>Ваша группа:</b></label>
		<?
			$validation_result = $model->form_validator->errors['group'];
			echo '<select id="group" name="group"'
				. ($validation_result && is_string($validation_result) ? ' style="background: rgb(255, 158, 158)"' : '')
				. '>';

			$options = [
				'1 курс' => ['ИС/б-22-1-о', 'ИС/б-22-2-о', 'ИС/б-22-3-о', 'ПИ/б-22-1-о'],
				'2 курс' => ['ИС/б-21-1-о', 'ИС/б-21-2-о', 'ИС/б-21-3-о', 'ПИ/б-21-1-о'],
				'3 курс' => ['ИС/б-20-1-о', 'ИС/б-20-2-о', 'ПИ/б-20-1-о'],
				'4 курс' => ['ИС/б-19-1-о', 'ПИ/б-19-1-о']
			];
			echo '<option></option>';
			foreach ($options as $optgroup_label => $optgroup_options) {
				echo "<optgroup label='{$optgroup_label}'>";
				foreach ($optgroup_options as $option)
					echo "<option" . (isset($_POST['group']) && $_POST['group'] == $option ? " selected" : "") . ">$option</option>";
				echo '</optgroup>';
			}
		?>
		</select>
		<?	
			if ($validation_result && is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>


		<label for="question1"><b><br>Множество – это...</b></label>
		<fieldset id="question1" style="border: none;">
			<? echo '<input type="radio" value="набор каких-либо элементов" name="question1" id="answer11"'
				.(isset($_POST['question1']) && $_POST['question1'] == 'набор каких-либо элементов' ? ' checked' : '')
				.'>' ?>
			<label for="answer11">набор каких-либо элементов</label><br>
			
			<? echo '<input type="radio" value="перечень одинаковых элементов" name="question1" id="answer12"'
				.(isset($_POST['question1']) && $_POST['question1'] == 'перечень одинаковых элементов' ? ' checked' : '')
				.'>' ?>
			<label for="answer12">перечень одинаковых элементов</label><br>
			
			<? echo '<input type="radio" value="совокупность элементов, обладающих некоторым признаком, свойством" name="question1" id="answer13"'
				.(isset($_POST['question1']) && $_POST['question1'] == 'совокупность элементов, обладающих некоторым признаком, свойством' ? ' checked' : '')
				.'>' ?>
			<label for="answer13">совокупность элементов, обладающих некоторым признаком, свойством</label><br>
    		
			<? echo '<input type="radio" value="совокупность чисел" name="question1" id="answer14"'
				.(isset($_POST['question1']) && $_POST['question1'] == 'совокупность чисел' ? ' checked' : '')
				.'>' ?>
			<label for="answer14">совокупность чисел</label><br>
		</fieldset>
		<?	
			$validation_result = $model->form_validator->errors['question1'];
			if ($validation_result && is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>


		<label for="question2"><b><br>Что из этого относится к дискретной математике?</b></label>
		<?
			$validation_result = $model->form_validator->errors['question2'];
			echo '<select id="question2" name="question2"'
				. ($validation_result && is_string($validation_result) ? " style='background:rgb(255, 158, 158)'" : '')
				. '>';
			echo '<option></option>';
			$options = ['Дефрагментация', 'Интеграл', 'Оксюморон', 'Импликация', 'Фотосинтез'];
			foreach ($options as $option){
				echo "<option"
				. (isset($_POST['question2']) && $_POST['question2'] == $option ? ' selected' : '') 
				. ">$option</option>";
			}
		?>
		</select>
		<?	
			if ($validation_result && is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>


		<label for="question3"><b><br>Что это за операция?<br>&and;<br></b></label>
		<?	
			$validation_result = 
				(isset($model->form_validator->errors['question3'])) 
				? $model->form_validator->errors['question3'] : true;

			echo '<textarea id="question3" name="question3" placeholder="Введите ваш ответ..."'
				. (isset($_POST['question3']) && is_string($validation_result) 
					? " style='background: rgb(255, 158, 158)'" : '')
				. '>' 
				. (isset($_POST['question3']) ? $_POST['question3'] : '')
				. '</textarea>';

			if (is_string($validation_result))
				echo "<p class='err-msg'>$validation_result</p>";
		?><br>

		<script>
			$('#fio, #question3')
				.on('input', function(){ clearValidation($(this)) });
			$('#group, #question1, #question2')
				.on('change', function(){ clearValidation($(this)) });

			function clearValidation(element) {
				if (element.attr('id') != 'question1')
					element.removeAttr('style');
				if (element.next().attr('class') == 'err-msg')
					element.next().remove();
			};
		</script>

		<div class="form_buttons">
			<input type="submit" value="Проверить">
			<input type="submit" value="Очистить форму" name="clear">
		</div>
	</form>
</div>