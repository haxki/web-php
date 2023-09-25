<?php
    class HistoryController extends Controller {
        function index() {
            $content_view = 'history_view.php';
            $extras = "<link rel='stylesheet' type='text/css' href='../../public/assets/css/history.css'>";

            $this->view->render($content_view, $extras);
        }
    }