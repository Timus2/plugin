<?php

declare(strict_types=1);

namespace local_distribution\Forms;

use moodleform;
use table_sql;

require $CFG->libdir . '/tablelib.php';

class FormHistory extends moodleform
{
    protected function definition()
    {
        global $OUTPUT, $CFG;
        $table = new table_sql('history_distribution');
        $table->set_sql('*', "{history_distribution}", '1=1');
        $table->define_baseurl("$CFG->wwwroot/history.php");
        $table->out(50, true);
    }
}
