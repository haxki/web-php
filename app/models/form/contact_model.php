<?php
    require_once "app/models/validators/form_validator.php";

    class ContactModel {
        public $dom;
        public $form_validator;
        public $form;
        
        public function __construct() {
            $this->form_validator = new FormValidator;
            $this->dom = new DOMDocument;
            $this->dom->validateOnParse=true;
            $this->form_validator->setDom($this->dom);
            echo ($this->dom->getElementById('fio') == null ? "null" : 'not null');
        }
        
    }