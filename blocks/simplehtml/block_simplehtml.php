<?php

class block_simplehtml extends block_base
{

    public function init()
    {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }


    public function get_content()
    {
        require_once('simplehtml_form.php');
        global $DB, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $mform = new simplehtml_form();

        if ($fromform = $mform->get_data()) {
            $arr = array();
            foreach ($fromform as $item) {
                $arr[] = $item;
            }
            $a = $arr[0];
            $b = $arr[1];
            $c = $arr[2];
            $resultEquation = $this->equation($a, $b, $c);

            $this->content->text .= "<h3> $a * x<sup>2</sup> $b  * x + $c  = 0</h3> ";
            $this->content->text .= '<p>Корни уравнения :</p>';
            $this->content->text .= "x1 = $resultEquation[0], x2 = $resultEquation[1] <br>";

        } else {
            $this->content->text = $mform->render();
        }

        $url = new moodle_url('http://moodle/my/' );
        $this->content->footer .= html_writer::link($url, 'Назад <br>');

        $url = new moodle_url('/blocks/simplehtml/history.php');
        $this->content->footer .= html_writer::link($url, 'История');



        return $this->content;


//        require_once 'HTML/QuickForm.php';
//        $form = new HTML_QuickForm('firstForm');
//        $form->addElement('header', null, 'Решение');
//        $form->addElement('text', 'nameA', 'A');
//        $form->addElement('text', 'nameB', 'B');
//        $form->addElement('text', 'nameC', 'C');
//        $form->addElement('submit', null, 'Send');

//
//        $result = $this->equation($a, $b, $c);

//        $this->content = new stdClass;
//
//

//        return $this->content;
    }

    function equation($a, $b, $c): array
    {

        if ($a == 0) {
            header('Location: /');
            die;
        }
        if ($b == 0) {
            if ($c < 0) {
                $x1 = sqrt(abs($c / $a));
                $x2 = sqrt(abs($c / $a));
            } elseif ($c == 0) {
                $x1 = $x2 = 0;
            } else {
                $x1 = sqrt($c / $a);
                $x2 = -sqrt($c / $a);
            }
        } else {
            $d = ($b * $b) - 4 * $a * $c;
            if ($d > 0) {
                $x1 = (-$b + sqrt($d)) / (2 * $a);
                $x2 = (-$b - sqrt($d)) / (2 * $a);
            } elseif ($d == 0) {
                $x1 = $x2 = (-$b) / 2 * $a;
            } else {
                $x1 = -$b + sqrt(abs($d));
                $x2 = -$b - sqrt(abs($d));
            }
        }
        echo $x1, $x2;
        return array($x1, $x2);
    }

}
