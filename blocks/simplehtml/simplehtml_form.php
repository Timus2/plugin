<?php
global $CFG;
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    public function definition() {
        $form = $this->_form; // Don't forget the underscore!

        $form->addElement('header', null, 'Квадратное уравнение');

        $form->addElement('text', 'nameA', 'A');
        $form->setType('nameA', PARAM_INT);

        $form->addElement('text', 'nameB', 'B');
        $form->setType('nameB', PARAM_INT);

        $form->addElement('text', 'nameC', 'C');
        $form->setType('nameC', PARAM_INT);


        $this -> add_action_buttons ();
    }
    function validation($data, $files) {
        return array();
    }
}
