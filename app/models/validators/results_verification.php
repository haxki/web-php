<?
    require_once "app/models/validators/custom_form_validator.php";
    class ResultsVerification extends CustomFormValidator {
        public $answers = [
            'question1' => 'совокупность элементов, обладающих некоторым признаком, свойством',
            'question2' => 'Импликация',
            'question3' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur dolores 
                distinctio consequatur sed praesentium iste ab adipisci molestiae, corrupti quidem autem 
                vitae cum beatae sequi, quaerat, maiores dignissimos fuga inventore. 
                Totam nulla mollitia magni ipsa.'
        ];
        public function verify() {
            $message = "Результаты теста:";
            $true_answers_count = 0;
            $answer_num = 1;
            foreach ($this->answers as $id => $answer) {
                if ($_POST[$id] == $answer)
                    $true_answers_count++;
                $truth = $_POST[$id] == $answer ? "верно" : "не верно";
                $message .= "\\n{$answer_num}. $truth";
                $answer_num++;
            }
            echo "<script>alert('$message');</script>";
        }
    }