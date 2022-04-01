<?php

declare(strict_types=1);

/**
 * @throws coding_exception
 * @throws dml_exception
 */
function local_distribution_render_navbar_output(): string
{

    global $OUTPUT, $CFG, $USER, $COURSE;
    $params = [
        'url' => $CFG->wwwroot . '/local/distribution/'
    ];

    //role add!!!

    return $OUTPUT->render_from_template('local_distribution/form_navbar_output', $params);

}