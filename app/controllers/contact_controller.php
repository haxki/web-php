<?php
    require_once "app/core/controller.php";
    require_once "app/models/contact_model.php";

    class ContactController extends Controller {
        public function __construct() {
            parent::__construct();
            $this->model = new ContactModel;
        }
        public function index() {
            $content_view = "contact_view.php";
            $extras = "
            <script src='../../public/assets/js/calendar.js?3'></script>
            <script src='../../public/assets/js/popover.js'></script>
            <link rel='stylesheet' type='text/css' href='../../public/assets/css/calendar.css'>";
            
            $this->view->render($content_view, $extras, $this->model);
        }
        
        public function validate() {
            if (!isset($_POST['gender']))
                $_POST['gender'] = ''; 
            $this->model->form_validator->validate($_POST);
            $this->index();

            if (count($this->model->form_validator->errors) == 0) {
                mail("gleb13x@mail.ru", "Тип-топ тема", $_POST['message']);
                echo "<script>alert('Сообщение отправлено на почту.');</script>";
            }
        }
    }