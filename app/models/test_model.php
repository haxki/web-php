<?php
    require_once "app/core/model.php";
    require_once "app/models/validators/results_verification.php";
    class TestModel extends Model {        
        public function __construct() {
            $this->form_validator = new ResultsVerification;
        }
    }