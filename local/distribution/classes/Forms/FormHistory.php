<?php

declare(strict_types=1);

namespace local_distribution\Forms;

use coding_exception;
use context_system;
use dml_exception;
use moodleform;
use table_sql;

/**
 * @throws coding_exception
 * @throws dml_exception
 * @global $CFG
 * @global
 */
require $CFG->libdir . '/tablelib.php';

class FormHistory extends moodleform
{
    protected function definition()
    {
        global $CFG, $PAGE;
        $context = context_system::instance();
        $PAGE->set_context($context);
        $PAGE->set_url('/local/distribution/history.php');
        $table = new table_sql('history_distribution');
        $table->define_baseurl("$CFG->wwwroot/local/distribution/history.php");
        $table->set_sql('*', '{history_distribution}',"1=1");
        $table->sortable(true, 'id', SORT_DESC);
        $table->out(10, true);
    }
}
