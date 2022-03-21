<?php
global $CFG;
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    public function definition() {
        $form = $this->_form;

        $form->addElement('header', null, 'Калькулятор');

        $form->addElement('text', 'nameA', 'A');
        $form->setType('nameA', PARAM_INT);
        $form -> addRule ( 'nameA' ,  'Введите значение А' ,  'required' ,  null ,  'client' );

        $form->addElement('text', 'nameB', 'B');
        $form->setType('nameB', PARAM_INT);
        $form -> addRule ( 'nameB' ,  'Введите значение B' ,  'required' ,  null ,  'client' );

        $form->addElement('text', 'nameC', 'C');
        $form->setType('nameC', PARAM_INT);
        $form -> addRule ( 'nameC' ,  'Введите значение C' ,  'required' ,  null ,  'client' );
        $this -> add_action_buttons ();
    }
    function validation($data, $files) {
        return array();
    }
}
