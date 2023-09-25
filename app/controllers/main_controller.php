<?php
    class MainController extends Controller {
        function index() {
            $content_view = 'main_view.php';
        
            $this->view->render($content_view);
        }
    }