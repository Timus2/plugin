<?php
require_once("{$CFG->libdir}/formslib.php");

class simplehtml_form extends moodleform {

    function definition() {

        $mform =& $this->_form;

        $mform->addElement('text', 'a', get_string('a', 'block_simplehtml'));
        $mform->setType('a', PARAM_RAW);
        $mform->addRule('a', null, 'required', null, 'client');

        $mform->addElement('text', 'b', get_string('b', 'block_simplehtml'));
        $mform->setType('b', PARAM_RAW);
        $mform->addRule('b', null, 'required', null, 'client');

        $mform->addElement('text', 'c', get_string('c', 'block_simplehtml'));
        $mform->setType('c', PARAM_RAW);
        $mform->addRule('c', null, 'required', null, 'client');

        $mform->addElement('hidden', 'blockid');
        $mform->addElement('hidden', 'courseid');

        $this->add_action_buttons();
    }
}