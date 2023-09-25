<section id="inner_header"><h3>Фотоальбом</h3></section>
<img src="../../public/assets/img/mike.jpg" class="background" height="909" alt="">
<section class="content">
	<h1 style="margin: 30px 100px; font-size: 30px">Здесь несколько моих школьных фотографий</h1>
	<div class="gallery">
		<?php
			foreach ($model->getData() as $i => $data)
				echo "<div><img src='../../public/assets/img/bb/$data[img]'
				title='$data[title]' alt='Фото не найдено'><p>$data[title]</p></div>";
		?>
	</div>
</section>