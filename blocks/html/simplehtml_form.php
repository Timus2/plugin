<?php
require_once("{$CFG->libdir}/formslib.php");

class simplehtml_form extends moodleform
{

    function definition()
    {
        $mform =& $this->_form;

        $mform->addElement('text', 'A', get_string('A', 'block_html'));
        $mform->setType('A', PARAM_RAW);
        $mform->addRule('A', null, 'required', null, 'client');

        $mform->addElement('text', 'B', get_string('B', 'block_html'));
        $mform->setType('B', PARAM_RAW);
        $mform->addRule('B', null, 'required', null, 'client');

        $mform->addElement('text', 'C', get_string('C', 'block_html'));
        $mform->setType('C', PARAM_RAW);
        $mform->addRule('C', null, 'required', null, 'client');

        $this->add_action_buttons();

        $mform->addElement('hidden', 'blockid');
        $mform->addElement('hidden', 'courseid');
    }
}
