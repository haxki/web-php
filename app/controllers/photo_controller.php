<?php
    class PhotoController extends Controller {
        function index() {
            $this->model = new PhotoModel;
            $content_view = 'photo_view.php';
            $extras = 
                "<script src='../../public/assets/js/photo_grid.js'></script>";

            $this->view->render($content_view, $extras, $this->model);
        }
    }