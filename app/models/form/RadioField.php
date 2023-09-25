<?php
    require_once "app/models/form/FormElement.php";
    class RadioField extends FormElement {
        private $values;
        private $additional_tag_info;
        public function __construct(string $id, string $label_text,
            array $values, array $additional_tag_info = []) {
            
            $this->id = $id;
            $this->label_text = $label_text;
            $this->values = $values;
            $this->additional_tag_info = $additional_tag_info;
        }

        public function createHTML() {
            $fieldset = self::$dom->createElement('fieldset');
            $fieldset->setAttribute('id', $this->id);
            $fieldset->setAttribute('name', $this->id);
            foreach ($this->additional_tag_info as $attr => $value)
                $fieldset->setAttribute($attr, $value);

            foreach ($this->values as $id => $text) {
                $input = self::$dom->createElement('input');
                $input->setAttribute('type', 'radio');
                $input->setAttribute('value', $text);
                $input->setAttribute('name', $this->id);
                $input->setAttribute('id', $id);

                $label = self::$dom->createElement('label');
                $label->setAttribute('for', $id);
                $label->textContent = $text;

                $fieldset->appendChild($input);
                $fieldset->appendChild($label);
                $fieldset->appendChild(self::$dom->createElement('br'));
            }
            
            return $fieldset;
        }
    }