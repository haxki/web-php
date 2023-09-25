<?
    require_once "FormElement.php";
    require_once "ListField.php";
    require_once "RadioField.php";
    require_once "TextField.php";

    class Form {
        private $elements;
        private $tag_content;
        private $header;
        protected $dom;
        private $values;
        public function __construct(DOMDocument $dom, array $tag_content, string $header, FormElement... $elements) {
            $this->dom = $dom;
            FormElement::$dom = $dom;
            $this->tag_content = $tag_content;
            $this->elements = $elements;
            $this->header = $header;
        }
        private function createHTML() {
            $form = $this->dom->createElement('form');
            foreach ($this->tag_content as $attr => $value)
                $form->setAttribute($attr, $value);

            $h3 = $this->dom->createElement('h3');
            $h3->textContent = $this->header;
            $h3->setAttribute('style', 'text-align: center');
            $form->appendChild($h3);

            foreach ($this->elements as $element)
                $form->appendChild($element->createHTML());
            
            $btn_div = $this->dom->createElement('div');
            $btn_div->setAttribute('class', 'form-buttons');
                $submit = $this->dom->createElement('input');
                $submit->setAttribute('type', 'submit');
                $reset = $this->dom->createElement('input');
                $reset->setAttribute('type', 'reset');
            $btn_div->appendChild($submit);
            $btn_div->appendChild($reset);

            $form->appendChild($btn_div);
            return $form;
        }
        public function print() {
            echo (is_null($this->dom)?"NULL":"NOT NULL");
            $divs = $this->dom->getElementsByTagName('*');
            foreach ($divs as $div) {
                var_dump($div);
            }
           $this->dom->appendChild($this->createHTML());
        }
    }