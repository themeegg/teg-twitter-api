<?php

namespace Core;
class TEG_Core{
    function __construct(){

        defined('ABSPATH') or exit;

        $this->Widgets();
        $this->Options();
        $this->Shortcode();
        $this->Metabox();

    }

    public function Customizr(){

    }

    public function Options(){
        new \Core\Options\TEG_Options();
    }

    public function Widgets(){
        new \Core\Widgets\TEG_Widgets();
    }

    public function Shortcode(){
        new \Core\Shortcodes\TEG_Shortcodes();
    }

    public function Metabox(){

        new \Core\Metabox\TEG_Metabox();

    }

    function __destruct(){

    }
}