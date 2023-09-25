<?php
    class AboutController extends Controller {
        function index() {
            $content_view = 'about_view.php';

            $this->view->render($content_view);
        }
    }