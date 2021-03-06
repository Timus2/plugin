<?php

declare(strict_types=1);

use local_distribution\Forms\FormDistribution;

include __DIR__ . '/../../config.php';
/**
 * @global bootstrap_renderer $OUTPUT
 * @global moodle_page $PAGE
 * @global  $CFG
 * @global $DB
 * @global $USER
 */

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/distribution/');


echo $OUTPUT->header();
$form = new FormDistribution();
$form->mustache_tabs($OUTPUT, $CFG);

$result = $form->get_data();
if ($result != null) {
    $result->active_user = $USER->id;
    $now = new DateTime('now');
    $result->active_link = '{link}';
    $result->total_user = -1;
    $result->timecreated = $now->getTimestamp();
    if (!$DB->insert_record('history_distribution', $result)) {
        print_error('inserterror', 'history_distribution');
    }
    $form->save_file('file', 'files/'. $form->get_new_filename('file'), false);
}
$form->display();
echo $OUTPUT->footer();


