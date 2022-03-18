<?php

class block_simplehtml extends block_base
{

    public function init()
    {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }

    public function get_content()
    {
        global $COURSE;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = 'Footer here...';
        $name = 'Ссылка на форму';
        $url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
        $this->content->footer = html_writer::link($url, get_string($name, 'block_simplehtml'));

        return $this->content;
    }

    public function specialization()
    {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_simplehtml');
            } else {
                $this->title = $this->config->title;
            }
            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_simplehtml');
            }
        }
    }

    public function instance_allow_multiple()
    {
        return true;
    }

    function has_config()
    {
        return true;
    }

    public function instance_config_save($data, $nolongerused = false)
    {
        if (get_config('simplehtml', 'Allow_HTML') == '1') {
            $data->text = strip_tags($data->text);
        }
        return parent::instance_config_save($data, $nolongerused);
    }

    public function html_attributes()
    {
        $attributes = parent::html_attributes();
        $attributes['class'] .= ' block_' . $this->name();
        return $attributes;
    }
}
