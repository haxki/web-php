<?php
    require_once "app/core/model.php";
    require_once "app/models/validators/form_validator.php";

    class ContactModel extends Model {
        public function __construct() {
            $this->form_validator = new FormValidator;
        }
    }