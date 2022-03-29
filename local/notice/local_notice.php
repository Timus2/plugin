<?php

declare(strict_types=1);

class local_notice extends block_base
{
    /**
     * @throws coding_exception
     */
    public function init()
    {
        $this->title = get_string('notice', 'local_notice');
    }

    public function get_content(): stdClass|null
    {
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = new stdClass();
        $form = new form_notice();

        $this->content->text .= html_writer::start_tag('details');
        $this->content->text .= $form->render();
        $this->content->text .= html_writer::end_tag('details');

        return $this->content;
    }
}