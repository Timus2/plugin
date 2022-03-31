<?php

declare(strict_types=1);

namespace local_distribution\Forms;

use moodleform;

global $CFG;
require_once("$CFG->libdir/formslib.php");

class FormDistribution extends moodleform
{
    /**
     * @throws \coding_exception
     */
    protected function definition()
    {
        $mForm = $this->_form;

        $mForm->addElement('header', null, 'Уведомление');

        $mForm->addElement('text', 'title', 'Тема сообщения', 'maxlength="100" size="25"');
        $mForm->setType('title', PARAM_TEXT);
        $mForm->addRule('title', '', 'required',);

        $mForm->addElement('text', 'email', get_string('email'), 'maxlength="100" size="25" ');
        $mForm->setType('email', PARAM_NOTAGS);
        $mForm->addRule('email', get_string('missingemail'), 'required');

        $mForm->addElement('textarea', 'introduction', get_string("introtext", "survey"), 'wrap="virtual" rows="7" cols="50"');
        $mForm->setType('introduction', PARAM_TEXT);
        $mForm->addRule('introduction', '', 'required');

        $mForm->addElement('filepicker', 'userfile', get_string('file'), null,
            array('maxbytes' => 150, 'accepted_types' => '*'));

        $this->add_action_buttons();
    }
}