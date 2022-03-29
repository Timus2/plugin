<?php
global $CFG;
require_once("$CFG->libdir/formslib.php");

class form_notice extends moodleform {
    /**
     * @throws coding_exception
     */
    public function definition() {
        $form = $this->_form;

        $form->addElement('text', 'text');
        $form->addElement('file', 'attachment', );

        $this -> add_action_buttons ();
    }
    function validation($data, $files) {
        return array();
    }
}
