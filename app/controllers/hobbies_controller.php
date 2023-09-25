<?php
    class HobbiesController extends Controller {
         function index() {
            $this->model = new HobbiesModel;
            $content_view = 'hobbies_view.php';
           
            $this->view->render($content_view, null, $this->model);
        }
    }