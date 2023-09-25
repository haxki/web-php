<?php
    class FormElement {
        public $id;
        protected $label_text;
        public static $dom;

        public function __construct(string $id, string $label_text) {
            $this->id = $id;
            $this->label_text = $label_text;
        }
        public function createHTML() {
            $label = self::$dom->createElement('label');
            $label->setAttribute('for', $this->id);
            $label->textContent = "<b><br>{$this->label_text}</b>";
            
            $p = self::$dom->createElement('p');
            $p->setAttribute('id', 'err-msg-'.$this->id);
            $p->setAttribute('class', 'err-msg');

            $html = new DOMDocumentFragment;
            $html->appendChild($label);
            $html->appendChild($p);
            return $html;
        }
    }