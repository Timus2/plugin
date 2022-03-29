<?php

declare(strict_types=1);

function local_notice_render_navbar_output(): form_notice
{
    $block = new form_notice();
    $block->render();
    return '';
}