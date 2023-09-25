<?php
    require_once "app/models/form/FormElement.php";
    class TextField extends FormElement {
        public $is_area_type;
        private $placeholder;
        public function __construct(string $id, string $label_text, 
            string $placeholder = '', bool $is_area_type = FALSE) {
            
            $this->id = $id;
            $this->label_text = $label_text;
            $this->placeholder = $placeholder;
            $this->is_area_type = $is_area_type;
        }

        public function createHTML() {
            if ($this->is_area_type) {
                $textarea = self::$dom->createElement('textarea');
                $textarea->setAttribute('id', $this->id);
                $textarea->setAttribute('name', $this->id);
                $textarea->setAttribute('placeholder', $this->placeholder);
                return $textarea;
            } else {
                $input = self::$dom->createElement('input');
                $input->setAttribute('type', 'text');
                $input->setAttribute('id', $this->id);
                $input->setAttribute('name', $this->id);
                $input->setAttribute('placeholder', $this->placeholder);
                return $input;
            }
        }
    }