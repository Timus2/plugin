<?php
require_once('../../config.php');
require_once('simplehtml_form.php');

global $DB, $OUTPUT, $PAGE;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);
$id = optional_param('id', 0, PARAM_INT);

if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}

require_login($course);
$PAGE->set_url('/blocks/simplehtml/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_simplehtml'));

$settingsnode = $PAGE->settingsnav->add(get_string('simplehtmlsettings', 'block_simplehtml'));
$editurl = new moodle_url('/blocks/simplehtml/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_simplehtml'), $editurl);
$editnode->make_active();

$simplehtml = new simplehtml_form();

echo $OUTPUT->header();
$simplehtml->display();
echo $OUTPUT->footer();

$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$simplehtml->set_data($toform);

if($simplehtml->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);
} else if ($fromform = $simplehtml->get_data()) {

    if (!$DB->insert_record('simplehtml',$fromform )) {
        print_error('inserterror', 'simplehtml');
    }
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    echo $OUTPUT->header();
    $simplehtml->display();
    echo $OUTPUT->footer();
}

?>