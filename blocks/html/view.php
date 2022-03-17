<?php
require_once('../../config.php');
require_once('simplehtml_form.php');

global $DB, $OUTPUT, $PAGE;

$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);
$id = optional_param('id', 0, PARAM_INT);

print_object($courseid);
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_html', $courseid);
}

require_login($course);
$PAGE->set_url('/blocks/html/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_html'));


$simplehtml = new simplehtml_form();

$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$simplehtml->set_data($toform);

echo $OUTPUT->header();
$settingsnode = $PAGE->settingsnav->add(get_string('htmlsettings', 'block_html'));
$editurl = new moodle_url('/blocks/html/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_html'), $editurl);
$editnode->make_active();
$simplehtml->display();
echo $OUTPUT->footer();

if($simplehtml->is_cancelled()) {
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);

} else if ($fromform = $simplehtml->get_data()) {
//    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
//    redirect($courseurl);
    print_object($fromform);
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    echo $OUTPUT->header();
    $simplehtml->display();
    echo $OUTPUT->footer();
}



