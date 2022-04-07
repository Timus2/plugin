<?php

declare(strict_types=1);

/**
 * @throws coding_exception
 * @throws dml_exception
 */

function local_distribution_render_navbar_output()
{
    global $OUTPUT, $CFG;
    $params = [
        'url' => $CFG->wwwroot . '/local/distribution',
    ];
    if (has_capability('local/distribution:use', context_system::instance())) {
        return $OUTPUT->render_from_template('local_distribution/form_navbar_output', $params);
    }
}