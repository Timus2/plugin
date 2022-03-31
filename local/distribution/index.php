<?php

declare(strict_types=1);

include __DIR__ . '/../../config.php';
/**
 * @global bootstrap_renderer $OUTPUT
 * @global moodle_page $PAGE
 */
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/distribution/');

echo $OUTPUT->header();
$form = new local_distribution\Forms\FormDistribution;
$form->display();
echo $OUTPUT->footer();