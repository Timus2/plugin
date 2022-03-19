<?php

class block_simplehtml extends block_base
{

    public function init()
    {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }

    function plugin(){
        require_once 'index.html';
    }

    public function get_content()
    {
        if ($this->content !== null) {
            return $this->content;
        }
        $setHTML = $this->plugin();
        $this->content = new stdClass;
        $this->content->text = $setHTML;
        $url = new moodle_url('/blocks/simplehtml/view.php');
        $this->content->footer = html_writer::link($url, 'История');

        return $this->content;
    }


    public function instance_allow_multiple()
    {
        return true;
    }

    function has_config()
    {
        return true;
    }
}
