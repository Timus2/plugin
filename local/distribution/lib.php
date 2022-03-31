<?php

declare(strict_types=1);

function local_distribution_render_navbar_output(): string
{
    global $OUTPUT, $CFG;
    $params = [
        'pix' => 'qwe',
        'url' => $CFG->wwwroot . '/local/distribution/'
    ];
    return $OUTPUT->render_from_template('local_distribution/form_navbar_output', $params );
}