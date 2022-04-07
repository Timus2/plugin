<?php

declare(strict_types=1);

namespace local_distribution\Forms;

use moodleform;

/**
 * @global $CFG
 */
require_once $CFG->libdir . '/formslib.php';

class FormDistribution extends moodleform
{
    protected function definition()
    {
        $mForm = $this->_form;

        $mForm->addElement('header', null, get_string("titleMessage", 'local_distribution'));

        $mForm->addElement('text', 'title', get_string("textMessage", 'local_distribution'), 'maxlength="100" size="25"');
        $mForm->setType('title', PARAM_TEXT);
        $mForm->addRule('title', '', 'required',);

        $mForm->addElement('textarea', 'textinfo', get_string("textInfo", "local_distribution"), 'wrap="virtual" rows="7" cols="50"');
        $mForm->setType('textinfo', PARAM_TEXT);
        $mForm->addRule('textinfo', '', 'required');

        // role
        $mForm->addElement('header', null, get_string("infoRole", "local_distribution"));
        $role = array();
        $role[] = $mForm->createElement('radio', 'role', '', get_string("infoAll", "local_distribution"), 1);
        $role[] = $mForm->createElement('radio', 'role', '', get_string("infoTeacher", "local_distribution"), 2);
        $role[] = $mForm->createElement('radio', 'role', '', get_string("infoStudent", "local_distribution"), 3);
        $mForm->addGroup($role, null, '', array(''), '1');

        // method
        $mForm->addElement('header', null, get_string("infoMethod", "local_distribution"));
        $method = array();
        $method[] = $mForm->createElement('radio', 'method', '', get_string("infoEmail", "local_distribution"), 1);
        $method[] = $mForm->createElement('radio', 'method', '', get_string("infoChat", "local_distribution"), 2);
        $mForm->addGroup($method, null, '', array(''), '2');

        // file
        $mForm->addElement('header', 'header', get_string('infoFile', 'local_distribution'));
        $mForm->addElement('filepicker', 'file', get_string('infoFile', 'local_distribution'), null,
            array('maxbytes' => 1024, 'accepted_types' => '*'));
        $this->add_action_buttons();
    }

    function mustache_tabs($OUTPUT, $CFG)
    {
        $params = [
            'url_form' => $CFG->wwwroot . '/local/distribution/index.php',
            'url_history' => $CFG->wwwroot . '/local/distribution/history.php'
        ];
        echo $OUTPUT->render_from_template('local_distribution/tabs_form', $params);
    }

    function managerfile()
    {

    }
}