<?php

declare(strict_types=1);

use local_distribution\Forms\FormDistribution;
use local_distribution\Forms\FormHistory;

include __DIR__ . '/../../config.php';
/**
 * @global bootstrap_renderer $OUTPUT
 * @global moodle_page $PAGE
 * @global  $CFG
 * @global $DB
 */

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/distribution/');
require_login();

echo $OUTPUT->header();
$form = new FormDistribution();
$form->mustache_tabs($OUTPUT, $CFG);
new FormHistory();
echo $OUTPUT->footer();
