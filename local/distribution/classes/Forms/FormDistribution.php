<?php

declare(strict_types=1);

namespace local_distribution\Forms;

use moodleform;

/** @global $CFG */
require_once $CFG->libdir . '/formslib.php';

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

        $mForm->addElement('textarea', 'textInfo', get_string("introtext", "survey"), 'wrap="virtual" rows="7" cols="50"');
        $mForm->setType('textInfo', PARAM_TEXT);
        $mForm->addRule('textInfo', '', 'required');

        // radio role
        $mForm->addElement('header', null, 'Целевая роль');
        $role = array();
        $role[] = $mForm->createElement('radio', 'role', '', 'Преподаватели', 1);
        $role[] = $mForm->createElement('radio', 'role', '', 'Студенты', 2);
        $role[] = $mForm->createElement('radio', 'role', '', 'Все пользователи', 3);
        $mForm->addGroup($role, null, '', array(''), '1');

        // method
        $mForm->addElement('header', null, 'Метод оповещения');
        $method = array();
        $method[] = $mForm->createElement('radio', 'method', '', 'Почта', 1);
        $method[] = $mForm->createElement('radio', 'method', '', 'Личные сообщения', 2);
        $mForm->addGroup($method, null, '', array(''), '2');

        $mForm->addElement('header', 'header', 'Файл');
        $mForm->addElement('filepicker', 'userfile', get_string('file'), null,
            array('maxbytes' => 150, 'accepted_types' => '*'));

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
}