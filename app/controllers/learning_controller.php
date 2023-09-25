<?php
    class LearningController extends Controller {
        function index() {
            $content_view = 'learning_view.php';
            $extras = "
                <link rel='stylesheet' type='text/css' href='../../public/assets/css/learning.css'>";

            $this->view->render($content_view, $extras);
        }
    }