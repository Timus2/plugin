<?php

declare(strict_types=1);

include __DIR__ . '/../../config.php';
/**
 * @global bootstrap_renderer $OUTPUT
 * @global moodle_page $PAGE
 */
global $DB, $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/distribution/');
require_login();

echo $OUTPUT->header();
$form = new local_distribution\Forms\FormDistribution;
$form->display();

$result = $form->get_data();
$result->active_user = $USER->id;
print_object($result);

if (!$DB->insert_record('history_distribution', $result)) {
    print_error('inserterror', 'history_distribution');
}
echo $OUTPUT->footer();


