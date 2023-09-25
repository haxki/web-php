<?php
    require_once "app/models/form/FormElement.php";
    class ListField extends FormElement {
        private $options;
        public function __construct(string $id, string $label_text, array $options) {
            $this->id = $id;
            $this->label_text = $label_text;
            $this->options = $options;
        }

        public function createHTML() {
            // ['key' => 'value']
            // ['key' => ['label' => 'smth', 'optgroup' => ['value1', 'value2', 'value3']]]
            $select = self::$dom->createElement('select');
            $select->setAttribute('id', $this->id);
            $select->setAttribute('name', $this->id);
            $select->appendChild(self::$dom->createElement('option'));

            foreach ($this->options as $value) {
                if (is_array($value) && array_key_exists('optgroup', $value)) {
                    $optgroup = self::$dom->createElement('optgroup');
                    $optgroup->setAttribute('label', $value['label']);
                    foreach ($value['optgroup'] as $suboption) {
                        $option = self::$dom->createElement('option');
                        $option->textContent = $suboption;
                        $optgroup->appendChild($option);
                    }
                    $select->appendChild($optgroup);
                } else {
                    $option = self::$dom->createElement('option');
                    $option->textContent = $value;
                    $select->appendChild($option);
                }
            }
            return $select;
        }
    }