<?
    require_once "app/core/controller.php";
    require_once "app/models/validators/form_validator.php";
    class CustomFormValidator extends FormValidator {
        public function count35($data) {
            if (count(explode(' ', $data)) >= 35)
                return true;
            return "Ответ должен содержать по крайней мере 35 слов.";
        }
        public function __construct() {
            $this->setRule('group', 'isSelectionNotEmpty');
            $this->setRule('question1', 'isSelectionNotEmpty');
            $this->setRule('question2', 'isSelectionNotEmpty');
            $this->setRule('question3', 'isNotEmpty');
            $this->setRule('question3', 'count35');
        }
    }