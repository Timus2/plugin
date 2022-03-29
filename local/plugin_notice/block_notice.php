<?php

declare(strict_types=1);

class block_notice extends block_base{
    public  function  init ()  {
        $this -> title  =  get_string ( 'plugin_notice' ,  'block_notice' );
    }
}