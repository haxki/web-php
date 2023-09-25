<?php
    class FormValidator {
        public $rules = [
            'fio' => ['isNotEmpty', 'isFio'],
            'phone' => ['isNotEmpty', 'isPhone'],
            'birthdate' => ['isNotEmpty'],
            'group' => ['isSelectionNotEmpty'],
            'age' => ['isSelectionNotEmpty'],
            'gender' => ['isSelectionNotEmpty'],
            'email' => ['isNotEmpty', 'isEmail'],
            'message' => ['isNotEmpty']
        ];
        public $errors = [];
        public function isNotEmpty($data) {
            if (!isset($data) || empty($data))
                return "Заполните это поле!";
            return true;
        }
        public function isInteger($data) {
            if (!ctype_digit($data))
                return 'Это должно быть целым числом!';
            return true;
        }
        public function isLess($data, $value) {
            if ($this->isInteger($data) && $this->isInteger($value))
                if ($data < $value)
                    return true;
                else return "$data >= $value";
            return 'Это должно быть целым числом!';
        }
        public function isGreater($data, $value) {
            if ($this->isInteger($data) && $this->isInteger($value))
                if ($data > $value)
                    return true;
                else return "$data <= $value";
            return 'Это должно быть целым числом!';
        }
        public function isEmail($data) {
            if (filter_var($data, FILTER_VALIDATE_EMAIL))
                return true;
            return "Некорректный e-mail!";
        }
        public function setRule($field_name, $validator_name) {
            if (method_exists($this, $validator_name)) {
                if (array_key_exists($field_name, $this->rules)) {
                    $this->rules[$field_name][] = $validator_name;
                }
                else $this->rules[$field_name] = [$validator_name];
            }
        }
        public function isSelectionNotEmpty($checked_answer) {
            if (!isset($checked_answer) || empty($checked_answer))
                return "Вы не выбрали ответ!";
            return true;
        }
        public function isPhone($data) {
            if (preg_match('/^(\+7|\+3)([0-9]{8,10})$/', $data))
                return true;
            return "Телефон может начинаться только с \"+7\" или \"+3\" и содержать от 9 до 11 цифр без посторонних символов (в том числе пробелов).";
        }
        public function isFio($data) {
            if (count(explode(' ', $data)) == 3) 
                return true;
            return "Поле ФИО должно содержать три слова, которые разделены пробелами.";
        }
        public function validate($post_array) {
            $this->errors = [];
            foreach ($post_array as $field => $data) {
                if (array_key_exists($field, $this->rules)) {
                    foreach($this->rules[$field] as $method) {
                        $result = $this->$method($data);
                        if (is_string($result)) {
                            $this->errors[$field] = $result;
                            break;
                        }
                    }
                }
            }
        }
    
    }