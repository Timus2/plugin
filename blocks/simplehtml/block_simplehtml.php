<?php

class block_simplehtml extends block_base
{

    public function init()
    {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }


    /**
     * @throws moodle_exception
     * @throws dml_exception
     */
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

        if ($getForm = $mform->get_data()) {
            $resultEquation = $this->equation($getForm->nameA, $getForm->nameB, $getForm->nameC);

            $this->content->text .= "<h3> $getForm->nameA * x<sup>2</sup> $getForm->nameB  * x + $getForm->nameC  = 0</h3> ";
            $this->content->text .= '<p>Корни уравнения :</p>';
            $this->content->text .= "x1 = $resultEquation[0], x2 = $resultEquation[1] <br>";

            $result = new stdClass();
            $result->a = $getForm->nameA;
            $result->b = $getForm->nameB;
            $result->c = $getForm->nameC;
            $result->x1 = $resultEquation[0];
            $result->x2 = $resultEquation[1];
            $result->blockid = '1';
            $result->coursid = '1';

            if (!$DB->insert_record('simplehtml', $result)) {
                print_error('inserterror', 'simplehtml');
            };
        } else {
            $this->content->text = $mform->render();
        }

        if ($simplehtmlpages = $DB->get_records('simplehtml')) {
            $this->content->text .= html_writer::start_tag('ol');
            foreach ($simplehtmlpages as $page) {
                $this->content->text .= html_writer::start_tag('li');
                $this->content->text .= "a = $page->a, b = $page->b, c = $page->c <br> <b>x1 = $page->x1, x2 = $page->x2</b> <br><br>";
                $this->content->text .= html_writer::end_tag('li');
            }
        }
        $this->content->text .= html_writer::end_tag('ol');
        $url = new moodle_url('http://moodle/my/');
        $this->content->footer .= html_writer::link($url, 'Назад <br>');

        $url = new moodle_url('/blocks/simplehtml/history.php');
        $this->content->footer .= html_writer::link($url, 'История');

        return $this->content;
    }

    function equation($a, $b, $c): array
    {
        $d = ($b * $b) - 4 * $a * $c;
        if ($d < 0) {
            echo '
            <script>
                alert("Дискриминант меньше нуля, решений нет..");
                let url = "http://moodle/my/";
                window.location.replace(url);
            </script>';
            die();
        }
        if ($a == 0) {
            echo '
            <script>
                alert("Первый коэффициент а не должен быть равен нулю...");
                let url = "http://moodle/my/";
                window.location.replace(url);
            </script>';
            die();
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
