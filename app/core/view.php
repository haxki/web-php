<?php
	class View {
		function render(
			$content_view, $extras = null, $model = null, $layout='_layout.php') {
			
			include 'app/views/'.$layout;
		}
	}