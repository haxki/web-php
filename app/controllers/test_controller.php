<?php
    require_once "app/core/controller.php";
    require_once "app/models/test_model.php";

    class TestController extends Controller {
        public function __construct() {
            parent::__construct();
            $this->model = new TestModel;
        }
        function index() {
            $content_view = 'test_view.php';
            $extras = "<link rel='stylesheet' type='text/css' href='../../public/assets/css/test.css'>";

            $this->view->render($content_view, $extras, $this->model);
        }
        public function validate() {
            if (!isset($_POST['question1']))
                $_POST['question1'] = '';

            $this->model->form_validator->validate($_POST);
            $this->index();

            if (count($this->model->form_validator->errors) == 0) {
                $this->model->form_validator->verify();
            }
        }
    }