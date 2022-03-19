<?php

class block_simplehtml extends block_base
{

    public function init()
    {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }


    public function get_content()
    {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '
        <form method="post">
        <p>
            <label for="let1">A</label>
            <input type="number" id="let1" name="let1" placeholder="введите значение..." required>
        </p>
        <p>
            <label for="let2">B</label>
            <input type="number" id="let2" itemtype="number" name="let2" placeholder="введите значение..." required>
        </p>
        <p>
            <label for="let3">C</label>
            <input type="number" id="let3" itemtype="number" name="let3" placeholder="введите значение..." required>
        </p>
        <button type="submit">Найти значение</button>
        </form>
        ';


        $a = (int)$_POST['let1'];
        $b = (int)$_POST['let2'];
        $c = (int)$_POST['let3'];

        $result = $this->equation($a, $b, $c);
        $this->content->items = array($result[0],$result[1]);



        $url = new moodle_url('/blocks/simplehtml/view.php');
        $this->content->footer = html_writer::link($url, 'История');

        return $this->content;
    }

    function equation($a, $b, $c): array
    {

        function headerAlert()
        {
            ?>
            <script>alert('Коэффициент при первом слагаемом уравнения не может быть равным нулю измените его и попробуйте снова.')</script>
            <?php
        }

        if ($a == 0) {
            headerAlert();
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
